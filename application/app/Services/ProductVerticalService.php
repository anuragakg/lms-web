<?php
   
namespace App\Services;
   
use Illuminate\Http\Request;
use Validator;
use App\Models\ProductVerticalModel;
use App\Models\ProjectVerticalStatusModel;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\VerticalCreated;
class ProductVerticalService 
{
    public function getList($request){
        $columns = array( 
                0 =>'id', 
                1=> 'title',
                3=> 'created_at',
                5=> 'status',
        );

        $order = isset($columns[$request['order'][0]['column']])?$columns[$request['order'][0]['column']]:'id';
        $dir = isset($request['order'][0]['dir'])?$request['order'][0]['dir']:'DESC';

        $limit = $request['length']??10;
        $search = isset($request['search']['value'])?$request['search']['value']:'';
        
        $product=ProductVerticalModel::orderBy($order,$dir);
        $product=$product->leftJoin('users',function($join) {
                $join->on('product_vertical_models.added_by','=','users.id');
            }
        );
        if(!empty($search)){
            $product=$product->where(DB::raw("CONCAT(`title`,`name`)"), 'LIKE', "%".$search."%");    
        }
        $status=$request['status'];
        if($status !=''){
            $product=$product->where('status',$status);    
        }
        $product=$product->select('product_vertical_models.*');
        return $product->paginate($limit);
            
    }
    public function addVertical($request){
        $user_id = Auth::user()->id??1;
        $input=$request->all();
        
        try{
            DB::beginTransaction();
            $product=new ProductVerticalModel();
            $product->title=$request->title;
            $product->status=0;
            $product->added_by=$user_id;
            $product->approved_by=0;
            $product->save();
            

            if(!empty($request['approver']['role'])){
                foreach ($request['approver']['role'] as $key => $role) {
                    
                    $projectstatus=new ProjectVerticalStatusModel();
                    $projectstatus->status=0;
                    $projectstatus->role=$role;
                    $projectstatus->user_id=$request['approver']['user'][$key];
                    $projectstatus->product_id=$product->id;
                    $projectstatus->save();
                }
            }
            

            //sendVerticalNotification($product);
            

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
            if(!empty($request['approver']['role'])){
                foreach ($request['approver']['role'] as $key => $role) {
                    
                    $projectstatus=new ProjectVerticalStatusModel();
                    $projectstatus->status=0;
                    $projectstatus->role=$role;
                    $projectstatus->user_id=$request['approver']['user'][$key];
                    $projectstatus->product_id=$product->id;
                    $projectstatus->save();
                }
            }
            $product->status=0;
            $product->save();
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

        $id=$request->id;
        $status=$request->status;
        $reason=$request->reason;

        DB::beginTransaction();
        $project=ProductVerticalModel::find($id);
        $project_status=ProjectVerticalStatusModel::where(['product_id'=>$id,'user_id'=>$user_id])->first();
        $project_status->status=$status;
        if($status==1){
            $project_status->approver_remarks='Approved';
        }else{
            $project_status->approver_remarks=$reason;
        }
        $project_status->updated_by=$user_id;
        $project_status->save();
        if($status==2){
            $project->status=2;
            $project->approved_by=$user_id;
            $project->save();
        }
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
        
        
        DB::commit();
        return $project;
    }
	public function getStatusHistory($request)
    {
        return ProductVerticalModel::find($request->id);
        
    }
}