<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        "title","inn","country_iso","city","address","post","logo"
    ];

    function user(){
        return $this->belongsTo(User::class,"user_id","id");
    }

    function info(){
        return $this->hasOne(CompanyInfo::class,"company_id","id");
    }

    function getLogoAttribute($value){
        return URL::to("public/images/avatar/".$value);
    }

    function courses(){
        return $this->hasMany(Course::class,"company_id","id");
    }

    function lessons(){
        return $this->hasMany(GroupLesson::class,"company_id","id");
    }

    function reviews(){
        return $this->user->reviews->map(function (UserReview $review){
             $review->like = $review->likes->where("value",1)->count();
             $review->dislike = $review->likes->where("value",-1)->count();
             return $review;
        });
    }
}
