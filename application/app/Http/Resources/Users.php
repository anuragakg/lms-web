<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Auth;
class Users extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role_id' => $this->role,
            'role' => isset($this->getRole->title)?$this->getRole->title:'-',
            'phone' => $this->phone,
            'emp_code' => $this->emp_code,
            'dept' => $this->dept,
            'designation' => $this->designation,
            'rm' => $this->rm,
            'doj' => $this->doj,
           
            'created_at' => $this->created_at->format('d/m/Y H:i'),
            'updated_at' => $this->updated_at->format('d/m/Y H:i'),
        ];
    }
}
