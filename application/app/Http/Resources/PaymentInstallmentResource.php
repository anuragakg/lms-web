<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentInstallmentResource extends JsonResource
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
            'payment_id' => $this->payment_id,
            'lead_id' => $this->lead_id,
            'installment_num' => $this->installment_num,
            'installment_date' => date('d-m-Y',strtotime($this->installment_date)),
            'installment_amount' => $this->installment_amount,
            'w_fee' => $this->w_fee,
            'gst' => $this->gst,
            'gst' => $this->gst,
            'total_received' => $this->total_received,
            'mop' => $this->mop,
            'received_by' => $this->received_by,
            'received_date' => $this->received_date!=null ? date('d-m-Y',strtotime($this->received_date)):'',
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
