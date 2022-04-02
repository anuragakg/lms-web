<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentListResource extends JsonResource
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
            'lead_id' => $this->lead_id,
            'getLeadUser' => $this->getLeadUser,
            'program_id' => $this->program_id,
            'getProgramInfo' => $this->getProgramInfo,
            'installment_total' => $this->installment_total,
            'gross_payable' => $this->gross_payable,
            'exemption' => $this->exemption,
            'base_fee' => $this->base_fee,
            //'gst_applicable' => $this->gst_applicable,
            'net_base_fee' => $this->net_base_fee,
            'total_received' => $this->total_received,
            'balance_due' => $this->balance_due,
            'added_by' => $this->added_by,
            'added_by_name' => $this->getAddedBy->name,
            //'getInstallments' => PaymentInstallmentResource::collection($this->getInstallments),
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
