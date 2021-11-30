<?php

namespace App\Http\Requests\Teacher;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TeacherAccountUpdateRequest extends ApiRequest
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
            "full_name"     => "required",
            "gender"        => Rule::in(['male','female']),
            "email"         => Rule::unique('users')->ignore(Auth::user()->id, 'id'),
            "name"          => Rule::unique('users')->ignore(Auth::user()->id, 'id'),
            "avatar"        => "required",
        ];
    }
}
