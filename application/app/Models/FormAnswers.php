<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormAnswers extends Model
{
    use HasFactory;
    public function getAnswers()
    {
        return $this->hasMany('App\Models\QuestionsAnswer', 'formsAnswers_id', 'id');
    }
}
