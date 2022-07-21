<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Form;
use App\Models\FormAnswers;
use App\Models\Questions;
use App\Models\QuestionsAnswer;
use App\Models\Options;
use App\Http\Resources\FormResource;
use App\Http\Resources\AnswersResource;
use App\Http\Resources\FormListResource;
use App\Http\Resources\FormAnswerlistResource;
use Validator;
use App\Services\FormsService;

class FormController extends BaseController
{
	    protected $service;
    protected $leadsService;
    protected $FormsService;
    public function __construct(FormsService $FormsService)
    {
        $this->service = $FormsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductVerticalModelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user=Auth::user();
        $user_id=$user->id;
       
        $input = $request->all();
       // dd($input);
		// $validator=$this->service->checkValidation($input);

        
   
        
  //       if($validator->fails()){
  //           return $this->sendError('Validation Error.', $validator->errors()->first());       
  //       }
		DB::beginTransaction();
        $forms=new Form();
        $forms->title=$input['title'];
        $forms->added_by=$user_id;
        $forms->save();

        if(isset($input['question']['question_text']) && !empty($input['question']['question_text'])){
            foreach ($input['question']['question_text'] as $key => $question_text) 
            {

                $question=new Questions();
                $question->form_id=$forms->id;    
                $question->question=$question_text;    
                $question->element_type=$input['question']['question_answer_option'][$key];    
                $question->save(); 

                //dd($question);
                
                
                if(isset($input['question']['option_text'][$key]) && !empty($input['question']['option_text'][$key])){
                    foreach ($input['question']['option_text'][$key] as $option_key => $option) 
                    {
                        $options=new Options();
                        $options->form_id=$forms->id;   
                        $options->question_id=$question->id;   
                        $options->option_text=$option;   
                        $options->save();   
                    }
                }
            }
        }
        DB::commit();
        
       
		return $this->sendResponse($forms, 'Programs created successfully.');
           
		
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductVerticalModel  $productVerticalModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = $this->service->getPayment($id);
  
        if (is_null($payment)) {
            return $this->sendError('Program not found.');
        }
		return $this->sendResponse(new PaymentResource($payment), 'Payment retrieved successfully.');
    }

    public function leadPaymentDetails($id)
    {
        $payment=Payment::where('lead_id',$id)->first();
        //dd($payment);
        if (is_null($payment)) {
            return $this->sendError('payment not found.');
        }
        $result=PaymentResource::make($payment);
        return $this->sendResponse($result, 'Payment retrieved successfully.');
    }

    public function remove_installment(Request $request)
    {
        DB::beginTransaction();
        $input = $request->all();
        $installment_id=$input['installment_id'];
        $PaymentInstallment=PaymentInstallment::where('id',$installment_id)->first();
        $payment_id=$PaymentInstallment->payment_id;
        $PaymentInstallment->delete();
        $total_installment_amount=PaymentInstallment::where('payment_id',$payment_id)->sum('installment_amount');

        $payment=Payment::where('id',$payment_id)->first();
        $payment->installment_total=$total_installment_amount;
        $payment->save();
        
        
        DB::commit();
        return $this->sendResponse([], 'Payment installment deleted successfully.');
    }

    

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$product =Program::findOrFail($id);
        $product->delete();
   
        return $this->sendResponse([], 'Program deleted successfully.');
    }
    public function getProgram()
    {
        $data= Program::select('id','title')->get();
        return $this->sendResponse($data, 'Program form listed successfully.');
    }
    public function paymentInstallment(Request $request){

        $input = $request->all();
        $validator=$this->service->checkInstallmentValidation($input);

        
   
        
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors()->first());       
        }
        
        //try{
            
            $product=$this->service->addInstallment($request);    
            
            
            return $this->sendResponse(new PaymentResource($product), 'Instalment added successfully.');
           
        //}catch (\Throwable $th) {
            return $this->sendError('Exception Error.', $th);  
            
        //}

    }
    public function getQuestionsList($id)
    {
        $form=Form::findOrFail($id);
        return $this->sendResponse(new FormResource($form), 'form retrieved successfully.');
        
    }
    public function addFormsAnswer(Request $request){
        $user=Auth::user();
        $user_id=$user->id;
       
        $input = $request->all();
        $form_id=$input['form_id'];
        DB::beginTransaction();
        
        $formsAnswers=new FormAnswers();
        $formsAnswers->form_id=$input['form_id'];
        $formsAnswers->added_by=$user_id;
        $formsAnswers->save();

        if(isset($input['question']) && !empty($input['question']))
        {
            foreach ($input['question'] as $key => $ques) {
                $QuestionsAnswer=new QuestionsAnswer();
                $QuestionsAnswer->formsAnswers_id=$formsAnswers->id;    
                $QuestionsAnswer->form_id=$form_id;    
                $QuestionsAnswer->question_id=$key;    
                $QuestionsAnswer->asnwer=$ques;    
                $QuestionsAnswer->save(); 
            }
        }
        DB::commit();
        
       
        return $this->sendResponse($formsAnswers, 'Forms Answer saved successfully.');
           
        
    }
    public function answers_view($id){
        $formsAnswers=FormAnswers::findOrFail($id);
        
        return $this->sendResponse(new AnswersResource($formsAnswers), 'form retrieved successfully.');
    }
    public function forms_list(Request $request)
    {
        $request = $request->all();
       // try{
            $items=$this->service->getList($request);
            $items = FormListResource::collection($items);
            $json_data = array(
            "recordsTotal"    => $items->total(),
            "recordsFiltered" => $items->total(),
            "data"            => $items,
            'current_page' => $items->currentPage(),
            'next' => $items->nextPageUrl(),
            'previous' => $items->previousPageUrl(),
            'per_page' => $items->perPage(),
            );
            return $this->sendResponse( $json_data, 'Users Listed successfully.');
       // }catch (\Throwable $th) {
           return $this->sendError('Exception Error.', $th);
       //}

    }
    public function forms_filed_list(Request $request)
    {
        $request = $request->all();
       // try{
            $items=$this->service->forms_filled_list($request);
            $items = FormAnswerlistResource::collection($items);
            $json_data = array(
            "recordsTotal"    => $items->total(),
            "recordsFiltered" => $items->total(),
            "data"            => $items,
            'current_page' => $items->currentPage(),
            'next' => $items->nextPageUrl(),
            'previous' => $items->previousPageUrl(),
            'per_page' => $items->perPage(),
            );
            return $this->sendResponse( $json_data, 'Users Listed successfully.');
       // }catch (\Throwable $th) {
           return $this->sendError('Exception Error.', $th);
       //}

    }










}
