<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'remember_token',
        "gender"
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    Const ROLE_STUDENT = "student";
    Const ROLE_TEACHER = "teacher";
    Const ROLE_COMPANY = "company";

    function student(){
        return $this->hasOne(Student::class);
    }

    function company(){
        return $this->hasOne(Company::class);
    }

    function teacher(){
        return $this->hasOne(Teacher::class);
    }

    function isStudent(){
        return $this->student !== null;
    }

    function isTeacher(){
        return $this->teacher !== null;
    }

    function isCompany(){
        return $this->company !== null;
    }

    function settings(){
        return $this->hasOne(UserSettings::class,"user_id","id");
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    function role(){
        if($this->company){
            return self::ROLE_COMPANY;
        }elseif($this->teacher){
            return self::ROLE_TEACHER;
        }elseif($this->student){
            return self::ROLE_STUDENT;
        }
    }

    function getUserName(){
        if($this->company){
            return $this->company->title;
        }elseif($this->teacher){
            return $this->teacher->full_name;
        }elseif($this->student){
            return $this->student->full_name;
        }
    }

    function getUserAvatar(){
        if($this->company){
            return $this->company->logo;
        }elseif($this->teacher){
            return $this->teacher->avatar;
        }elseif($this->student){
            return $this->student->avatar;
        }
    }

    function reviews(){
        return $this->hasMany(UserReview::class,"user_id","id")
            ->with("likes");
    }
}
