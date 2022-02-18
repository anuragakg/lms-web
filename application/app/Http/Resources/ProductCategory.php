<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCategory extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $pending_user_type=$this->getStatus->where('status',0)->pluck('user_type');
        
        if($this->status==0 )
        {
            $pending_usertype=array();
            foreach ($pending_user_type as $key => $user) {
                $pending_usertype[]='L'.$user;
            }
            if(!empty($pending_usertype)){
                $status_text=implode(',', $pending_usertype);    
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
            'title' => $this->title,
            'status' => $this->status,
            'status_text' => $status_text,
            'added_by' => $this->getAddedBy,
            'approved_by' => $this->getApprovedBy,
           
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
