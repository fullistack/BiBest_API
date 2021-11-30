<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherConversationalAccents extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'accent_id'
    ];

    function accent(){
        return $this->belongsTo(ConversationalAccent::class,"accent_id","id");
    }
}
