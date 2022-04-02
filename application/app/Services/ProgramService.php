<?php
   
namespace App\Services;
   
use Illuminate\Http\Request;
use Validator;
use App\Models\Program;

use App\Models\User;
use Auth;
use DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\VerticalCreated;
class ProgramService 
{
    public function getList($request){
        $limit = $request['length']??10;
        $search = isset($request['search']['value'])?$request['search']['value']:'';
        
        $product=Program::orderBy('id','desc');
        if(!empty($search)){
            $product=$product->where(DB::raw("CONCAT(`title`)"), 'LIKE', "%".$search."%");    
        }
        
        return $product->paginate($limit);
            
    }
    public function addProgram($request){
        $user_id = Auth::user()->id??1;
        
        
        try{
            DB::beginTransaction();
            $program=new Program();
            $program->title=$request->title;
            $program->base_price=$request->base_price;
            $program->gst=$request->gst;
            $program->added_by=$user_id;
            $program->save();
            

            DB::commit();
            return $program;
        }catch (\Throwable $th) {
            DB::rollBack();
            throw $th;  
            
        }
        
    }
    public function updateProgram($request,$id){
        try{
            DB::beginTransaction();
            $program =Program::find($id);
            $program->title=$request->title;
            $program->base_price=$request->base_price;
            $program->gst=$request->gst;
            $program->save();
            
            DB::commit();
            return $program;
        }catch (\Throwable $th) {
            DB::rollBack();
            throw $th;  
            
        }
    }
    public function checkValidation($input){
        return Validator::make($input, [
            'title' => 'required',
            'base_price' => 'required',
            'gst' => 'required',
        ]);
    }
    public function getProgram($id){
        return Program::find($id);
    }

}