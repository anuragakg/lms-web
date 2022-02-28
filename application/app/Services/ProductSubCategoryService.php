<?php
   
namespace App\Services;
   
use Illuminate\Http\Request;
use Validator;
use App\Models\ProductSubcategoryModel;
use App\Models\ProjectSubCategoryStatusModel;
use Auth;
use DB;
class ProductSubCategoryService 
{
    public function getList($request){
        $limit = $request['length']??10;
        $search = isset($request['search']['value'])?$request['search']['value']:'';
        
        $product=ProductSubcategoryModel::orderBy('id','desc');
        if(!empty($search)){
            $product=$product->where(DB::raw("CONCAT(`sub_category`)"), 'LIKE', "%".$search."%");    
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
            $product=new ProductSubcategoryModel();
			$product->sub_category=$request->sub_category;
            $product->category_id=$request->category_id;
            $product->product_vertical_id=$request->product_vertical_id;
            $product->product_form_mini_id=$request->product_form_mini_id;
            $product->product_form_lead_id=$request->product_form_lead_id;
			$product->status=0;
			$product->added_by=$user_id;
			$product->approved_by=0;
			$product->save();
            sendSubCategoryNotification($product);
            $projectstatus=new ProjectSubCategoryStatusModel();
            $projectstatus->status=0;
            $projectstatus->user_type='1';
            $projectstatus->form_id=$product->id;
            $projectstatus->save();
            
            $projectstatus=new ProjectSubCategoryStatusModel();
            $projectstatus->status=0;
            $projectstatus->user_type='2';
            $projectstatus->form_id=$product->id;
            $projectstatus->save();
            
            $projectstatus=new ProjectSubCategoryStatusModel();
            $projectstatus->status=0;
            $projectstatus->user_type='3';
            $projectstatus->form_id=$product->id;
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
            $product =ProductSubcategoryModel::find($id);
            $product->sub_category=$request->sub_category;
            $product->category_id=$request->category_id;
            $product->product_vertical_id=$request->product_vertical_id;
            $product->product_form_mini_id=$request->product_form_mini_id;
            $product->product_form_lead_id=$request->product_form_lead_id;
            $product->save();
            ProjectSubCategoryStatusModel::where('form_id',$id)->delete();
            $projectstatus=new ProjectSubCategoryStatusModel();
            $projectstatus->status=0;
            $projectstatus->user_type='1';
            $projectstatus->form_id=$product->id;
            $projectstatus->save();
            
            $projectstatus=new ProjectSubCategoryStatusModel();
            $projectstatus->status=0;
            $projectstatus->user_type='2';
            $projectstatus->form_id=$product->id;
            $projectstatus->save();
            
            $projectstatus=new ProjectSubCategoryStatusModel();
            $projectstatus->status=0;
            $projectstatus->user_type='3';
            $projectstatus->form_id=$product->id;
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
            'sub_category' => 'required',
            'category_id' => 'required',
            'product_vertical_id' => 'required',
            'product_form_mini_id' => 'required',
            'product_form_lead_id' => 'required'
        ]);
    }
    public function getProduct($id){
        return ProductSubcategoryModel::find($id);
    }
    public function updateProjectSubCategoryStatus($request){
        $user = Auth::user();
        $role=$user->role;
        $user_id=$user->id;
        $user_role=getLTypeUser($role);
        $id=$request->id;
        $status=$request->status;

        DB::beginTransaction();
        $project=ProductSubcategoryModel::find($request->id);
        $project_status=ProjectSubCategoryStatusModel::where(['form_id'=>$id,'user_type'=>$user_role])->first();
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
                $all_status=ProjectSubCategoryStatusModel::where(['form_id'=>$id,'status'=>0])->first();
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
        return ProductSubcategoryModel::find($request->id);
        
    }
}