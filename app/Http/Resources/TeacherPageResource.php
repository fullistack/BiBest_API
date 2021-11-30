<?php

namespace App\Http\Resources;

use App\Calendar\Calendar;
use App\Models\TeacherLanguageCommunication;
use App\Models\TeacherLanguageLearning;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherPageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id"            => $this->id,
            "country_iso"   => $this->country_iso,
            "full_name"     => $this->full_name,
            "avatar"        => $this->avatar,
            "learning_languages" => $this->languagesLearning->map(function (TeacherLanguageLearning $TLL){
                return $TLL->language_code;
            }),
            "communication_languages" => $this->languagesCommunication->map(function (TeacherLanguageCommunication $TLC){
                return $TLC->language_code;
            }),
            "end_lesson_count"  => $this->lessons()->where("date_start","<",Carbon::now())->count(),
            "students_count"  => $this->lessons()->where("date_start",">",Carbon::now())->get()
                ->map(function ($lesson){
                    return $lesson->students->count();
                })->sum(),
            "about" => $this->about,
            "video_welcome" => $this->video_welcome,
            "calendar" => Calendar::make($this->lessons,$this->courses),
            "lessons"  => GroupLessonResource::collection($this->lessons->take(2)),
            "courses"  => CourseResource::collection($this->courses->take(2)),
            'conversational_accents' => $this->conversationalAccents->map(function ($conversationalAccents){
                return $conversationalAccents->accent->id;
            }),
            'student_ages' => $this->studentsAge->map(function ($studentsAge){
                return $studentsAge->age->id;
            }),
            'learning_aspect' => $this->learningAspect->map(function ($learningAspect){
                return $learningAspect->aspect->id;
            }),
            'diplomas' => $this->diplomas,
            'experiences' => $this->experiences,
            'educations' => $this->educations,

        ];
    }
}
