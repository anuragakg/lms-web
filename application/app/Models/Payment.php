<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    public function getAddedBy()
    {
        return $this->belongsTo('App\Models\User', 'added_by','id' );
    }
    public function getLeadUser()
    {
        return $this->belongsTo('App\Models\Lead', 'lead_id','id' );
    }
    public function getProgramInfo()
    {
        return $this->belongsTo('App\Models\Program', 'program_id','id' );
    }
    public function getInstallments()
    {
        return $this->hasMany('App\Models\PaymentInstallment', 'payment_id','id' );
    }
}
