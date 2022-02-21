<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductFormDetailResource extends JsonResource
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
            'title' => $this->title,
            'type' => $this->type,
            'type_text' => get_form_type($this->type),
            'status' => $this->status,
            'controls' => $this->getControls,
            
            'added_by' => $this->getAddedBy,
            'approved_by' => $this->getApprovedBy,
           
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
