<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupLessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $start_time_obj = Carbon::make($this->date_start." ".$this->time_start);
        $duration = $this->duration->duration;
        $h = intval($duration);
        $m = ( $duration - $h ) * 60;
        $time_start = $start_time_obj->toTimeString("minutes");
        $time_end = $start_time_obj->addHours($h)->addMinutes($m)->toTimeString("minutes");
        return [
            "id"                    => $this->id,
            "title"                 => $this->title,
            "description"           => $this->description,
            "date_start"            => $this->date_start,
            "time_start"            => $time_start,
            "time_end"              => $time_end,
            "image"                 => $this->image,
            "price"                 => $this->price,
            "students"              => $this->whenLoaded("students",function (){
                return GroupLessonStudent::collection($this->students->filter(function ($student){
                    return $student->status != \App\Models\GroupLessonStudent::STATUS_EXCLUDED;
                }));
            }),
            "students_count"        => $this->students->whereIn("status",[\App\Models\GroupLessonStudent::STATUS_INVITED,\App\Models\GroupLessonStudent::STATUS_PAID])->count(),
            "students_max_count"    => $this->students_max_count,
            "duration"              => $this->duration,
            "lesson_duration_id"    => $this->duration->id,
            "training_level_id"     => $this->trainingLevel->id,
            "student_age_id"        => $this->studentAge->id,
            "teacher"               => TeacherResource::make($this->teacher),
            "company"               => CompanyResource::make($this->company)
        ];
    }
}
