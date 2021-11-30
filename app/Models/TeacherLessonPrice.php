<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherLessonPrice extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'lesson_1',
        'lesson_5',
        'lesson_10',
        'lesson_20',
    ];
}
