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
        
        $lead=Lead::orderBy('id','desc');
        if(!empty($search)){
            $lead=$lead->where(DB::raw("CONCAT(`name`,`email`)"), 'LIKE', "%".$search."%");    
        }
        
        return $lead->paginate($limit);
            
    }
    public function addLeads($request){
        try{
            DB::beginTransaction();
            $lead=new Lead();
            $lead->name=$request['name'];
            $lead->email=$request['email'];
            $lead->phone=$request['phone'];
            $lead->alternate_no=$request['alternate_no']??'-';
            $lead->source=$request['source']??'-';
            $lead->ad_id=$request['ad_id']??'-';
            $lead->ad_name=$request['ad_name']??'-';
            $lead->adset_id=$request['adset_id']??'-';
            $lead->adset_name=$request['adset_name']??'-';
            $lead->campaign_id=$request['campaign_id']??'-';
            $lead->campaign_name=$request['campaign_name']??'-';
            $lead->form_id=$request['form_id']??'-';
            $lead->form_name=$request['form_name']??'-';
            $lead->is_organic=$request['is_organic']??null;
            $lead->platform=$request['platform']??'-';
            $lead->save();
            DB::commit();
            return $lead;
        }catch (\Throwable $th) {
            DB::rollBack();
            throw $th;  
            
        }
        
    }
    
	
}