<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShelterAccomodationBoxRequest extends FormRequest
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
      'accomodation_box_type' => ['required'],
      'accomodation_box_name' => ['required'],
      'accomodation_box_size' => ['required'],
      'accomodation_box_desc' => ['required'],
    ];
  }

  public function messages()
  {
    return [
      'accomodation_box_type.required' => 'Odaberite tip nastambe',
      'accomodation_box_name.required' => 'Odaberite naziv nastambe',
      'accomodation_box_size.required' => 'Odredite dimenzije nastambe',
      'accomodation_box_desc.required' => 'Unesite opis nastambe',
    ];
  }
}
