<?php

namespace App\Http\Resources;
use App\Http\Resources\StatusResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Auth;
class ProjectStatusResource extends JsonResource
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
            'status' => StatusResource::collection($this->getStatus),
            
        ];
    }
}
