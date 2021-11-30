<?php

namespace App\Http\Resources;

use App\Models\LearningLanguage;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherProfileResource extends JsonResource
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
            "id" => $this->user->id,
            "gender" => $this->user->gender,
            'full_name' => $this->full_name,
            'avatar' => $this->avatar,
            'passport' => $this->passport,
            'country_iso' => $this->country_iso,
            'city' => $this->city,
            'address' => $this->address,
            'about' => $this->about,
            'name' => $this->user->name,
            'phone' => $this->user->phone,
            'email' => $this->user->email,
            'language_code' => $this->user->settings->language_code,
            'time_zone' => $this->user->settings->time_zone,
            'learning_languages' => $this->languagesLearning->map(function ($learningLanguage){
                return $learningLanguage->language_code;
            }),
            'student_ages' => $this->studentsAge->map(function ($studentsAge){
                return $studentsAge->age->id;
            }),
            'training_subjects' => $this->trainingSubjects->map(function($trainingSubjects){
                return $trainingSubjects->subject->id;
            }),
            'lesson_prices' => $this->lessonsPrice,
            'training_levels' => $this->trainingLevel->map(function ($trainingLevel){
                return $trainingLevel->level->id;
            }),
            'conversational_accents' => $this->conversationalAccents->map(function ($conversationalAccents){
                return $conversationalAccents->accent->id;
            }),
            'lesson_contents' => $this->lessonContent->map(function ($lessonContent){
                return $lessonContent->content;
            }),
            'communication_languages' => $this->languagesCommunication->map(function ($languageCommunication){
                return $languageCommunication->language_code ;
            }),
            'tests' => $this->tests->map(function ($tests){
                return $tests->test;
            }),
            'educations' => $this->educations->map(function ($education){
                return $education->education;
            }),
            'experiences' => $this->experiences->map(function ($experience){
                return $experience->experience;
            }),
            'diplomas' => $this->diplomas->map(function ($diploma){
                return $diploma->diploma;
            }),
            'lessons'  => GroupLessonResource::collection($this->lessons),
            'reviews'  => ReviewResource::collection($this->reviews()),
        ];
    }
}
