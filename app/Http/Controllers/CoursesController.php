<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Http\Resources\GroupLessonResource;
use App\Models\Course;
use App\Models\GroupLesson;
use App\Models\Teacher;
use App\Models\TeacherLanguageCommunication;
use App\Models\TeacherLanguageLearning;
use App\Models\TeacherLearningAspect;
use App\Models\TeacherStudentAge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoursesController extends Controller
{
    function index(Request $request){
        $limit = $request->get("limit",10);
        $offset = $request->get("offset",0);

        $learning_languages = $request->get("learning_languages",[]);
        $learning_time = $request->get("learning_time",[]);
        $teacher_country_iso = $request->get("teacher_country_iso",[]);
        $language_communication = $request->get("language_communication",[]);
        $lesson_price = $request->get("price",[0,1000000]);
        $student_age_id = $request->get("student_age_id",[]);
        $learning_aspect_id = $request->get("learning_aspect_id",[]);
        $gender             = $request->get("gender",["male","female"]);


        $teacher_country_iso = count($teacher_country_iso) == 1 ? $teacher_country_iso[0] : null;

        $lessons_query = Course::query()
            ->with("teacher");

        if(count($learning_time) == 1){
            $interval = explode("-",$learning_time[0]);
            $start = $interval[0].":00";
            $end = $interval[1].":00";
            $lessons_query = $lessons_query->whereBetween("time_start",[$start,$end]);
        }

        if(count($student_age_id) == 1){
            $lessons_query = $lessons_query->where("student_age_id",$student_age_id[0]);
        }

        $lessons_query = $lessons_query->whereBetween("price",$lesson_price);

        $lessons = $lessons_query->get();

        $teachers_ids = Teacher::all()->map(function (Teacher $teacher){
            return $teacher->id;
        });

        if(count($learning_aspect_id)){
            $teachers_ids = TeacherLearningAspect::query()
                ->whereIn("aspect_id",$learning_aspect_id)
                ->whereIn("teacher_id",$teachers_ids->toArray())
                ->get()->map(function (TeacherLearningAspect $tla){
                    return $tla->teacher_id;
                })->unique()->values();
        }

        if(count($learning_languages) > 0){
            $teachers_ids = TeacherLanguageLearning::query()
                ->whereIn("language_code",$learning_languages)
                ->whereIn("teacher_id",$teachers_ids->toArray())
                ->get()->map(function (TeacherLanguageLearning $tll){
                    return $tll->teacher_id;
                })->unique()->values();
        }

        if(count($language_communication) > 0) {
            $teachers_ids = TeacherLanguageCommunication::query()
                ->whereIn("language_code", $language_communication)
                ->whereIn("teacher_id",$teachers_ids->toArray())
                ->get()->map(function (TeacherLanguageCommunication $tlc) {
                    return $tlc->teacher_id;
                })->unique()->values();
        }

        $lessons = $lessons->filter(function (Course $course) use ($teachers_ids) {
            return $teachers_ids->contains($course->teacher->id);
        });

        if($teacher_country_iso){
            $lessons = $lessons->filter(function (Course $course) use ($teacher_country_iso) {
                return $course->teacher->country_iso == $teacher_country_iso;
            });
        }

        $lessons = $lessons->filter(function (Course $course) use ($gender){
            return in_array($course->teacher->user->gender,$gender);
        });

        $out = [
            "courses" => CourseResource::collection($lessons->skip($offset)->take($limit)),
            "count"   => $lessons->count()
        ];
        return $this->response($out);
    }

    function show($id){
        return $this->response(CourseResource::make(Course::find($id)));
    }

    function filters(){
        return [
            "learning_languages" => TeacherLanguageLearning::all()->map(function (TeacherLanguageLearning $TLL){
                return $TLL->language_code;
            })->unique()->values()->toArray(),
            "teacher_country_iso" => Teacher::query()->select(['country_iso'])->get()->map(function (Teacher $teacher){
                return $teacher->country_iso;
            })->unique()->values()->toArray(),
            "language_communication" => TeacherLanguageCommunication::all()->map(function (TeacherLanguageCommunication $TLC){
                return $TLC->language_code;
            })->unique()->values()->toArray(),
            "price" => [
                Course::query()->min("price"),
                Course::query()->max("price"),
            ],
            "student_age_id" => TeacherStudentAge::all()->map(function (TeacherStudentAge $TSA){
                return $TSA->age;
            })->unique()->values()->toArray(),
            "gender" => [
                "male",
                "female",
            ]
        ];
    }

    function sign_up($id){
        $course = Course::find($id);
        if($course->students_max_count > $course->students->count()){
            $course->students()->create([
                "student_id"    => Auth::user()->student->id,
                "status"        => \App\Models\GroupLessonStudent::STATUS_PAID
            ]);
            return $this->response(true);
        }else{
            return $this->response("student_max_count",403);
        }
    }
}
