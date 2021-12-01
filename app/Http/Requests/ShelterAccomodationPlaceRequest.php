<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShelterAccomodationPlaceRequest extends FormRequest
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
            'accomodation_place_type' => ['required'],
            'accomodation_place_name' => ['required'],
            'accomodation_place_size' => ['required'],
            'accomodation_place_desc' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'accomodation_place_type.required' => 'Odaberite tip prostora',
            'accomodation_place_name.required' => 'Odredite naziv prostora',
            'accomodation_place_size.required' => 'Odredite dimenzije prostora',
            'accomodation_place_desc.required' => 'Unesite opis prostora',
        ];
    }
}
