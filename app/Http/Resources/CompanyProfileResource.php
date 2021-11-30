<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyProfileResource extends JsonResource
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
            "title"                         => $this->title,
            "country_iso"                   => $this->country_iso,
            "city"                          => $this->city,
            "address"                       => $this->address,
            "post"                          => $this->post,
            "logo"                          => $this->logo,
            "inn"                           => $this->inn,

            "OGRN"                          => $this->info->OGRN,
            "organization_current_account"  => $this->info->organization_current_account,
            "KPP"                           => $this->info->KPP,
            "correspondent_bank_account"    => $this->info->correspondent_bank_account,
            "BIK_bank"                      => $this->info->BIK_bank,
            "OKPO"                          => $this->info->OKPO,

            "name"                          => $this->user->name,
            "phone"                         => $this->user->phone,
            "email"                         => $this->user->email,

            "language_code"                 => $this->user->settings->language_code,
            "time_zone"                     => $this->user->settings->time_zone,

            'lessons'  => GroupLessonResource::collection($this->lessons),
            'courses'  => CourseResource::collection($this->courses),
            'reviews'  => ReviewResource::collection($this->reviews()),
        ];
    }
}
