<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReview extends Model
{
    use HasFactory;

    function likes(){
        return $this->hasMany(UserReviewLike::class,"review_id","id");
    }

    function reviewer(){
        return $this->belongsTo(User::class,"reviewer_id","id");
    }

    function user(){
        return $this->belongsTo(User::class,"user_id","id");
    }
}
