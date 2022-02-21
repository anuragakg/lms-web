<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProcductFormModel;
class ProjectMiniCategoryModel extends Model
{
    use HasFactory;
	protected $table='project_mini_category';
	public function getForm()
    {
        return $this->belongsTo('App\Models\ProcductFormModel', 'product_form_mini_id', 'id');
    }
    public function getAddedBy()
    {
        return $this->belongsTo('App\Models\User', 'added_by', 'id');
    }
    public function getApprovedBy()
    {
        return $this->belongsTo('App\Models\User', 'approved_by', 'id');
    }
    public function getStatus()
    {
        return $this->hasMany('App\Models\ProjectMiniCategoryStatusModel', 'form_id', 'id');
    }
}
