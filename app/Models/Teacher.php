<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        "avatar",
        "passport",
        "country_iso",
        "city",
        "address"
    ];

    function educations(){
        return $this->hasMany(TeacherEducation::class,"teacher_id","id");
    }

    function experiences(){
        return $this->hasMany(TeacherExperience::class,"teacher_id","id");
    }

    function diplomas(){
        return $this->hasMany(TeacherDiploma::class,"teacher_id","id");
    }

    function languagesCommunication(){
        return $this->hasMany(TeacherLanguageCommunication::class,"teacher_id","id");
    }

    function languagesLearning(){
        return $this->hasMany(TeacherLanguageLearning::class,"teacher_id","id");
    }

    function studentsAge(){
        return $this->hasMany(TeacherStudentAge::class,"teacher_id","id");
    }

    function trainingSubjects(){
        return $this->hasMany(TeacherTrainingSubject::class,"teacher_id","id");
    }

    function lessonsPrice(){
        return $this->hasOne(TeacherLessonPrice::class,"teacher_id","id");
    }

    function conversationalAccents(){
        return $this->hasMany(TeacherConversationalAccents::class,"teacher_id","id");
    }

    function trainingLevel(){
        return $this->hasMany(TeacherTrainingLevel::class,"teacher_id","id");
    }

    function tests(){
        return $this->hasMany(TeacherTest::class,"teacher_id","id");
    }

    function lessonContent(){
        return $this->hasMany(TeacherLessonContent::class,"teacher_id","id");
    }

    function user(){
        return $this->belongsTo(User::class,"user_id","id");
    }

    function getAvatarAttribute($value){
        return URL::to("public/images/avatar/".$value);
    }

    function lessons(){
        return $this->hasMany(GroupLesson::class,"teacher_id","id")->orderBy("date_start");
    }

    function learningAspect(){
        return $this->hasMany(TeacherLearningAspect::class,"teacher_id","id");
    }

    function courses(){
        return $this->hasMany(Course::class,"teacher_id","id")->orderBy("date_start");;
    }

    function reviews(){
        return $this->user->reviews->map(function (UserReview $review){
            $review->like = $review->likes->where("value",1)->count();
            $review->dislike = $review->likes->where("value",-1)->count();
            return $review;
        });
    }

}
