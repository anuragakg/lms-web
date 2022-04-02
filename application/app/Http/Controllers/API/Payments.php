<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Services\PaymentsService;
use App\Services\LeadsService;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Payment;

use App\Http\Resources\PaymentResource;
use App\Http\Resources\PaymentListResource;
use Validator;
class Payments extends BaseController
{
	protected $service;
    protected $leadsService;

    public function __construct(PaymentsService $PaymentsService,LeadsService $LeadsService)
    {
        $this->service = $PaymentsService;
        $this->leadsService = $LeadsService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request = $request->all();
        try{
			$product=$this->service->getList($request);
			$items = PaymentListResource::collection($product);
			$json_data = array(
			"recordsTotal"    => $items->total(),  
			"recordsFiltered" => $items->total(), 
			"data"            => $items,
			'current_page' => $items->currentPage(),
			'next' => $items->nextPageUrl(),
			'previous' => $items->previousPageUrl(),
			'per_page' => $items->perPage(),   
			);
			return $this->sendResponse( $json_data, 'Payments Listed successfully.');
		}catch (\Throwable $th) {
           return $this->sendError('Exception Error.', $th);  
       }
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductVerticalModelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
		$validator=$this->service->checkValidation($input);

        
   
        
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors()->first());       
        }
		
		//try{
            if(isset($request->form_id) && !empty($request->form_id)){
                $product=$this->service->updatePayment($request,$request->form_id);
            }else{
                $product=$this->service->addPayment($request);    
            }
			
            return $this->sendResponse(new PaymentResource($product), 'Programs created successfully.');
           
		//}catch (\Throwable $th) {
            return $this->sendError('Exception Error.', $th);  
            
        //}
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
}
