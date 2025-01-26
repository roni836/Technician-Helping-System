<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionTree extends Model
{
    protected $guarded = [];

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function problem(){
        return $this->belongsTo(Problem::class);
    } 
    
    public function rootQuestion(){
        return $this->belongsTo(Question::class, 'question_id');
    }
}
