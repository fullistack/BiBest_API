<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StudentAccountUpdateRequest extends FormRequest
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
            "email"         => Rule::unique('users')->ignore(Auth::user()->id, 'id'),
            "name"          => Rule::unique('users')->ignore(Auth::user()->id, 'id'),
            "avatar"        => "required",
        ];
    }
}
