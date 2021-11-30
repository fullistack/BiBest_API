<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class GroupLesson extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "description",
        "date_start",
        "time_start",
        "price",
        "students_max_count",
        "teacher_id",
        "lesson_duration_id",
        "training_level_id",
        "student_age_id",
        "image"
    ];

    public function students(){
        return $this->hasMany(GroupLessonStudent::class,"group_lesson_id","id")
            ->with("student");
    }

    public function duration(){
        return $this->belongsTo(LessonDuration::class,"lesson_duration_id","id");
    }

    public function trainingLevel(){
        return $this->belongsTo(TrainingLevel::class,"training_level_id","id");
    }

    public function studentAge(){
        return $this->belongsTo(StudentAge::class,"student_age_id","id");
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class,"teacher_id","id");
    }

    public function company(){
        return $this->belongsTo(Company::class,"company_id","id");
    }

    function getImageAttribute($value){
        return URL::to("public/images/lesson/".$value);
    }
}
