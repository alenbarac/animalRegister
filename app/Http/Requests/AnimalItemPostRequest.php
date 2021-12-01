<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class AnimalItemPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'animal_size_attributes_id' => "required",
            'animal_dob' => "required",
            'animal_gender' => "required",
            'location' => "required",
        ];
    }

    public function messages()
    {
        return [
            'animal_size_attributes_id.required' => 'Veličina je obavezan podatak.',
            'animal_dob.required' => 'Dob jedinke je obavezan podatak.',
            'animal_gender.required' => 'Spol je obavezan podatak.',
            'location.required' => 'Lokacija je obavezan podatak.',
        ];
    }
}
