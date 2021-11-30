<?php

namespace App\Http\Controllers;

use App\Http\Resources\TeacherPageResource;
use App\Http\Resources\GroupLessonResource;
use App\Http\Resources\TeacherCatalogResource;
use App\Http\Resources\TeacherResource;
use App\Models\GroupLesson;
use App\Models\Teacher;
use App\Models\TeacherLanguageCommunication;
use App\Models\TeacherLanguageLearning;
use App\Models\TeacherLearningAspect;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    function index(Request $request)
    {
        $limit = $request->get("limit", 10);
        $offset = $request->get("offset", 0);

        $learning_languages = $request->get("learning_languages", []);
        $learning_time = $request->get("learning_time", []);
        $teacher_country_iso = $request->get("teacher_country_iso", []);
        $language_communication = $request->get("language_communication", []);
        $lesson_price = $request->get("price", [0, 1000000]);
        $student_age_id = $request->get("student_age_id", []);
        $learning_aspect_id = $request->get("learning_aspect_id", []);
        $gender = $request->get("gender", ["male", "female"]);

        $teacher_country_iso = count($teacher_country_iso) == 1 ? $teacher_country_iso[0] : null;

        $lessons_query = GroupLesson::query()
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

        $lessons = $lessons->filter(function (GroupLesson $lesson) use ($teachers_ids) {
            return $teachers_ids->contains($lesson->teacher->id);
        });

        if($teacher_country_iso){
            $lessons = $lessons->filter(function (GroupLesson $lesson) use ($teacher_country_iso) {
                return $lesson->teacher->country_iso == $teacher_country_iso;
            });
        }

        $lessons = $lessons->filter(function (GroupLesson $lesson) use ($gender){
            return in_array($lesson->teacher->user->gender,$gender);
        });

        $lessons_ids = $lessons->map(function (GroupLesson $lesson){
            return $lesson->teacher_id;
        })->unique()->values()->toArray();

        $teachers = Teacher::query()
            ->whereIn("id",$lessons_ids)
            ->with("languagesCommunication")
            ->with("languagesLearning")
            ->get();

        $out = [
            "teachers" => TeacherCatalogResource::collection($teachers->skip($offset)->take($limit)),
            "count"   => $teachers->count()
        ];

        return $this->response($out);
    }

    function all(){
        $teachers = Teacher::all()->map(function (Teacher $teacher){
            return [
                "id" => $teacher->id,
                "full_name" => $teacher->full_name,
                "avatar" => $teacher->avatar,
            ];
        });
        return $this->response($teachers);
    }

    function show($id){
        $teacher = Teacher::find($id);
        return $this->response(TeacherPageResource::make($teacher));
    }
}
