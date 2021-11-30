<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherLearningAspect extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        "teacher_id",
        "aspect_id"
    ];

    function aspect(){
        return $this->belongsTo(LearningAspect::class,"aspect_id","id");
    }
}
