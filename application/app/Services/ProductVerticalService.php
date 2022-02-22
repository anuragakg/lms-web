<?php
   
namespace App\Services;
   
use Illuminate\Http\Request;
use Validator;
use App\Models\ProductVerticalModel;
use App\Models\ProjectVerticalStatusModel;
use Auth;
use DB;
class ProductVerticalService 
{
    public function getList($request){
        $limit = $request['length']??10;
        $search = isset($request['search']['value'])?$request['search']['value']:'';
        
        $product=ProductVerticalModel::orderBy('id','desc');
        if(!empty($search)){
            $product=$product->where(DB::raw("CONCAT(`title`)"), 'LIKE', "%".$search."%");    
        }
        
        return $product->paginate($limit);
            
    }
    public function addVertical($request){
        $user_id = Auth::user()->id??1;
        
        
        try{
            DB::beginTransaction();
            $product=new ProductVerticalModel();
            $product->title=$request->title;
            $product->status=0;
            $product->added_by=$user_id;
            $product->approved_by=0;
            $product->save();
            
            $projectstatus=new ProjectVerticalStatusModel();
            $projectstatus->status=0;
            $projectstatus->user_type='1';
            $projectstatus->product_id=$product->id;
            $projectstatus->save();
            
            $projectstatus=new ProjectVerticalStatusModel();
            $projectstatus->status=0;
            $projectstatus->user_type='2';
            $projectstatus->product_id=$product->id;
            $projectstatus->save();
            
            $projectstatus=new ProjectVerticalStatusModel();
            $projectstatus->status=0;
            $projectstatus->user_type='3';
            $projectstatus->product_id=$product->id;
            $projectstatus->save();
            DB::commit();
            return $product;
        }catch (\Throwable $th) {
            DB::rollBack();
            throw $th;  
            
        }
        
    }
    public function updateVertical($request,$id){
        try{
            DB::beginTransaction();
            $product =ProductVerticalModel::find($id);
            $product->title=$request->title;
            $product->save();
            ProjectVerticalStatusModel::where('product_id',$id)->delete();
            $projectstatus=new ProjectVerticalStatusModel();
            $projectstatus->status=0;
            $projectstatus->user_type='1';
            $projectstatus->product_id=$product->id;
            $projectstatus->save();
            
            $projectstatus=new ProjectVerticalStatusModel();
            $projectstatus->status=0;
            $projectstatus->user_type='2';
            $projectstatus->product_id=$product->id;
            $projectstatus->save();
            
            $projectstatus=new ProjectVerticalStatusModel();
            $projectstatus->status=0;
            $projectstatus->user_type='3';
            $projectstatus->product_id=$product->id;
            $projectstatus->save();

            DB::commit();
            return $product;
        }catch (\Throwable $th) {
            DB::rollBack();
            throw $th;  
            
        }
    }
    public function checkValidation($input){
        return Validator::make($input, [
            'title' => 'required'
        ]);
    }
    public function getProduct($id){
        return ProductVerticalModel::find($id);
    }
    public function updateProjectVerticalStatus($request){
        $user = Auth::user();
        $role=$user->role;
        $user_id=$user->id;
        $user_role=getLTypeUser($role);
        $id=$request->id;
        $status=$request->status;

        DB::beginTransaction();
        $project=ProductVerticalModel::find($request->id);
        $project_status=ProjectVerticalStatusModel::where(['product_id'=>$id,'user_type'=>$user_role])->first();
        $project_status->status=$status;
        $project_status->updated_by=$$user_id;
        $project_status->save();
        if($status==2){
            $project->status=2;
            $project->approved_by=$user_id;
            $project->save();
        }else{
            if($project->status!=2)
            {
                $all_status=ProjectVerticalStatusModel::where(['product_id'=>$id,'status'=>0])->first();
                if(empty($all_status))
                {
                    $project->approved_by=$user_id;
                    $project->status=1;
                    $project->save();
                }
            }
        }
        
        DB::commit();
        return $project;
    }
}