<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionTree extends Model
{
    protected $guarded = [];

    public function brandProblem(){
        return $this->belongsTo(BrandProblem::class);
    } 

    public function rootQuestion(){
        return $this->belongsTo(Question::class, 'question_id');
    }
}
