<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;
    protected $table = 'forms_questions';
    public function getOptions()
    {
        return $this->hasMany('App\Models\Options', 'question_id', 'id');
    }
}
