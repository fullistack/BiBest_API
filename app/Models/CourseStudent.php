<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseStudent extends Model
{
    use HasFactory;

    public $timestamps = false;

    const STATUSES = ["invited","paid","excluded"];

    const STATUS_INVITED = "invited";
    const STATUS_PAID = "paid";
    const STATUS_EXCLUDED = "excluded";

    protected $fillable = [
        'student_id',
        'text',
        'status'
    ];

    protected $casts = [
        "student_id" => "integer"
    ];

    function student(){
        return $this->belongsTo(Student::class,"student_id",'id');
    }
}
