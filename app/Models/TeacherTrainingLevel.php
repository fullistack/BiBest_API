<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherTrainingLevel extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'level_id'
    ];

    function level(){
        return $this->belongsTo(TrainingLevel::class,"level_id","id");
    }
}
