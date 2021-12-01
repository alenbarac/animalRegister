<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreLegalStaffRequest extends FormRequest
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
            'staff_legal_name' => ['required'],
            'staff_legal_oib' => ['required'],
            'staff_legal_address' => ['required'],
            'staff_legal_address_place' => ['required'],
            'staff_legal_phone' => 'required',
            'staff_legal_phone_cell' => ['required'],
            'staff_legal_email' => ['required'],
            'staff_legal_file' => ['required'],
        ];
    }
}
