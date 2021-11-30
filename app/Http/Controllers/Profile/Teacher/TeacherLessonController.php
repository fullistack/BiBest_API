<?php

namespace App\Http\Controllers\Profile\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\TeacherLessonStoreRequest;
use App\Http\Requests\Teacher\TeacherLessonStudentAddRequest;
use App\Http\Requests\Teacher\TeacherLessonStudentDeleteRequest;
use App\Http\Resources\GroupLessonResource;
use App\Http\Resources\GroupLessonStudent;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherLessonController extends Controller
{
    /**
     * @var Teacher
     */
    private $teacher;

    function __construct()
    {
        parent::__construct();
        if(Auth::user()){
            $this->teacher = Auth::user()->teacher;
        }else{
            return response()->redirectToRoute("auth.unauthorized");
        }
    }

    function store(TeacherLessonStoreRequest $request){
        $lesson_data = $request->only("title","description","date_start","time_start","price","students_max_count","lesson_duration_id","training_level_id","student_age_id","image");
        $lesson = $this->teacher->lessons()->create($lesson_data);
        return $this->response(GroupLessonResource::make($lesson));
    }

    function update(TeacherLessonStoreRequest $request,$id){
        $lesson_data = $request->only("title","description","date_start","time_start","price","students_max_count","lesson_duration_id","training_level_id","student_age_id","image");
        $this->teacher->lessons()->findOrFail($id)->update($lesson_data);
        return $this->response(true,204);
    }

    function show($id){
        $lesson = $this->teacher->lessons()->with("students")->findOrFail($id);
        return $this->response(GroupLessonResource::make($lesson));
    }

    function student_add(TeacherLessonStudentAddRequest $request,$id){
        $student_id = $request->get("student_id");
        $student = $this->getLesson($id)->students()->create(['student_id' => $student_id]);
        return $this->response($student);
    }

    function student_delete(TeacherLessonStudentDeleteRequest $request,$id,$student_id){
        $this->getLesson($id)->students
            ->where("student_id",$student_id)
            ->firstOrFail()
            ->update([
                'status' => \App\Models\GroupLessonStudent::STATUS_EXCLUDED,
                'text'   => $request->get("text","")
            ]);
        return $this->response(true);
    }

    private function getLesson($lesson_id){
        return $this->teacher->lessons()->findOrFail($lesson_id);
    }

}
