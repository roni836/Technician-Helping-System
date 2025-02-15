<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandProblem extends Model
{
    protected $fillable = ['brand_id', 'problem_id','device_id'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function problem()
    {
        return $this->belongsTo(Problem::class);
    }
    
    public function device()
    {
        return $this->belongsTo(Device::class);
    }
    public function questionTree()
    {
        return $this->hasOne(QuestionTree::class);
    }
}
