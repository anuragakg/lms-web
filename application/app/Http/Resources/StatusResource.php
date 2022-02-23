<?php

namespace App\Http\Resources;
use App\Http\Resources\StatusResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Auth;
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
        $approver=$this->getApprovedBy;
        return [
            'id' => $this->id,
            'status' => $this->status,
            'status_text' => status_text($this->status),
            'user_type'=>'L'.$this->user_type,
            'approver_name'=>$approver->name??'-',
            'approver_email'=>$approver->email??'-',
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
