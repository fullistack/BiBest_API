<?php

namespace App\Http\Controllers\Profile\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StudentAccountUpdateRequest;
use App\Http\Requests\Student\StudentInfoUpdateRequest;
use App\Http\Resources\StudentProfileResource;
use App\Models\Course;
use App\Models\GroupLesson;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentProfileController extends Controller
{
    function index(){
        $student = Auth::user()->student;
        $lessons_ids = $student->lessons->map(function ($GLS){
            return $GLS->group_lesson_id;
        });
        $student['lessons'] = GroupLesson::query()->whereIn("id",$lessons_ids)
            ->where("date_start",">",Carbon::now())->get();
        $courses_ids = $student->courses->map(function ($GLS){
            return $GLS->course_id;
        });
        $student['courses'] = Course::query()->whereIn("id",$courses_ids)
            ->where("date_start",">",Carbon::now())->get();
        return $this->response(StudentProfileResource::make($student));
    }

    function updateAccount(StudentAccountUpdateRequest $request){
        $student_data = $request->only("full_name","avatar");
        $user_data = $request->only("email","phone","password","name");
        $user = Auth::user();
        $user->update($user_data);
        $user->student()->update($student_data);
        return $this->response(true);
    }

    function updateInfo(StudentInfoUpdateRequest $request){
        $user_settings_data = $request->only("language_code","time_zone");
        $student_data = $request->only("country_iso");

        $user = Auth::user();

        if($user_settings_data){
            $user->settings()->update($user_settings_data);
        }

        if($student_data){
            $user->student()->update($student_data);
        }

        return $this->response(true);
    }
}
