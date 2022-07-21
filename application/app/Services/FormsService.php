<?php
   
namespace App\Services;
   
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Models\Form;
use App\Models\FormAnswers;
use App\Models\Questions;
use App\Models\QuestionsAnswer;
use App\Models\Options;
use App\Notifications\UserCreated;
use Auth;
use DB;
use Str;
use Illuminate\Validation\Rule;
use Hash;
class FormsService 
{
    public function getList($request){
        $limit = $request['length']??10;
        $search = isset($request['search']['value'])?$request['search']['value']:'';
        
        $user=Form::orderBy('id','desc');
        if(!empty($search)){
            $user=$user->where(DB::raw("CONCAT(`title`)"), 'LIKE', "%".$search."%");    
        }
        
        return $user->paginate($limit);
            
    }
    public function forms_filled_list($request){
        $limit = $request['length']??10;
        $search = isset($request['search']['value'])?$request['search']['value']:'';
        
        $user=FormAnswers::orderBy('id','desc');
        if(!empty($search)){
            $user=$user->where(DB::raw("CONCAT(`title`)"), 'LIKE', "%".$search."%");    
        }
        $form_id=$request['form_id'];
        $user=$user->where('form_id',$form_id);    
        return $user->paginate($limit);
            
    }
    
	
}