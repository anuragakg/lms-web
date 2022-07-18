<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Auth;
class ProductVerticalStatusResource extends JsonResource
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
        
        switch ($this->status) {
            case '1':
                $status_text='Approved';
                break;
            case '2':
                $status_text='Rejected';
                break;
            default:
                $status_text='Pending';
                break;
        }
        $approver=$this->getApproverName;
        return [
            'id' => $this->id,
            'status'=>$this->status,
            'status_text'=>$status_text,
            'role'=>$this->role,
            'role_name'=>$this->getRoleName->title,
            'user_id'=>$this->user_id,
            'approver_name'=>$approver->name,
            'approver_email'=>$approver->email,
            'approver_remarks'=>$approver->approver_remarks??'-',
            'updated_at'=>$this->updated_at->format('d/m/Y H:i'),
            
        ];
    }
}
