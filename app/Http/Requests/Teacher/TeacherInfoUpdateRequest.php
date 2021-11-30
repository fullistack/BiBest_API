<?php

namespace App\Http\Requests\Teacher;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TeacherInfoUpdateRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'language_code' => Rule::exists("languages","code"),
            'country_iso' => Rule::exists("countries","iso"),
            'communication_languages.*' => Rule::exists("communication_languages","code"),
            'learning_languages.*' => Rule::exists("learning_languages","code"),
            'student_ages.*' => Rule::exists("student_ages","id"),
            'training_subjects.*' => Rule::exists("traning_subjects","id"),
            'lesson_prices.*' => "numeric",
            'training_levels.*' => Rule::exists("training_levels","id"),
            'conversational_accents.*' => Rule::exists("conversational_accents","id"),
            'lesson_contents' => 'array',
            'tests' => 'array',
            'educations' => 'array',
            'experiences' => 'array',
            'diplomas' => 'array',
        ];
    }
}
