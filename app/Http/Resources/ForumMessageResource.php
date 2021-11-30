<?php

namespace App\Http\Resources;

use App\Models\ForumThemeMessage;
use Illuminate\Http\Resources\Json\JsonResource;

class ForumMessageResource extends JsonResource
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
            "message" => $this->message,
            "message_id" => $this->message_id,
            "created_at" => $this->created_at,
            "user" => [
                "name" => $this->user->getUserName(),
                "avatar" => $this->user->getUserAvatar(),
                "created_at" => $this->user->created_at,
                "messages_count" => ForumThemeMessage::query()->where("user_id",$this->user->id)->count(),
            ]
        ];
    }
}
