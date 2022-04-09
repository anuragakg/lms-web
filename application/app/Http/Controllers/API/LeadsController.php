<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\LeadsService;
use App\Http\Controllers\API\BaseController as BaseController;
use Auth;
use App\Imports\LeadsImport;
use Excel;
use App\Models\Lead;
use DB;
use App\Jobs\LeadsUpdate;
class LeadsController extends BaseController
{
    protected $service;

    public function __construct(LeadsService $LeadsService)
    {
        $this->service = $LeadsService;
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
            $items=$this->service->getList($request);

            //$items = ApiResource::collection($users);
            $json_data = array(
            "recordsTotal"    => $items->total(),  
            "recordsFiltered" => $items->total(), 
            "data"            => $items,
            'current_page' => $items->currentPage(),
            'next' => $items->nextPageUrl(),
            'previous' => $items->previousPageUrl(),
            'per_page' => $items->perPage(),   
            );
            return $this->sendResponse( $json_data, 'Leads Listed successfully.');
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->getUser();
        $pass = $request->getPassword();
        //if(Auth::attempt(['email' => $user, 'password' => $pass])){ 
            $user = Auth::user(); 
            $data=$this->service->addLeads($request->all());
            return $this->sendResponse($data, 'Lead created successfully.');
        //} 
        //else{ 
            return $this->sendError('Unauthorised.', 'Unauthorised');
        //}

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function importLeads(Request $request){
        ini_set('max_execution_time', 0);

        try{

            $array=Excel::toArray(new LeadsImport,request()->file('file'));
            
            
            //DB::beginTransaction();
            // $count=0;
            $data=array();
            foreach ($array[0] as $key => $arr) 
            {
                $data[]=array(
                    'phone'=>$arr['number'],  
                    'name'=>$arr['name'],  
                    'email'=>$arr['email_id'] 
                );
                //$this->service->addUpdateLeads($arr);
            }
            DB::table('leads')->insertOrIgnore($data);
            return $this->sendResponse($data, 'data imported successfully.');
            // $job = (new \App\Jobs\LeadsUpdate()->delay(now()->addSeconds(2)); 
            // dispatch($job);  
            //DB::commit();
        }catch (\Throwable $th){

            //DB::rollBack();
            throw $th;  
        }
    }
}
