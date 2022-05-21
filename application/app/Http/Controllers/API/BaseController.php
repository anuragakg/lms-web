<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use DB;
use App\Models\User;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
    	$response = [
            'status' => true,
            'data'    => $result,
            'message' => $message,
        ];


        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'status' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['message'] = $errorMessages;
        }


        return response()->json($response, $code);
    }

    public function getLUsers(){
        $users= User::whereIn('role',[2,3,4])->groupBy('role')->get();
        $data=array();
        foreach ($users as $key => $user) 
        {
            if($user->role==2){
                $role=1;
            }
            if($user->role==3){
                $role=2;
            }
            if($user->role==4){
                $role=3;
            }
            $data[$role]=$user;
        }
        return $data;
    }
}