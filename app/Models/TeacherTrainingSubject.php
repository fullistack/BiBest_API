<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherTrainingSubject extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'subject_id'
    ];

    function subject(){
        return $this->belongsTo(TraningSubject::class,"subject_id","id");
    }
}
