<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            "id"                    => $this->id,
            "title"                 => $this->title,
            "description"           => $this->description,
            "date_start"            => $this->date_start,
            "time_start"            => $this->time_start,
            "image"                 => $this->image,
            "price"                 => $this->price,
            "students_count"        => $this->students->whereIn("status",[\App\Models\CourseStudent::STATUS_INVITED,\App\Models\CourseStudent::STATUS_PAID])->count(),
            "students_max_count"    => $this->students_max_count,
            "lessons_duration"      => $this->lessons_duration,
            "works_duration"        => $this->works_duration,
            "tests_duration"        => $this->tests_duration,
            "training_level_id"     => $this->trainingLevel->id,
            "student_age_id"        => $this->studentAge->id,
            "teacher"               => TeacherResource::make($this->teacher),
            "plans"                 => PlanResource::collection($this->plans),
            "students"              => GroupLessonStudent::collection($this->whenLoaded('students')),
        ];
    }
}
