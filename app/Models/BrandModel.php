<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandModel extends Model {
    use HasFactory;
    
    protected $fillable = ['brand_id', 'modelno_id','device_id'];

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function modelno()
    {
        return $this->belongsTo(ModelNo::class, 'modelno_id');
    }
    
    public function questionTree()
    {
        return $this->hasOne(QuestionTree::class);
    }
    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
