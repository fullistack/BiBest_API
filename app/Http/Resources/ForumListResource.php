<?php

namespace App\Http\Resources;

use App\Models\ForumTheme;
use App\Models\ForumThemeMessage;
use Illuminate\Http\Resources\Json\JsonResource;

class ForumListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $themes_ids = $this->themes->map(function (ForumTheme $theme){
            return $theme->id;
        });
        $last_message = ForumThemeMessage::query()->whereIn("theme_id",$themes_ids)->orderByDesc("created_at")->first();
        return [
            "id" => $this->id,
            "title" => $this->title,
            "theme_count" => $this->themes->count(),
            "last_message" => $last_message->created_at
        ];
    }
}
