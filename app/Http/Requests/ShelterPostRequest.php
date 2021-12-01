<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ShelterPostRequest extends FormRequest
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
            'name' => ['required'],
            'email' => ['required', 'email'],
            'shelter_code' => ['required', 'max:5'],
            'place_zip' => ['required'],
            'address' => ['required'],
            'telephone' => ['required'],
            'mobile' => ['required'],
            'iban' => ['required'],
            'bank_name' => ['required'],
            'shelter_type_id' => ['required'],
            'address_place' => ['required'],
            'oib' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Naziv je obavezan podatak',
            'email.required' => 'Email je obavezan podatak',
            'shelter_code.required' => 'Šifra oporavilišta je obavezan podatak',
            'place_zip.required' => 'Mjesto i poštanski broj je obavezan podatak',
            'address.required' => 'Adresa sjedišta je obavezan podatak',
            'telephone.required' => 'Broj telefona je obavezan podatak',
            'mobile.required' => 'Broj mobitela je obavezan podatak',
            'iban.required' => 'IBAN je obavezan podatak',
            'bank_name.required' => 'Ime Banke je obavezan podatak',
            'shelter_type_id.required' => 'Odaberite predmet obavljanja',
            'address_place.required' => 'Adresa lokacije je obvezan podatak',
            'oib.required' => 'OIB je obvezan podatak'
        ];
    }
}
