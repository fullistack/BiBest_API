<?php

namespace App\Http\Resources;

use App\Models\ForumTheme;
use App\Models\ForumThemeMessage;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ForumThemesListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $last_message = ForumThemeMessage::query()->where("theme_id",$this->id)->orderByDesc("created_at")->first();
        return [
            "id" => $this->id,
            "title" => $this->title,
            "type" => $this->type,
            "created_at" => $this->created_at,
            "messages_count" => $this->messages->count(),
            "user" => [
                "id" => $this->user->id,
                "name" => $this->user->getUserName()
            ],
            "updated_at" => [
                "date" => $last_message->created_at,
                "user" => [
                    "id" => $last_message->user->id,
                    "name" => $last_message->user->getUserName()
                ],
            ],
        ];
    }
}
