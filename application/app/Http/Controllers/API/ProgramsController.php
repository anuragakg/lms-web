<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Services\ProgramService;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Program;

use App\Http\Resources\ProgramResource;
use Validator;
class ProgramsController extends BaseController
{
	protected $service;

    public function __construct(ProgramService $ProgramService)
    {
        $this->service = $ProgramService;
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
			$items = ProgramResource::collection($product);
			$json_data = array(
			"recordsTotal"    => $items->total(),  
			"recordsFiltered" => $items->total(), 
			"data"            => $items,
			'current_page' => $items->currentPage(),
			'next' => $items->nextPageUrl(),
			'previous' => $items->previousPageUrl(),
			'per_page' => $items->perPage(),   
			);
			return $this->sendResponse( $json_data, 'Programs Listed successfully.');
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
		
		try{
            if(isset($request->form_id) && !empty($request->form_id)){
                $product=$this->service->updateProgram($request,$request->form_id);
            }else{
                $product=$this->service->addProgram($request);    
            }
			
            return $this->sendResponse(new ProgramResource($product), 'Programs created successfully.');
           
		}catch (\Throwable $th) {
            return $this->sendError('Exception Error.', $th);  
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductVerticalModel  $productVerticalModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->service->getProgram($id);
  
        if (is_null($product)) {
            return $this->sendError('Program not found.');
        }
		return $this->sendResponse(new ProgramResource($product), 'Program retrieved successfully.');
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

}
