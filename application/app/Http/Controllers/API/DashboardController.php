<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Services\DashboardService;
class DashboardController extends BaseController
{
    protected $service;

    public function __construct(DashboardService $DashboardService)
    {
        $this->service = $DashboardService;
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
            $data=$this->service->getDashboardData($request);
            return $this->sendResponse( $data, 'Dashboard data');
        //}catch (\Throwable $th) {
           return $this->sendError('Exception Error.', $th);  
       //}
    }
}
