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
        
        return $product->paginate($limit);
            
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
}