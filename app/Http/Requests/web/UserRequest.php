<?php

namespace App\Http\Requests\web;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if ($this->isMethod('POST')){
            return [
                'first_name' => 'required|min:3|max:100',
                'last_name' => 'required|min:3|max:100',
                'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
                'status' => 'required|in:1,2'
            ];
        }
       

    }

    public function messages()
    {
        return [
            'first_name' => 'The first name field is required',
            'last_name' => 'The last name field is required',
            'email' => 'The email field is required.',
        ];
    }
}
