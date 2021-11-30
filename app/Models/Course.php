<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        "company_id",
        "teacher_id",
        "title",
        "description",
        "date_start",
        "time_start",
        "image",
        "price",
        "students_max_count",
        "lessons_duration",
        "works_duration",
        "tests_duration",
        "training_level_id",
        "student_age_id",
    ];

    function plans(){
        return $this->hasMany(CoursePlan::class,"course_id","id");
    }

    public function students(){
        return $this->hasMany(CourseStudent::class,"course_id","id");
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

    function getImageAttribute($value){
        return URL::to("public/images/lesson/".$value);
    }
}
