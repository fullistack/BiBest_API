<?php

use Illuminate\Support\Facades\Route;

Route::get("/",function (){
    $data = [
        "student" => \App\Models\Student::all()->random(1)->first()->user->email,
        "teacher" => \App\Models\Teacher::all()->random(1)->first()->user->email,
        "company" => \App\Models\Company::all()->random(1)->first()->user->email,
        "admin" => null
    ];
    return view("index",$data);
});
