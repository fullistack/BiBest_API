<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'avatar',
        'country_iso',
        'full_name',
    ];

    function user(){
        return $this->belongsTo(User::class,"user_id","id");
    }

    function getAvatarAttribute($value){
        return URL::to("public/images/avatar/".$value);
    }

    function lessons(){
        return $this->hasMany(GroupLessonStudent::class,"student_id","id");
    }

    function courses(){
        return $this->hasMany(CourseStudent::class,"student_id","id");
    }
}
