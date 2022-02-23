<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\ProductMiniCategoryService;
use App\Models\ProjectMiniCategoryModel as Apimodel;
use App\Http\Resources\ProductMiniCategoryResource as ApiResource;
use App\Http\Controllers\API\BaseController as BaseController;
class ProjectMiniCategoryController extends BaseController
{
    protected $service;

    public function __construct(ProductMiniCategoryService $ProductMiniCategoryService)
    {
        $this->service = $ProductMiniCategoryService;
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
            $json_data = array(
            "recordsTotal"    => $items->total(),  
            "recordsFiltered" => $items->total(), 
            "data"            => $items,
            'current_page' => $items->currentPage(),
            'next' => $items->nextPageUrl(),
            'previous' => $items->previousPageUrl(),
            'per_page' => $items->perPage(),   
            );
            return $this->sendResponse( $json_data, 'Product Mini Category List successfully.');
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
                $product=$this->service->updateCategory($request,$request->form_id);
            }else{
                $product=$this->service->addCategory($request);    
            }
            
            return $this->sendResponse(new ApiResource($product), 'Product Mini Category created successfully.');
           
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
        return $this->sendResponse(new ApiResource($product), 'Product Mini category retrieved successfully.');
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
            return $this->sendResponse([], 'Product Mini category deleted successfully.');
        }catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError('Exception Error.', $th);  
        }
    }
    public function updateProjectMiniCategoryStatus(Request $request)
    {
        try{
            $status=$this->service->updateProjectMiniCategoryStatus($request);
            
            return $this->sendResponse( $status, 'Product mini category updated successfully.');
        }catch (\Throwable $th) {
           return $this->sendError('Exception Error.', $th);  
       }
    }
}
