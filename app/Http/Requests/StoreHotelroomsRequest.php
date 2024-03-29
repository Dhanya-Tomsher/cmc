<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHotelroomsRequest extends FormRequest
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
            'room_number' => 'required',
            'amount' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'room_number.required' => 'Room Number is required',
            'amount.required' => 'Amount is required'
        ];
    }
}
