<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;
    protected $table = 'forms';

    public function getQuestions()
    {
        return $this->hasMany('App\Models\Questions', 'form_id', 'id');
    }
}
