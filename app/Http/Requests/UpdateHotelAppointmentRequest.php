<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHotelAppointmentRequest extends FormRequest
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
            /*'name' => 'nullable',
            'image' => 'required|file|mimes:jpg,jpeg,png,gif,bmp,tiff,webp|max:1000',
            'button_text' => 'nullable|max:15',
            'button_url' => 'nullable',
            'sub_heading' => 'nullable|max:25',
            'heading' => 'nullable|max:60',*/
        ];
    }

    public function messages()
    {
        return [
          /*  'image.required' => 'Please select an image for the banner',
            'image.file' => 'Please select an image for the banner',
            'image.max' => 'The file size should be less than 1MB',

            'button_text.max' => 'Text cannot be larger than 15 characters',
            'sub_heading.max' => 'Text cannot be larger than 25 characters',

            'heading.required' => 'A heading is required to create a banner',
            'heading.max' => 'Text cannot be larger than 60 characters',*/
        ];
    }
}
