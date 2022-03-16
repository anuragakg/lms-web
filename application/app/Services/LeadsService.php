<?php
   
namespace App\Services;
   
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Models\Lead;
use App\Notifications\LeadCreated;
use Auth;
use DB;
use Str;
use Illuminate\Validation\Rule;
use Hash;
class LeadsService 
{
    public function getList($request){
        $limit = $request['length']??10;
        $search = isset($request['search']['value'])?$request['search']['value']:'';
        
        $user=Lead::orderBy('id','desc');
        if(!empty($search)){
            $user=$user->where(DB::raw("CONCAT(`name`,`email`)"), 'LIKE', "%".$search."%");    
        }
        
        return $user->paginate($limit);
            
    }
    public function addLeads($request){
        try{
            DB::beginTransaction();
            $lead=new Lead();
            $lead->name=$request['name'];
            $lead->email=$request['email'];
            $lead->phone=$request['phone'];
            $lead->save();
            return $lead;
        }catch (\Throwable $th) {
            DB::rollBack();
            throw $th;  
            
        }
        
    }
    
	
}