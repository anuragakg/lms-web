<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProductSubcategoryModel extends Model
{
    use HasFactory,SoftDeletes;
    protected $table='product_subcategory';
    
    public function getCategory()
    {
        return $this->belongsTo('App\Models\ProcductCategoryModel', 'category_id', 'id');
    }
    public function getVertical()
    {
        return $this->belongsTo('App\Models\ProductVerticalModel', 'product_vertical_id', 'id');
    }
    public function getForm()
    {
        return $this->belongsTo('App\Models\ProcductFormModel', 'product_form_mini_id', 'id');
    }
    public function getLead()
    {
        return $this->belongsTo('App\Models\ProcductFormModel', 'product_form_lead_id', 'id');
    }

    /**
     * Get User Details
     *
     * @return mixed
     */
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
        return $this->hasMany('App\Models\ProjectSubCategoryStatusModel', 'form_id', 'id');
    }
}
