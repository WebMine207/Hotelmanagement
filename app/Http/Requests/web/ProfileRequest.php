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
            'first_name' => 'required|min:3|max:100',
            'last_name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:users,email,'.$user_id.',id,deleted_at,NULL',
        ];
    }

    public function messages()
    {
        return [
            'first_name' => 'Enter your first name',
            'first_name.min' => 'The name must be at least 3 characters.',
            'first_name.max' => 'The name must not be greater than 100 characters.',
            'last_name' => 'Enter your last name',
            'last_name.min' => 'The name must be at least 3 characters.',
            'last_name.max' => 'The name must not be greater than 100 characters.',
            'email' =>  'Enter your email',
        ];
    }
}
