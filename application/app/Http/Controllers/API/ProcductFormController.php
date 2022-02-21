<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
use DB;
use App\Http\Resources\ProductFormResource as ApiResource;
use App\Http\Resources\ProductFormDetailResource;
use App\Models\ProcductFormModel;
use App\Models\ProductFormControlsModel;
use App\Services\ProductFormService;
use App\Http\Controllers\API\BaseController as BaseController;
class ProcductFormController extends BaseController
{
    protected $service;

    public function __construct(ProductFormService $ProductFormService)
    {
        $this->service = $ProductFormService;
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
			$items = ApiResource::collection($product);
			$json_data = array(
			"recordsTotal"    => $items->total(),  
			"recordsFiltered" => $items->total(), 
			"data"            => $items,
			'current_page' => $items->currentPage(),
			'next' => $items->nextPageUrl(),
			'previous' => $items->previousPageUrl(),
			'per_page' => $items->perPage(),   
			);
			return $this->sendResponse( $json_data, 'Product Form List successfully.');
		}catch (\Throwable $th) {
            return $this->sendError('Exception Error.', $th);  
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator=$this->service->checkValidation($input);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors()->first());       
        }
        
        try{
            if(isset($request->form_id) && !empty($request->form_id)){

                $product=$this->service->updateForm($request,$request->form_id);
            }else{
                $product=$this->service->addForm($request);    
            }
            
            return $this->sendResponse(new ApiResource($product), 'Product created successfully.');
           
        }catch (\Throwable $th) {
            return $this->sendError('Exception Error.', $th);  
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = ProcductFormModel::find($id);
  
        if (is_null($product)) {
            return $this->sendError('Product Form not found.');
        }
		return $this->sendResponse(new ProductFormDetailResource($product), 'Product Form retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'title' => 'required',
			'type' => 'required',
            'controls' => 'array'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        try{
			$product=$this->service->updateForm($request,$request->form_id);
			return $this->sendResponse(new ApiResource($product), 'Product Form updated successfully.');
		}catch (\Throwable $th) {
            DB::rollBack();
			return $this->sendError('Exception Error.', $th);  
            
        }
   
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		try{
			DB::beginTransaction();
			$product =ProcductFormModel::findOrFail($id);
			$product->delete();
			DB::commit();
			return $this->sendResponse([], 'Product Form deleted successfully.');
		}catch (\Throwable $th) {
            DB::rollBack();
			return $this->sendError($th);  
        }
    }
    public function getProductForm()
    {
        $products= ProcductFormModel::select('id','title','type')->get();
        $product_arr=array();
        foreach($products as $product){
            if($product->type=='1'){
                $product_arr['mini'][]=array(
                    'id'=>$product->id,
                    'title'=>$product->title
                );
            }
            if($product->type=='2'){
                $product_arr['lead'][]=array(
                    'id'=>$product->id,
                    'title'=>$product->title
                );
            }
            
        }
        return $this->sendResponse($product_arr, 'Product form listed successfully.');
        
    }
    
}
