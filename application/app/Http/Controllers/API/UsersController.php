<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Resources\Users as ApiResource;
use Validator;
use App\Services\UsersService;
use App\Http\Controllers\API\BaseController as BaseController;
class UsersController extends BaseController
{
    protected $service;

    public function __construct(UsersService $UsersService)
    {
        $this->service = $UsersService;
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
			$users=$this->service->getList($request);
			$items = ApiResource::collection($users);
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
		}catch (\Throwable $th) {
           return $this->sendError('Exception Error.', $th);  
       }
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
        
        
        try{
            if(isset($request->form_id) && !empty($request->form_id)){
				$validator=$this->service->checkUpdateValidation($input,$request->form_id);

        
				if($validator->fails()){
					return $this->sendError('Validation Error.', $validator->errors()->first());       
				}
                $user=$this->service->update($request,$request->form_id);
            }else{
				$validator=$this->service->checkValidation($input);

        
				if($validator->fails()){
					return $this->sendError('Validation Error.', $validator->errors()->first());       
				}
                $user=$this->service->add($request);    
            }
            
            return $this->sendResponse(new ApiResource($user), 'user created successfully.');
           
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
        $user = $this->service->getUser($id);
  
        if (is_null($user)) {
            return $this->sendError('user not found.');
        }
        return $this->sendResponse(new ApiResource($user), 'user retrieved successfully.');
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
			$users=$this->service->deleteUser($id);
            DB::commit();
            return $this->sendResponse([], 'user deleted successfully.');
        }catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError('Exception Error.', $th);  
        }
    }
	public function sendEmail(Request $request)
	{
		$this->service->sendEmail($request->all());
	}
}
