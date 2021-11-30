<?php

namespace App\Http\Requests\Company;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CompanyAccountUpdateRequest extends ApiRequest
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
            "title"     => "required",
            "email"     => Rule::unique('users')->ignore(Auth::user()->id, 'id'),
            "name"      => Rule::unique('users')->ignore(Auth::user()->id, 'id'),
            "logo"      => "required",
        ];
    }
}
