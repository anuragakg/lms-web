<?php
   
namespace App\Services;
   
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Notifications\UserCreated;
use Auth;
use DB;
use Str;
use Illuminate\Validation\Rule;
use Hash;
use App\Models\ProductVerticalModel;
use App\Models\ProcductCategoryModel;
use App\Models\ProcductFormModel;
use App\Models\ProductSubcategoryModel;
use App\Models\ProjectMiniCategoryModel;
class DashboardService 
{
    public function getDashboardData($request){
        $user=Auth::user();
        //get  vertical
        $data['vertical_total']=ProductVerticalModel::count('id');
        
        //get  Category
        $data['category_total']=ProcductCategoryModel::count('id');

        //get  Form
        $data['form_total']=ProcductFormModel::count('id');
        //get  Sub category
        $data['sub_category_total']=ProductSubcategoryModel::count('id');
        //get  Mini category
        $mini_category_total=ProjectMiniCategoryModel::groupBy('form_type')->select('form_type', DB::raw('count(id) as total'))->get();
        $data['mini_category_total']=0;
        $data['lead_category_total']=0;
        if(!empty($mini_category_total)){
            foreach ($mini_category_total as $key => $cat) {
                if($cat->form_type==1){
                    $data['mini_category_total']=$cat->total;
                }
                if($cat->form_type==2){
                    $data['lead_category_total']=$cat->total;
                }
            }
        }
        $data['staff_users']=User::where('emp_type',2)->count('id');
        //get  Lead category
        return $data;

            
    }
    
	
}