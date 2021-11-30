<?php

namespace App\Http\Requests\Company;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyCourseStoreRequest extends ApiRequest
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
            "title"                 => ["required"],
            "date_start"            => ["required","date"],
            "time_start"            => ["required","date_format:H:i"],
            "training_level_id"     => ['required',Rule::exists("training_levels","id")],
            "student_age_id"        => ['required',Rule::exists("student_ages","id")],
            "students_max_count"    => ["required","integer"],
            "lessons_duration"      => ["required","integer"],
            "works_duration"        => ["required","integer"],
            "tests_duration"        => ["required","integer"],
            "description"           => ["required"],
            "image"                 => ["required"],
            "price"                 => ["required","integer"],
            "teacher_id"            => ["required",Rule::exists("teachers","id")],
        ];
    }
}
