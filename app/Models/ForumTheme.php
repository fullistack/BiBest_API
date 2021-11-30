<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumTheme extends Model
{
    use HasFactory;

    Const TYPES = [self::TYPE_FIXED,self::TYPE_IMPORTANT,self::TYPE_URGENT,self::TYPE_NORMAL];
    Const TYPE_IMPORTANT = "important";
    Const TYPE_URGENT = "urgent";
    Const TYPE_FIXED = "fixed";
    Const TYPE_NORMAL = "normal";

    protected $fillable = [
        "forum_id",
        "user_id",
        "title",
        "type",
        'created_at'
    ];

    function messages(){
        return $this->hasMany(ForumThemeMessage::class,"theme_id","id");
    }

    function user(){
        return $this->belongsTo(User::class,"user_id","id");
    }
}
