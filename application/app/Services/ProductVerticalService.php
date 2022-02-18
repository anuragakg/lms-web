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
}