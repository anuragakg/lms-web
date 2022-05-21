<?php

namespace App\Http\Controllers\API;

use App\Models\ProductVerticalModel;
use App\Models\ProjectVerticalStatusModel;
use App\Http\Requests\StoreProductVerticalModelRequest;
use App\Http\Requests\UpdateProductVerticalModelRequest;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Services\ProductVerticalService;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Resources\ProductVertical as ProductResource;
use Validator;
use App\Http\Resources\ProjectStatusResource;
class ProductVerticalModelController extends BaseController
{
	protected $service;

    public function __construct(ProductVerticalService $productVerticalService)
    {
        $this->service = $productVerticalService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request = $request->all();
        //try{
			$product=$this->service->getList($request);
			$items = ProductResource::collection($product);
			$json_data = array(
			"recordsTotal"    => $items->total(),  
			"recordsFiltered" => $items->total(), 
			"data"            => $items,
			'current_page' => $items->currentPage(),
			'next' => $items->nextPageUrl(),
			'previous' => $items->previousPageUrl(),
			'per_page' => $items->perPage(),   
			);
			return $this->sendResponse( $json_data, 'Product Vertical Listed successfully.');
		//}catch (\Throwable $th) {
           return $this->sendError('Exception Error.', $th);  
       //}
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
		//$validator=$this->service->checkValidation($input);

        
   
        
        
        
		
		//try{
            if(isset($request->form_id) && !empty($request->form_id)){
                $form_id=$request->form_id;
                $validator = Validator::make($input, [
                    'title' => ['required',"unique:product_vertical_models,title,$form_id"]
                ]);
                
                if($validator->fails()){
                    return $this->sendError('Validation Error.', $validator->errors()->first());       
                }
                $product=$this->service->updateVertical($request,$request->form_id);
            }else{
                $validator = Validator::make($input, [
                    'title' => 'required|unique:product_vertical_models,title'
                ]);
                
                if($validator->fails()){
                    return $this->sendError('Validation Error.', $validator->errors()->first());       
                }
                $product=$this->service->addVertical($request);    
            }
			
            return $this->sendResponse(new ProductResource($product), 'Product created successfully.');
           
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
        $product = $this->service->getProduct($id);
  
        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }
		return $this->sendResponse(new ProductResource($product), 'Product retrieved successfully.');
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductVerticalModelRequest  $request
     * @param  \App\Models\ProductVerticalModel  $productVerticalModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
   
        $validator=$this->service->checkValidation($input);

        
   
        $validator = Validator::make($input, [
            'title' => 'required'
        ]);
        
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors()->first());       
        }
        

        try{
			$product=$this->service->updateVertical($request,$id);
			return $this->sendResponse(new ProductResource($product), 'Product created successfully.');
		}catch (\Throwable $th) {
            DB::rollBack();
			return $this->sendError('Exception Error.', $th);  
            
        }
   
       
    }
    public function saveVertical()
    {

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$product =ProductVerticalModel::findOrFail($id);
        $product->delete();
   
        return $this->sendResponse([], 'Product deleted successfully.');
    }
    public function getVertical()
    {
        $data= ProductVerticalModel::select('id','title')->where('status',1)->get();
        return $this->sendResponse($data, 'Product form listed successfully.');
    }
    public function updateProjectVerticalStatus(Request $request)
    {
        try{
            $status=$this->service->updateProjectVerticalStatus($request);
            
            return $this->sendResponse( $status, 'Product Vertical status updated successfully.');
        }catch (\Throwable $th) {
           return $this->sendError('Exception Error.', $th);  
       }
    }
	public function getProjectVerticalStatusHistory(Request $request)
    {
        try{
            $status=$this->service->getStatusHistory($request);
            
            return $this->sendResponse( new ProjectStatusResource($status), 'status history successfully.');
        }catch (\Throwable $th) {
           return $this->sendError('Exception Error.', $th);  
       }   
    }
}
