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
                'name'                  => 'required|min:3|max:100',
                'email'                 => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
                'password'              => 'required|min:8|max:16',
                'phone_code'            => 'required',
                'mobile_number'         => 'required',
                'hotel_type'            => 'required',
                'description'           => 'required',
                'total_room'            => 'required',
                'guest'                 => 'required',
                'bedrooms'              => 'required',
                'bathrooms'              => 'required',
                'beds'                  => 'required',
                'address'               => 'required',
                'zip_code'              => 'required',
                'city'                  => 'required',
                'state'                 => 'required',
                'country'               => 'required',
                'price'                 => 'required',
                'discount_price'        => 'required',
                'weekend_base_price'    => 'required',
                'extra_person_fee'      => 'required',
                'convenience_charge'    => 'required',
                'security_deposit_fee'  => 'required',
                'good_and_service_tax'  => 'required',
                'cancelation_charge'    => 'required',
                // 'status'                => 'required|in:1,2'
            ];
        }
        if ($this->isMethod('PUT')){
            $user_id = (int)$this->route("user");
            return [
                'name'                  => 'required|min:3|max:100',
                'email'                 => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
                'password'              => 'required|min:8|max:16',
                'phone_code'            => 'required',
                'mobile_number'         => 'required',
                'hotel_type'            => 'required',
                'description'           => 'required',
                'total_room'            => 'required',
                'guest'                 => 'required',
                'bedrooms'              => 'required',
                'bathrooms'              => 'required',
                'beds'                  => 'required',
                'address'               => 'required',
                'zip_code'              => 'required',
                'city'                  => 'required',
                'state'                 => 'required',
                'country'               => 'required',
                'price'                 => 'required',
                'discount_price'        => 'required',
                'weekend_base_price'    => 'required',
                'extra_person_fee'      => 'required',
                'convenience_charge'    => 'required',
                'security_deposit_fee'  => 'required',
                'good_and_service_tax'  => 'required',
                'cancelation_charge'    => 'required',
                // 'status'                => 'required|in:1,2'
            ];
        }
    }
}
