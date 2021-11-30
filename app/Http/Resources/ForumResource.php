<?php

namespace App\Http\Resources;

use App\Models\ForumTheme;
use App\Models\ForumThemeMessage;
use Illuminate\Http\Resources\Json\JsonResource;

class ForumResource extends JsonResource
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
            "title" => $this->title,
            "themes" => ForumThemesListResource::collection($this->themes)
        ];
    }
}
