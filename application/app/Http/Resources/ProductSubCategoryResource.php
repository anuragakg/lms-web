<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Auth;
class ProductSubCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = Auth::user();
        $role=$user->role;
        $user_id=$user->id;
        $user_role=getLTypeUser($role);
        $current_usertype_status=null;
        if(in_array($role, [2,3,4]))
        {
            $current_usertype_status=$this->getStatus->where('user_type',$user_role)->first();
                
        }
        $pending_user_type=$this->getStatus->where('status',0)->pluck('user_type');
        
        
        if($this->status==0 )
        {
            $pending_usertype=array();
            foreach ($pending_user_type as $key => $user) {
                $pending_usertype[]='L'.$user;
            }
            if(!empty($pending_usertype)){
                $status_text='Pending '.implode(',', $pending_usertype);    
            }else{
                $status_text='Pending';
            }
        }
        if($this->status==1)
        {
            $status_text='Approved';
        }
        if($this->status==2)
        {
            $status_text='Rejected';
        }
        return [
            'id' => $this->id,
            'sub_category' => $this->sub_category,
            'category_id' => $this->category_id,
            'product_vertical_id' => $this->product_vertical_id,
            'product_form_mini_id' => $this->product_form_mini_id,
            'product_form_lead_id' => $this->product_form_lead_id,
            'category' => $this->getCategory,
            'vertical' => $this->getVertical,
            'form' => $this->getForm,
            'lead' => ($this->getLead->title)??'N/A',
            'status' => $this->status,
            'status_text' => $status_text,
            'current_usertype_status' => $current_usertype_status,
            'pending_user_type'=>$pending_user_type,
            'added_by' => $this->getAddedBy,
            'approved_by' => isset($this->getApprovedBy->name)?$this->getApprovedBy->name:'-',
           
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
