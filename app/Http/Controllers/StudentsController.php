<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    function index(){
        $students = Student::query()->with("user")->get();
        return $this->response(StudentResource::collection($students));
    }
}
