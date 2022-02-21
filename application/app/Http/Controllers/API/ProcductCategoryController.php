<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\ProcductCategoryModel;
use App\Http\Resources\ProductCategory as ProductResource;
use Validator;
use Auth;
use DB;
use App\Services\ProductCategoryService;
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

        
   
        $validator = Validator::make($input, [
            'title' => 'required'
        ]);
        
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors()->first());       
        }
        
        try{
            if(isset($request->form_id) && !empty($request->form_id)){
                $product=$this->service->updateCategory($request,$request->form_id);
            }else{
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
            'title' => 'required'
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
        $data= ProcductCategoryModel::select('id','title')->get();
        return $this->sendResponse($data, 'Product Category listed successfully.');
    }
}
