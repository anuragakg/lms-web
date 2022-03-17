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
        if(isset($request['created_time']) && !empty($request['created_time']))
        {
            $created_time=changeDateTimeFormate($request['created_time']);
        }else{
            $created_time=null;
        }
        try{
            DB::beginTransaction();
            $lead=new Lead();
            $lead->name=$request['name'];
            $lead->email=$request['email'];
            $lead->phone=$request['phone'];
            $lead->alternate_no=$request['alternate_no']??null;
            $lead->source=$request['source']??null;
            $lead->ad_id=$request['ad_id']??null;
            $lead->ad_name=$request['ad_name']??null;
            $lead->adset_id=$request['adset_id']??null;
            $lead->adset_name=$request['adset_name']??null;
            $lead->campaign_id=$request['campaign_id']??null;
            $lead->campaign_name=$request['campaign_name']??null;
            $lead->form_id=$request['form_id']??null;
            $lead->form_name=$request['form_name']??null;
            $lead->is_organic=$request['is_organic']??null;
            $lead->platform=$request['platform']??null;
            $lead->created_time=$created_time;
            $lead->allowbroadcast=$request['allowbroadcast']??null;
            $lead->allowsms=$request['allowsms']??null;
            $lead->leadmap=$request['leadmap']??null;
            $lead->address_1=$request['address_1']??null;
            $lead->address_2=$request['address_2']??null;
            $lead->address_3=$request['address_3']??null;
            $lead->labels=$request['labels']??null;
            $lead->subscription_status=$request['subscription_status']??null;
            $lead->last_activity=$request['last_activity']??null;
            $lead->last_activity_date=$request['last_activity_date']??null;
            $lead->save();
            DB::commit();
            return $lead;
        }catch (\Throwable $th) {
            DB::rollBack();
            throw $th;  
            
        }
        
    }
    
	
}