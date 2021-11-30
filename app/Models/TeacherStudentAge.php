<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherStudentAge extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'age_id'
    ];

    function age(){
        return $this->belongsTo(StudentAge::class,"age_id","id");
    }
}
