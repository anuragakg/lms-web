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
        $columns = array(
            0 => 'id',
            1 => 'name',
            //6 => 'storage_capacity',
        );
        $limit = $request['length']??10;
        $search = isset($request['search']['value'])?$request['search']['value']:'';
        $order = isset($columns[$request['order'][0]['column']]) ? $columns[$request['order'][0]['column']] : 'id';
        $dir = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : 'DESC';

        $lead=Lead::orderBy($order, $dir);
        if(!empty($search)){
            $lead=$lead->where(DB::raw("CONCAT(`name`,`email`,`phone`)"), 'LIKE', "%".$search."%");    
        }
        if(isset($request['main_code']) && !empty($request['main_code'])){
            $lead=$lead->where('main_code',$request['main_code']);    
        }
        if(isset($request['parent_code']) && !empty($request['parent_code'])){
            $lead=$lead->where('parent_code',$request['parent_code']);    
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
            $data['name']=$request['name'];
            $data['email']=$request['email'];
            $data['phone']=$request['phone'];
            $data['alternate_no']=$request['alternate_no']??null;
            $data['source']=$request['source']??null;
            $data['ad_id']=$request['ad_id']??null;
            $data['ad_name']=$request['ad_name']??null;
            $data['adset_id']=$request['adset_id']??null;
            $data['adset_name']=$request['adset_name']??null;
            $data['campaign_id']=$request['campaign_id']??null;
            $data['campaign_name']=$request['campaign_name']??null;
            $data['form_id']=$request['form_id']??null;
            $data['form_name']=$request['form_name']??null;
            $data['is_organic']=$request['is_organic']??null;
            $data['platform']=$request['platform']??null;
            $data['created_time']=$created_time;
            $data['allowbroadcast']=$request['allowbroadcast']??null;
            $data['allowsms']=$request['allowsms']??null;
            $data['leadmap']=$request['leadmap']??null;
            $data['address_1']=$request['address_1']??null;
            $data['address_2']=$request['address_2']??null;
            $data['address_3']=$request['address_3']??null;
            $data['labels']=$request['labels']??null;
            $data['subscription_status']=$request['subscription_status']??null;
            $data['last_activity']=$request['last_activity']??null;
            $data['last_activity_date']=$request['last_activity_date']??null;
            


            DB::table('leads')->insertOrIgnore($data);
            DB::commit();
            return $lead;
        }catch (\Throwable $th) {
            DB::rollBack();
            throw $th;  
            
        }
        
    }
    
	public function addUpdateLeads($arr){
        //case 1
        //if only mobile and email is blank
        /*
          check all mobile if not match 
          then new main code   
        */
        $phone=$arr['number'];  
        $name=$arr['name'];  
        $email=$arr['email_id'];  
        if($phone !='' && $email ==''){
            
            $lead=Lead::where('phone',$phone)->first();
            if(empty($lead)){
                $lead=new Lead();
                $lead->name=$name;
                $lead->phone=$phone;
                $lead->email=$email;
                $lead->main_code=$this->generateCode();
                $lead->save();
            }
        }else if($phone =='' && $email !=''){
            
            $lead=Lead::where('email',$email)->first();
            if(empty($lead)){
                $lead=new Lead();
                $lead->name=$name;
                $lead->phone=$phone;
                $lead->email=$email;
                $lead->main_code=$this->generateCode();
                $lead->save();
            }
        }else if($phone !='' && $email !=''){
            
            $lead=Lead::where(['email'=>$email,'phone'=>$phone])->first();
            if(empty($lead)){
                $lead=new Lead();
                $lead->name=$name;
                $lead->phone=$phone;
                $lead->email=$email;
                $lead->main_code=$this->generateCode();
                $lead->save();
            }else{
                $phone_lead=Lead::where(['phone'=>$phone])->first();
                $email_lead=Lead::where(['email'=>$phone])->first();
                if(!empty($phone_lead) && !empty($email_lead))
                {
                    if($phone_lead->main_code!=$email_lead->main_code)
                    {
                        $parent_code=$this->generateCode();
                        $phone_lead->parent_code=$parent_code;
                        $phone_lead->save();
                        $email_lead->parent_code=$parent_code;
                        $email_lead->save();
                    }    
                }
                
            }
        }else{
            echo $email.'-'.$phone;die;
        }   
    }

    public function generateCode(){
        $code= time().mt_rand(1000,9999);
        $lead=Lead::where('main_code',$code)->first();
        if(!empty($lead)){
            generateCode();
        }
    }
}