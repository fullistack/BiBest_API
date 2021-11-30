<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursePlan extends Model
{
    use HasFactory;

    public $timestamps = false;

    const TYPE_LESSON = "lesson";
    const TYPE_WORK = "work";
    const TYPE_TEST = "test";

    const TYPES = [self::TYPE_LESSON,self::TYPE_TEST,self::TYPE_WORK];

    protected $fillable = [
        "type",
        "title",
        "date_start",
        "duration"
    ];
}
