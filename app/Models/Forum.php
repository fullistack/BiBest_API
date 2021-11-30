<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    protected $fillable = [
        "title"
    ];

    function themes(){
        return $this->hasMany(ForumTheme::class,"forum_id","id");
    }
}
