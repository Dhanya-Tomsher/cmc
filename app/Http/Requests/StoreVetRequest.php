<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVetRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:vets',
            'shift_from' => 'nullable',
            'shift_to' => 'nullable',
            'address' => 'nullable',
            'phone_number' => 'required',
            'whatsapp_number' => 'nullable',
            'home_country' => 'nullable',
            'emirate' => 'nullable',
            'gender' => 'nullable',
            'color_name' => 'nullable',
            'color_code' => 'nullable',
            'emirates_id' => 'nullable',
            'gender' => 'nullable',
            'license_number' => 'nullable',
            'designation' => 'nullable',
            'specialization' => 'nullable',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,gif,bmp,tiff,webp|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'image.max' => 'The file size should be less than 1MB',
            'name.required' => 'Please enter a name',
            'phone_number.required' => 'Please enter phone number',
            // 'shift_from.required' => 'Please select time',
            // 'shift_to.required' => 'Please select time',
            'email.required' => 'Please enter an email',
            'email.email' => 'Please enter an valid email',
            'email.unique' => 'Sorry, this email is already in use, please use another email',
        ];
    }
}
