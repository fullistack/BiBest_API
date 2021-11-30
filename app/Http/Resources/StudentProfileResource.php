<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentProfileResource extends JsonResource
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
            "id"                            => $this->user->id,
            "gender"                        => $this->user->gender,
            "full_name"                     => $this->full_name,
            "country_iso"                   => $this->country_iso,
            'avatar'                        => $this->avatar,
            'name'                          => $this->user->name,
            'phone'                         => $this->user->phone,
            'email'                         => $this->user->email,
            "language_code"                 => $this->user->settings->language_code,
            "time_zone"                     => $this->user->settings->time_zone,
            "lessons"                       => GroupLessonResource::collection($this->lessons),
            "courses"                       => CourseResource::collection($this->courses),
        ];
    }
}
