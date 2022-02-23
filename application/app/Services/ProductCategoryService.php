<?php
   
namespace App\Services;
   
use Illuminate\Http\Request;
use Validator;
use App\Models\ProcductCategoryModel;
use App\Models\ProjectCategoryStatusModel;
use Auth;
use DB;
class ProductCategoryService 
{
    public function getList($request){
        $limit = $request['length']??10;
        $search = isset($request['search']['value'])?$request['search']['value']:'';
        
        $product=ProcductCategoryModel::orderBy('id','desc');
        if(!empty($search)){
            $product=$product->where(DB::raw("CONCAT(`title`)"), 'LIKE', "%".$search."%");    
        }
        if(isset($request['page'])){
            return $product->paginate($limit);    
        }else{
            return $product->get();
        }
        
            
    }
    public function addCategory($request){
        $user_id = Auth::user()->id??1;
        
        
        try{
            DB::beginTransaction();
            $product=new ProcductCategoryModel();
            $product->title=$request->title;
            $product->status=0;
            $product->added_by=$user_id;
            $product->approved_by=0;
            $product->save();
            
            $projectstatus=new ProjectCategoryStatusModel();
            $projectstatus->status=0;
            $projectstatus->user_type='1';
            $projectstatus->product_id=$product->id;
            $projectstatus->save();
            
            $projectstatus=new ProjectCategoryStatusModel();
            $projectstatus->status=0;
            $projectstatus->user_type='2';
            $projectstatus->product_id=$product->id;
            $projectstatus->save();
            
            $projectstatus=new ProjectCategoryStatusModel();
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
    public function updateCategory($request,$id){
        try{
            DB::beginTransaction();
            $product =ProcductCategoryModel::find($id);
            $product->title=$request->title;
            $product->save();
            ProjectCategoryStatusModel::where('product_id',$id)->delete();
            $projectstatus=new ProjectCategoryStatusModel();
            $projectstatus->status=0;
            $projectstatus->user_type='1';
            $projectstatus->product_id=$product->id;
            $projectstatus->save();
            
            $projectstatus=new ProjectCategoryStatusModel();
            $projectstatus->status=0;
            $projectstatus->user_type='2';
            $projectstatus->product_id=$product->id;
            $projectstatus->save();
            
            $projectstatus=new ProjectCategoryStatusModel();
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
        return ProcductCategoryModel::find($id);
    }
    public function updateProjectCategoryStatus($request){
        $user = Auth::user();
        $role=$user->role;
        $user_id=$user->id;
        $user_role=getLTypeUser($role);
        $id=$request->id;
        $status=$request->status;

        DB::beginTransaction();
        $project=ProcductCategoryModel::find($request->id);
        $project_status=ProjectCategoryStatusModel::where(['product_id'=>$id,'user_type'=>$user_role])->first();
        $project_status->status=$status;
        $project_status->updated_by=$user_id;
        $project_status->save();
        if($status==2){
            $project->status=2;
            $project->approved_by=$user_id;
            $project->save();
        }else{
            if($project->status!=2)
            {
                $all_status=ProjectCategoryStatusModel::where(['product_id'=>$id,'status'=>0])->first();
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
	public function getStatusHistory($request)
    {
        return ProcductCategoryModel::find($request->id);
        
    }
}