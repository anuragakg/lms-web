<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductMiniCategoryResource extends JsonResource
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
            'product_form_mini_id'=>$this->product_form_mini_id,
            'product_form_data'=>$this->getForm,
            'title'=>$this->title,
            'first_name'=>$this->first_name,
            'last_name'=>$this->last_name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'fax'=>$this->fax,
            'whatsapp'=>$this->whatsapp,
            'website'=>$this->website,
            'speaks'=>$this->speaks,
            'industry'=>$this->industry,
            'notes'=>$this->notes,
            'company_name'=>$this->company_name,
            'process_status'=>$this->process_status,
            'rating'=>$this->rating,
            'lead_temp'=>$this->lead_temp,
            'assigned'=>$this->assigned,
            'status_field'=>$this->status_field,
            'source'=>$this->source,


            'status' => $this->status,
            'status_text' => $status_text,
            'added_by' => $this->getAddedBy,
            'approved_by' => $this->getApprovedBy,
           
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}