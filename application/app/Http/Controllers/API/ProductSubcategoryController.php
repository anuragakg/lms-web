<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\ProductSubcategoryModel as Apimodel;
use App\Models\ProjectSubCategoryStatusModel;
use App\Http\Resources\ProductSubCategoryResource as ApiResource;
use Validator;
use Auth;
use DB;
use App\Services\ProductSubCategoryService;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\ProjectStatusResource;
class ProductSubcategoryController extends BaseController
{
    protected $service;

    public function __construct(ProductSubCategoryService $ProductSubCategoryService)
    {
        $this->service = $ProductSubCategoryService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
			$product=$this->service->getList($request);
			$items = ApiResource::collection($product);
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
			return $this->sendResponse( $json_data, 'Product Sub Category List successfully.');
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

        
        // if($validator->fails()){
        //     return $this->sendError('Validation Error.', $validator->errors()->first());       
        // }
        
        try{
            if(isset($request->form_id) && !empty($request->form_id)){
                $form_id=$request->form_id;
                $validator = Validator::make($input, [
                    'sub_category' => ['required',"unique:product_subcategory,sub_category,$form_id"],
                    'category_id' => 'required',
                    'product_vertical_id' => 'required',
                    'product_form_mini_id' => 'required',
                    'product_form_lead_id' => 'required'
                ]);
                
                if($validator->fails()){
                    return $this->sendError('Validation Error.', $validator->errors()->first());       
                }
                $product=$this->service->updateCategory($request,$request->form_id);
            }else{
                $validator = Validator::make($input, [
                    'sub_category' => ['required',"unique:product_subcategory,sub_category"],
                    'category_id' => 'required',
                    'product_vertical_id' => 'required',
                    'product_form_mini_id' => 'required',
                    'product_form_lead_id' => 'required'
                ]);
                
                if($validator->fails()){
                    return $this->sendError('Validation Error.', $validator->errors()->first());       
                }
                $product=$this->service->addCategory($request);    
            }
            
            return $this->sendResponse(new ApiResource($product), 'Product Sub Category created successfully.');
           
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
        $product = Apimodel::find($id);
  
        if (is_null($product)) {
            return $this->sendError('Product Subcategory not found.');
        }
		return $this->sendResponse(new ApiResource($product), 'Product Subcategory retrieved successfully.');
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
            'sub_category' => 'required',
            'category_id' => 'required',
            'vertical_id' => 'required',
            'form_id' => 'required',
            'lead_id' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        try{
			DB::beginTransaction();
			$product =Apimodel::find($id);
			$product->sub_category=$request->sub_category;
            $product->category_id=$request->category_id;
            $product->vertical_id=$request->vertical_id;
            $product->form_id=$request->form_id;
            $product->lead_id=$request->lead_id;
			$product->save();
			DB::commit();
			return $this->sendResponse(new ApiResource($product), 'Product Sub category updated successfully.');
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
			$product =Apimodel::findOrFail($id);
			$product->delete();
			DB::commit();
			return $this->sendResponse([], 'Product Sub category deleted successfully.');
		}catch (\Throwable $th) {
            DB::rollBack();
			return $this->sendError('Exception Error.', $th);  
        }
    }
    public function updateProjectSubCategoryStatus(Request $request)
    {
        try{
            $status=$this->service->updateProjectSubCategoryStatus($request);
            
            return $this->sendResponse( $status, 'Product form updated successfully.');
        }catch (\Throwable $th) {
           return $this->sendError('Exception Error.', $th);  
       }
    }
	public function getProjectSubCategoryStatusHistory(Request $request)
    {
        try{
            $status=$this->service->getStatusHistory($request);
            
            return $this->sendResponse( new ProjectStatusResource($status), 'status history successfully.');
        }catch (\Throwable $th) {
           return $this->sendError('Exception Error.', $th);  
       }   
    }
    public function approved_product_subcategory()
    {
        $product = Apimodel::select('id','sub_category')->where('status',1)->get();
  
        return $this->sendResponse($product, 'Product subcategory retrieved successfully.');
    }

}
