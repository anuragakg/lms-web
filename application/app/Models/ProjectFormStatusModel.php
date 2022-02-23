<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectFormStatusModel extends Model
{
    use HasFactory;
    protected $table='project_form_status';
	
	public function getApprovedBy()
    {
        return $this->belongsTo('App\Models\User', 'updated_by','id');
    }
}
