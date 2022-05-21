<?php

namespace App\Http\Resources;
use App\Http\Resources\StatusResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Auth;
use App\Models\User;
class StatusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($this->user_type==1){
            $role=2;
        }
        if($this->user_type==2){
            $role=3;
        }
        if($this->user_type==3){
            $role=4;
        }
        $user= User::where('role',$role)->first();
        // $data=array();
        // foreach ($users as $key => $user) 
        // {
        //     if($user->role==2){
        //         $role=1;
        //     }
        //     if($user->role==3){
        //         $role=2;
        //     }
        //     if($user->role==4){
        //         $role=3;
        //     }
        //     $data[$role]=$user;
        // }
        
        $approver=$this->getApprovedBy;
        return [
            'id' => $this->id,
            'status' => $this->status,
            'status_text' => status_text($this->status),
            'user_type'=>'L'.$this->user_type.'-'.$user->name,
            'approver_name'=>$approver->name??'-',
            'approver_email'=>$approver->email??'-',
            'created_at' => $this->created_at->format('d/m/Y H:i'),
            'updated_at' => $this->updated_at->format('d/m/Y H:i'),
        ];
    }
}
