<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\ProcductCategoryModel;
use App\Http\Resources\ProductCategory as ProductResource;
use Validator;
use Auth;
use DB;
use App\Services\ProductCategoryService;
use App\Http\Resources\ProjectStatusResource;
use App\Http\Controllers\API\BaseController as BaseController;
class ProcductCategoryController extends BaseController
{
    protected $service;

    public function __construct(ProductCategoryService $ProductCategoryService)
    {
        $this->service = $ProductCategoryService;
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
            $items = ProductResource::collection($product);
            $items_arr=getResourceData($items);
            $data=array();
            $users=$this->getLUsers();
            
            foreach($items_arr as $arr){
                $pending_usertype=array();
                $pending_user_type=$arr['pending_user_type'];
                foreach ($pending_user_type as $key => $user) {
                    $pending_usertype[]=$users[$user]['name'];
                }
                if(!empty($pending_usertype)){
                    $status_text='Pending '.implode(',', $pending_usertype);    
                }
                $arr['status_text']=$status_text;
                $data[]=$arr;
            }
            $json_data = array(
            "recordsTotal"    => $items->total(),  
            "recordsFiltered" => $items->total(), 
            "data"            => $data,
            'current_page' => $items->currentPage(),
            'next' => $items->nextPageUrl(),
            'previous' => $items->previousPageUrl(),
            'per_page' => $items->perPage(),   
            );
            return $this->sendResponse( $json_data, 'Product Vertical Listed successfully.');
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
        //$validator=$this->service->checkValidation($input);

        
   
        
        
        try{
            if(isset($request->form_id) && !empty($request->form_id)){
                $form_id=$request->form_id;
                $validator = Validator::make($input, [
                    'title' => ['required',"unique:product_category,title,$form_id"]
                ]);
                
                if($validator->fails()){
                    return $this->sendError('Validation Error.', $validator->errors()->first());       
                }

                $product=$this->service->updateCategory($request,$request->form_id);
            }else{

                $validator = Validator::make($input, [
                    'title' => 'required|unique:product_category,title'
                ]);
                
                if($validator->fails()){
                    return $this->sendError('Validation Error.', $validator->errors()->first());       
                }
                $product=$this->service->addCategory($request);    
            }
            
            return $this->sendResponse(new ProductResource($product), 'Product created successfully.');
           
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
        $product = ProcductCategoryModel::find($id);
  
        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }
		return $this->sendResponse(new ProductResource($product), 'Product Category retrieved successfully.');
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
            'title' => ['required',"unique:product_category,title,$id"]
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        try{
			DB::beginTransaction();
			$product =ProcductCategoryModel::find($id);
			$product->title=$request->title;
			$product->save();
			DB::commit();
			return $this->sendResponse(new ProductResource($product), 'Product Category updated successfully.');
		}catch (\Throwable $th) {
            DB::rollBack();
			return $this->sendError('Exception Error.', $th);  
            
        }
   
        return $this->sendResponse(new ProductResource($product), 'Product Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product =ProcductCategoryModel::findOrFail($id);
        $product->delete();
   
        return $this->sendResponse([], 'Product Category deleted successfully.');
    }
    public function getCategory()
    {
        $data= ProcductCategoryModel::select('id','title')->where('status',1)->get();
        return $this->sendResponse($data, 'Product Category listed successfully.');
    }
    public function updateProjectCategoryStatus(Request $request)
    {
        try{
            $status=$this->service->updateProjectCategoryStatus($request);
            
            return $this->sendResponse( $status, 'Product Category status updated successfully.');
        }catch (\Throwable $th) {
           return $this->sendError('Exception Error.', $th);  
       }
    }
	public function getProjectCategoryStatusHistory(Request $request)
    {
        try{
            $status=$this->service->getStatusHistory($request);
            
            return $this->sendResponse( new ProjectStatusResource($status), 'status history successfully.');
        }catch (\Throwable $th) {
           return $this->sendError('Exception Error.', $th);  
       }   
    }
}
