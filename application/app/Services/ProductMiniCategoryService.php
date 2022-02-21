<?php
   
namespace App\Services;
   
use Illuminate\Http\Request;
use Validator;
use App\Models\ProjectMiniCategoryModel;
use App\Models\ProjectMiniCategoryStatusModel;
use App\Models\ProcductFormModel;
use Auth;
use DB;
class ProductMiniCategoryService 
{
    public function getList($request){
        $limit = $request['length']??10;
        $search = isset($request['search']['value'])?$request['search']['value']:'';
        
        $product=ProjectMiniCategoryModel::orderBy('id','desc');
        if(!empty($search)){
            //$product=$product->where(DB::raw("CONCAT(`sub_category`)"), 'LIKE', "%".$search."%");    
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
            $product=new ProjectMiniCategoryModel();
			$product->product_form_mini_id=$request->product_form_mini_id;
            $product->title=$request->title;
            $product->first_name=$request->first_name;
            $product->last_name=$request->last_name;
            $product->email=$request->email;
            $product->phone=$request->phone;
            $product->fax=$request->fax;
            $product->whatsapp=$request->whatsapp;
            $product->website=$request->website;
            $product->speaks=$request->speaks;
            $product->industry=$request->industry;
            $product->notes=$request->notes;
            $product->company_name=$request->company_name;
            $product->process_status=$request->process_status;
            $product->rating=$request->rating;
            $product->lead_temp=$request->lead_temp;
            $product->assigned=$request->assigned;
            $product->status_field=$request->status_field;
            $product->source=$request->source;
			$product->status=0;
			$product->added_by=$user_id;
			$product->approved_by=0;
			$product->save();

            $projectstatus=new ProjectMiniCategoryStatusModel();
            $projectstatus->status=0;
            $projectstatus->user_type='1';
            $projectstatus->form_id=$product->id;
            $projectstatus->save();
            
            $projectstatus=new ProjectMiniCategoryStatusModel();
            $projectstatus->status=0;
            $projectstatus->user_type='2';
            $projectstatus->form_id=$product->id;
            $projectstatus->save();
            
            $projectstatus=new ProjectMiniCategoryStatusModel();
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
            $product =ProjectMiniCategoryModel::find($id);
            $product->product_form_mini_id=$request->product_form_mini_id;
            $product->title=$request->title;
            $product->first_name=$request->first_name;
            $product->last_name=$request->last_name;
            $product->email=$request->email;
            $product->phone=$request->phone;
            $product->fax=$request->fax;
            $product->whatsapp=$request->whatsapp;
            $product->website=$request->website;
            $product->speaks=$request->speaks;
            $product->industry=$request->industry;
            $product->notes=$request->notes;
            $product->company_name=$request->company_name;
            $product->process_status=$request->process_status;
            $product->rating=$request->rating;
            $product->lead_temp=$request->lead_temp;
            $product->assigned=$request->assigned;
            $product->status_field=$request->status;
            $product->source=$request->source;
            $product->save();
            ProjectMiniCategoryStatusModel::where('form_id',$id)->delete();
            $projectstatus=new ProjectMiniCategoryStatusModel();
            $projectstatus->status=0;
            $projectstatus->user_type='1';
            $projectstatus->form_id=$product->id;
            $projectstatus->save();
            
            $projectstatus=new ProjectMiniCategoryStatusModel();
            $projectstatus->status=0;
            $projectstatus->user_type='2';
            $projectstatus->form_id=$product->id;
            $projectstatus->save();
            
            $projectstatus=new ProjectMiniCategoryStatusModel();
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
        $validation_arr=array();
        $validation_arr['product_form_mini_id']=['required'];
        $product_form_mini_id=$input['product_form_mini_id'];
        $product=ProcductFormModel::where('id',$product_form_mini_id)->first();
        $product_controls=$product->getControls;
        foreach ($product_controls as $key => $control) {
            $is_required=$control->is_required==1?'required':'nullable';
            $validation_arr[$control->control]=[$is_required];
        }
        


        return Validator::make($input, $validation_arr);
    }
    public function getProduct($id){
        return ProjectMiniCategoryModel::find($id);
    }
}