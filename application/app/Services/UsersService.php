<?php
   
namespace App\Services;
   
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Notifications\UserCreated;
use App\Notifications\LeadCreated;
use Auth;
use DB;
use Str;
use Illuminate\Validation\Rule;
use Hash;
class UsersService 
{
    public function getList($request){
        $limit = $request['length']??10;
        $search = isset($request['search']['value'])?$request['search']['value']:'';
        
        $user=User::orderBy('id','desc');
        if(!empty($search)){
            $user=$user->where(DB::raw("CONCAT(`name`,`email`)"), 'LIKE', "%".$search."%");    
        }
        
        return $user->paginate($limit);
            
    }
    public function add($request){
        $user_id = Auth::user()->id??1;
        
        
        try{
            DB::beginTransaction();
            $user=new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->role=$request->role;
			$randomPassword = Str::random(config('lms.password_length')) ;
			$randomPassword = '123456' ;
            $user->password = Hash::make($randomPassword);
            //$user->status=1;
            //$user->added_by=$user_id;
            $user->save();
			$delay = now()->addSeconds(2);
			$user->notify((new UserCreated($user,$randomPassword))->delay($delay));

			DB::commit();
            return $user;
        }catch (\Throwable $th) {
            DB::rollBack();
            throw $th;  
            
        }
        
    }
    public function update($request,$id){
		$user_id = Auth::user()->id??1;
        try{
            DB::beginTransaction();
            $user =User::find($id);
            $user->name=$request->name;
            $user->email=$request->email;
            $user->role=$request->role;
			//$user->added_by=$user_id;
            $user->save();
            

            DB::commit();
            return $user;
        }catch (\Throwable $th) {
            DB::rollBack();
            throw $th;  
            
        }
    }
    public function checkValidation($input){
        return Validator::make($input, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role'  =>'required'
        ]);
    }
	public function checkUpdateValidation($input,$id){
		$model = new User();
        return Validator::make($input, [
            'name' => 'required',
            'email' => ['required','email',"unique:users,email,$id"],
            'role'  =>'required'
        ]);
    }
    public function getUser($id){
        return User::find($id);
    }
	public function deleteUser($id){
        return User::whwre('id',$id)->delete();
    }
	public function sendEmail($request)
	{

		$user= User::first();
		$randomPassword = '123456' ;
		$delay = now()->addSeconds(2);
		//$user->notify(new UserCreated($user,$randomPassword));
		$user->notify(new LeadCreated($request));
	}
	
}