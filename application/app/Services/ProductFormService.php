<?php
   
namespace App\Services;
   
use Illuminate\Http\Request;
use Validator;
use App\Models\ProcductFormModel;
use App\Models\ProductFormControlsModel;
use App\Models\ProjectFormStatusModel;
use Auth;
use DB;
class ProductFormService 
{
    public function getList($request){
        $limit = $request['length']??10;
        $search = isset($request['search']['value'])?$request['search']['value']:'';
        
        $product=ProcductFormModel::orderBy('id','desc');
        if(!empty($search)){
            $product=$product->where(DB::raw("CONCAT(`title`)"), 'LIKE', "%".$search."%");    
        }
        
        return $product->paginate($limit);
            
    }
    public function addForm($request){
        $user_id = Auth::user()->id??1;
        
        $input = $request->all();
        try{
            DB::beginTransaction();
            $product=new ProcductFormModel();
            $product->title=$request->title;
			$product->type=$request->type;
            $product->status=0;
            $product->added_by=$user_id;
            $product->approved_by=0;
            $product->save();
			sendNewFormNotification($product);
			foreach($input['contorls']['element'] as $key=>$control)
            {
                if(isset($input['contorls']['element'][$key]['input']))
                {
                    $FormControl=new ProductFormControlsModel();
                    $FormControl->form_id=$product->id;
                    $FormControl->control=$key;
                    $FormControl->is_required=isset($input['contorls']['element'][$key]['is_required'])?1:0;
                    $FormControl->save();
                }
                    
            }
			
            $projectstatus=new ProjectFormStatusModel();
            $projectstatus->status=0;
            $projectstatus->user_type='1';
            $projectstatus->product_id=$product->id;
            $projectstatus->save();
            
            $projectstatus=new ProjectFormStatusModel();
            $projectstatus->status=0;
            $projectstatus->user_type='2';
            $projectstatus->product_id=$product->id;
            $projectstatus->save();
            
            $projectstatus=new ProjectFormStatusModel();
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
    public function updateForm($request,$id){
		$input = $request->all();
        try{
            DB::beginTransaction();
            $product =ProcductFormModel::find($id);
            $product->title=$request->title;
			$product->type=$request->type;
            $product->save();
			
			ProductFormControlsModel::where('form_id',$id)->delete();
			foreach($input['contorls']['element'] as $key=>$control)
            {
                if(isset($input['contorls']['element'][$key]['input']))
                {
                    $FormControl=new ProductFormControlsModel();
                    $FormControl->form_id=$product->id;
                    $FormControl->control=$key;
                    $FormControl->is_required=isset($input['contorls']['element'][$key]['is_required'])?1:0;
                    $FormControl->save();
                }
                    
            }
			
            ProjectFormStatusModel::where('product_id',$id)->delete();
            $projectstatus=new ProjectFormStatusModel();
            $projectstatus->status=0;
            $projectstatus->user_type='1';
            $projectstatus->product_id=$product->id;
            $projectstatus->save();
            
            $projectstatus=new ProjectFormStatusModel();
            $projectstatus->status=0;
            $projectstatus->user_type='2';
            $projectstatus->product_id=$product->id;
            $projectstatus->save();
            
            $projectstatus=new ProjectFormStatusModel();
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
            'title' => 'required',
            'type' => 'required',
            'controls' => 'array'
        ]);
    }
    public function getProduct($id){
        return ProcductFormModel::find($id);
    }
    public function updateProjectFormStatus($request){
        $user = Auth::user();
        $role=$user->role;
        $user_id=$user->id;
        $user_role=getLTypeUser($role);
        $id=$request->id;
        $status=$request->status;

        DB::beginTransaction();
        $project=ProcductFormModel::find($request->id);
        $project_status=ProjectFormStatusModel::where(['product_id'=>$id,'user_type'=>$user_role])->first();
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
                $all_status=ProjectFormStatusModel::where(['product_id'=>$id,'status'=>0])->first();
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

    public function getProjectFormStatusHistory($request)
    {
        return ProcductFormModel::find($request->id);
        
    }
}