<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['question_text', 'yes_child_id', 'no_child_id'];

    public function yesChild()
    {
        return $this->belongsTo(Question::class, 'yes_child_id');
    }
    public function noChild()
    {
        return $this->belongsTo(Question::class, 'no_child_id');
    }
}
