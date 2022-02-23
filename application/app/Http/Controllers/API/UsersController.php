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
}
