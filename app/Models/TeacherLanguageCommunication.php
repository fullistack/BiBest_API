<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherLanguageCommunication extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['language_code'];
}
