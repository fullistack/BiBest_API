<?php

namespace App\Http\Controllers\Profile\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CompanyCoursePlanUpdateRequest;
use App\Http\Requests\Company\CompanyCourseStoreRequest;
use App\Http\Requests\Company\CompanyLessonStudentAddRequest;
use App\Http\Requests\Company\CompanyLessonStudentDeleteRequest;
use App\Http\Resources\CourseResource;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyCourseController extends Controller
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

    function show($id){
        return $this->response(CourseResource::make($this->getCourse($id)));
    }

    function store(CompanyCourseStoreRequest $request){
        $course_date = $request->only(array_keys($request->rules()));
        $course = $this->company->courses()->create($course_date);
        return $this->response(CourseResource::make($course));
    }

    function update(CompanyCourseStoreRequest $request,$id){
        $course_date = $request->only(array_keys($request->rules()));
        $this->getCourse($id)->update($course_date);
        return $this->response(true,204);
    }

    function student_add(CompanyLessonStudentAddRequest $request,$id){
        $student_id = $request->get("student_id");
        $student = $this->getCourse($id)->students()->create(['student_id' => $student_id]);
        return $this->response($student);
    }

    function student_delete(CompanyLessonStudentDeleteRequest $request,$id,$student_id){
        $this->getCourse($id)->students
            ->where("student_id",$student_id)
            ->firstOrFail()
            ->update([
                'status' => \App\Models\CourseStudent::STATUS_EXCLUDED,
                'text'   => $request->get("text","")
            ]);
        return $this->response(true);
    }

    function plan(CompanyCoursePlanUpdateRequest $request,$id){
        $this->getCourse($id)->plans()->delete();
        foreach ($request->all() as $plan){
            $this->getCourse($id)->plans()->create($plan);
        }
        return $this->response(true,204);
    }

    function getCourse($id){
        return $this->company->courses()->findOrFail($id);
    }
}
