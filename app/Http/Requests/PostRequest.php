<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|string',
            'description' => 'required|string',
            'content' => 'required|string',
            'language' => ['required', 'string', 'regex:/^(ua|ru|en)$/'],
            'tags' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'language.regex' => 'Please enter only a current locale: ua, ru, en!'
        ];
    }
}
