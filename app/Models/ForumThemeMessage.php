<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumThemeMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        "theme_id",
        "user_id",
        "message_id",
        "message",
        'created_at'
    ];

    function user(){
        return $this->belongsTo(User::class,"user_id","id");
    }
}
