<?php

namespace App\Http\Requests\Teacher;

use App\Http\Requests\ApiRequest;
use Illuminate\Validation\Rule;

class TeacherLessonStoreRequest extends ApiRequest
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
            "description"           => ["required"],
            "image"                 => ["required"],
            "date_start"            => ["required","date"],
            "time_start"            => ["required","date_format:H:i"],
            "price"                 => ["required","integer"],
            "students_max_count"    => ["required","integer"],
            "teacher_id"            => [Rule::exists("teachers","id")],
            "lesson_duration_id"    => ['required',Rule::exists("lesson_durations","id")],
            "training_level_id"     => ['required',Rule::exists("training_levels","id")],
            "student_age_id"        => ['required',Rule::exists("student_ages","id")],
        ];
    }
}
