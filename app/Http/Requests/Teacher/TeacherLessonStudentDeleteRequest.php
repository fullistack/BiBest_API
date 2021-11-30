<?php

namespace App\Http\Requests\Teacher;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\GroupLessonStudent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TeacherLessonStudentDeleteRequest extends ApiRequest
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
            'text'      => 'required',
        ];
    }
}
