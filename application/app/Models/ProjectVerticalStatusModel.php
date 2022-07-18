<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProjectVerticalStatusModel extends Model
{
    use HasFactory,SoftDeletes;
	protected $table='project_vertical_status';

	public function getUser()
    {
        return $this->hasOne('App\Models\User', 'id', 'added_by');
    }
    public function getApproverName()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function getRoleName()
    {
        return $this->belongsTo('App\Models\RolesModel', 'role', 'id');
    }

}
