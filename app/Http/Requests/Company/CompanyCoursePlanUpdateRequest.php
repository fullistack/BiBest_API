<?php

namespace App\Http\Requests\Company;

use App\Http\Requests\ApiRequest;
use App\Models\CoursePlan;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyCoursePlanUpdateRequest extends ApiRequest
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
//            "type"          => ['required','array'],
//            "title"         => ['required','array'],
//            "duration"      => ['required','array'],
//            "date_start"    => ['required','array'],

            "*.type"        => ['required',Rule::in(CoursePlan::TYPES)],
            "*.title"       => ['required'],
            "*.duration"    => ['required','integer'],
            "*.date_start"  => ["required","date"],
        ];
    }
}
