<?php
   
namespace App\Services;
   
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Notifications\UserCreated;
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
            $user->phone=$request->phone;
            $user->official_contact_number=$request->official_contact_number;
            $user->emergency_contact_number=$request->emergency_contact_number;
            $user->relation_contact_number=$request->relation_contact_number;
            $user->email=$request->email;
            $user->personal_email=$request->personal_email;
            $user->role=$request->role;
            $user->emp_code=$request->emp_code;
            $user->dept=$request->dept;
            $user->designation=$request->designation;
            $user->rm=$request->rm;
            $user->perm_address=$request->perm_address;
            $user->comm_address=$request->comm_address;
            $user->aadhar=$request->aadhar;
            $user->pan_number=$request->pan_number;
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
            $user->phone=$request->phone;
            $user->official_contact_number=$request->official_contact_number;
            $user->emergency_contact_number=$request->emergency_contact_number;
            $user->relation_contact_number=$request->relation_contact_number;
            $user->email=$request->email;
            $user->personal_email=$request->personal_email;
            $user->role=$request->role;
            $user->emp_code=$request->emp_code;
            $user->dept=$request->dept;
            $user->designation=$request->designation;
            $user->rm=$request->rm;
            $user->perm_address=$request->perm_address;
            $user->comm_address=$request->comm_address;
            $user->aadhar=$request->aadhar;
            $user->pan_number=$request->pan_number;
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
            'role'  =>'required',
            'phone'  =>'required'
        ]);
    }
	public function checkUpdateValidation($input,$id){
		$model = new User();
        return Validator::make($input, [
            'name' => 'required',
            'email' => ['required','email',"unique:users,email,$id"],
            'role'  =>'required',
            'phone'  =>'required'
        ]);
    }
    public function getUser($id){
        return User::find($id);
    }
	public function deleteUser($id){
        return User::whwre('id',$id)->delete();
    }
	public function sendEmail()
	{
		$user= User::first();
		$randomPassword = '123456' ;
		$delay = now()->addSeconds(2);
		//$user->notify(new UserCreated($user,$randomPassword));
		$user->notify(new UserCreated($user,$randomPassword));
	}
	
}