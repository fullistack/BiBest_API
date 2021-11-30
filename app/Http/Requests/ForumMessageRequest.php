<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForumMessageRequest extends ApiRequest
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
            "message" => "required",
            "message_id" => "exists:forum_theme_messages,id"
        ];
    }
}
