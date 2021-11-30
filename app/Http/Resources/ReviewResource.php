<?php

namespace App\Http\Resources;

use App\Models\ForumThemeMessage;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            "id" => $this->id,
            "language_code" => $this->language_code,
            "review" => $this->review,
            "like" => $this->like,
            "dislike" => $this->dislike,
            "created_at" => $this->created_at,
            "user" => [
                "name" => $this->reviewer->getUserName(),
                "avatar" => $this->reviewer->getUserAvatar(),
                "end_lesson_count"  => $this->reviewer->isTeacher() ?
                    $this->reviewer->teacher->lessons()->where("date_start","<",Carbon::now())->count() :
                    null,
            ]
        ];
    }
}
