<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProjectVerticalStatusModel extends Model
{
    use HasFactory,SoftDeletes;
	protected $table='project_vertical_status';
}
