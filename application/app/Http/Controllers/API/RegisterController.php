<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Services\AuthService;
use Str;
use App\Notifications\ForgotPassword;
use Hash;
class RegisterController extends BaseController
{
	protected $service;
	public function __construct(AuthService $authService)
	{
		$this->service = $authService;
		
	}
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'role'  =>'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['role'] = $input['role'];
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        
        return $this->sendResponse($success, 'User register successfully.');
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['name'] =  $user->name;
            $success['permissions'] =  $user->getPermissions;
            $success['role'] =  $user->role;
            
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', 'Unauthorised');
        } 
    }
	public function logout(Request $request)
	{ 
		if ($request->user()) {
			$request->user()->token()->revoke();

		}
		
		return $this->sendResponse([],'User logged out.');
	}
	public function changePassword(Request $request){ 
		$validator = $this->service->validateChangePassword($request->all());
		
		if ($validator->fails()) {
			return $this->sendError('Validation Error.', $validator->errors()->first()); 
		}

		$data = $validator->validated();
		User::find(auth()->user()->id)->update(['password'=> Hash::make($request->password)]);
		return $this->sendResponse([],"Password Changed Successfully.");
		try {

			$status = $this->service->changePassword($data);
			if ($status == 0) {
				return $this->sendError('Error',"Old Password doesn't match.");
			} else if($status == 2){
				return $this->sendError('Error',"The New Password can'be same as last three passwords.");
			}else {
				$authId=Auth::user()->id;
				$user = User::where([
						'id' => $authId,
					])->firstOrFail();
					
				//$user->notify(new ResetPassword());
				return $this->sendResponse([],"Password Changed Successfully.");
			}
		} catch (\Throwable $th) {
			return $this->sendError('Error',$th);
		}

	}
	public function forgotPassword(Request $request){

		$validator = $this->service->validateForgotPassword($request->all());
		
		if ($validator->fails()) {
			return $this->sendError('Validation Error.', $validator->errors()); 
		}

		$data = $validator->validated();
		
	    try{

					        	
				$user = User::where('email',$data['email'])->first();
				if(!empty($user))
				{
					$token = Str::random();
					$this->service->setForgotPasswordToken($user, $token);
					$delay = now()->addSeconds(2);
					$user->notify((new ForgotPassword( ['token' => $token]))->delay($delay));
					return $this->sendResponse([],"Reset Password Link Sent Successfully.");	
				}else{
					return $this->sendError([],"Reset Password Link Sent Successfully.");	
				}
				
			

	    } catch (\Throwable $th) {
			return $this->respondNotFound();
		}
	}

	public function resetPassword(Request $request){ 
		$validator = $this->service->validateResetPassword($request->all());

		if ($validator->fails()) {
			return $this->sendError('Validation Error.', $validator->errors()); 
		}

		$data = $validator->validated();
		try {

			$userGenerated = $this->service->resetPassword($data);
			return $this->sendResponse([],'Password Reset Successfully.');
			

		} catch (\Throwable $th) {
			return $this->sendError('Error! password could not be reset.please try again');
		}
	}

}