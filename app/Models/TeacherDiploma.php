<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class TeacherDiploma extends Model
{
    use HasFactory;

    protected $fillable = [
        "diploma"
    ];

    public $timestamps = false;

    function getDiplomaAttribute($value){
        return URL::to("public/images/diploma/".$value);
    }
}
