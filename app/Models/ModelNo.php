<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelNo extends Model
{
    use HasFactory;
    protected $table = 'modelnos';
    protected $fillable = ['model_number'];
}
