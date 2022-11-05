<?php

namespace App\Http\Requests\web;

use Illuminate\Foundation\Http\FormRequest;

class HotelsRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        if ($this->has('status')){
            $this->merge(['status'=>(int)$this->status]);
        }
    }
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
                'hotel_name' => 'required|min:3|max:100',
                'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
                'password' => 'required|min:3|max:16',
                'status' => 'required|in:1,2'
            ];
        }
        if ($this->isMethod('PUT')){
            $user_id = (int)$this->route("user");
            return [
                'hotel_name' => 'required|min:3|max:100',
                'status' => 'required|in:1,2'
            ];
        }
    }
}
