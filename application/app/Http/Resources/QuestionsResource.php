<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionsResource extends JsonResource
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
            'form_id' => $this->form_id,
            'question' => $this->question,
            'element_type' => $this->element_type,
            'options'=>$this->getOptions
        ];
    }
}
