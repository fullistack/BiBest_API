<?php

namespace App\Http\Controllers\Profile\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CompanyLessonStoreRequest;
use App\Http\Requests\Company\CompanyLessonStudentAddRequest;
use App\Http\Requests\Company\CompanyLessonStudentDeleteRequest;
use App\Http\Resources\GroupLessonResource;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyLessonController extends Controller
{
    /**
     * @var Company
     */
    private $company;

    function __construct()
    {
        parent::__construct();
        if(Auth::user()){
            $this->company = Auth::user()->company;
        }else{
            return response()->redirectToRoute("auth.unauthorized");
        }
    }

    function store(CompanyLessonStoreRequest $request){
        $lesson_data = $request->only("title","description","date_start","time_start","price","students_max_count","lesson_duration_id","training_level_id","student_age_id","image","teacher_id");
        $lesson = $this->company->lessons()->create($lesson_data);
        return $this->response(GroupLessonResource::make($lesson));
    }

    function update(CompanyLessonStoreRequest $request,$id){
        $lesson_data = $request->only("title","description","date_start","time_start","price","students_max_count","lesson_duration_id","training_level_id","student_age_id","image","teacher_id");
        $this->getLesson($id)->update($lesson_data);
        return $this->response(true,204);
    }

    function show($id){
        $lesson = $this->company->lessons()->with("students")->findOrFail($id);
        return $this->response(GroupLessonResource::make($lesson));
    }

    function student_add(CompanyLessonStudentAddRequest $request,$id){
        $student_id = $request->get("student_id");
        $student = $this->getLesson($id)->students()->create(['student_id' => $student_id]);
        return $this->response($student);
    }

    function student_delete(CompanyLessonStudentDeleteRequest $request,$id,$student_id){
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
        return $this->company->lessons()->findOrFail($lesson_id);
    }
}
