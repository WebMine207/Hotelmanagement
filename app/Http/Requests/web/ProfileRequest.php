<?php

namespace App\Http\Requests\web;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileRequest extends FormRequest
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
        $user_id = Auth::user()->id;
        return [
            'username' => 'required|min:3|max:100',
            'email' => 'required|email|unique:users,email,'.$user_id.',id,deleted_at,NULL',
        ];
    }

    public function messages()
    {
        return [
            'username' => 'The name field is required',
            'username.min' => 'The name must be at least 3 characters.',
            'username.max' => 'The name must not be greater than 100 characters.',
        ];
    }
}
