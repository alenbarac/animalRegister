<?php

namespace App\Http\Controllers\Shelter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shelter\ShelterStaff;
use App\Models\Shelter\ShelterStaffType;
use Illuminate\Support\Facades\Validator;

class ShelterPersonelStaffController extends Controller
{
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'staff_personel_name' => 'required',
            'staff_personel_oib' => 'required',
            'staff_personel_address' => 'required',
            'staff_personel_phone' => 'required',
            'staff_personel_phone_cell' => 'required',
            'staff_personel_email' => 'required',
            'staff_personel_education' => 'required',
        ], [
            'staff_personel_name.required' => 'Ime i prezime je obvezan podatak',
            'staff_personel_oib.required' => 'OIB obvezan podatak',
            'staff_personel_address.required' => 'Adresa prebivališta je obvezan podatak',
            'staff_personel_phone.required' => 'Kontakt telefon je obvezan podatak',
            'staff_personel_phone_cell.required' => 'Kontakt mobilni telefon je obvezan podatak',
            'staff_personel_email.required' => 'Email adresa je obvezan podatak',
            'staff_personel_education.required' => 'Stručna sprema je obvezan podatak',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $shelterStaffType = ShelterStaffType::where('name', 'skrb-ostali')->first();

        $shelterStaff = ShelterStaff::create([
            'shelter_staff_type_id' => $shelterStaffType->id,
            'shelter_id' => $request->shelter_id,
            'name' => $request->staff_personel_name,
            'oib' => $request->staff_personel_oib,
            'address' => $request->staff_personel_address,
            'address_place' => $request->staff_personel_address_place,
            'phone' => $request->staff_personel_phone,
            'phone_cell' => $request->staff_personel_phone_cell,
            'email' => $request->staff_personel_email,
            'education' => $request->staff_personel_education,
        ]);

        return response()->json(['success' => 'Red je uspješno kreiran.']);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'staff_personel_name' => 'required',
            'staff_personel_oib' => 'required',
            'staff_personel_address' => 'required',
            'staff_personel_address_place' => 'required',
            'staff_personel_phone' => 'required',
            'staff_personel_phone_cell' => 'required',
            'staff_personel_email' => 'required',

        ], [
            'staff_personel_name.required' => 'Ime i prezime je obvezan podatak',
            'staff_personel_oib.required.required' => 'OIB obvezan podatak',
            'staff_personel_address.required.required' => 'Adresa prebivališta je obvezan podatak',
            'staff_personel_phone.required.required' => 'Kontakt telefon je obvezan podatak',
            'staff_personel_phone_cell.required' => 'Kontakt mobilni telefon je obvezan podatak',
            'staff_personel_email.required' => 'Email adresa je obvezan podatak',
            'staff_personel_education.required' => 'Stručna sprema je obvezan podatak',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        ShelterStaff::find($id)->update([
            'shelter_id' => $request->shelter_id,
            'name' => $request->staff_personel_name,
            'oib' => $request->staff_personel_oib,
            'address' => $request->staff_personel_address,
            'address_place' => $request->staff_personel_address_place,
            'phone' => $request->staff_personel_phone,
            'phone_cell' => $request->staff_personel_phone_cell,
            'email' => $request->staff_personel_email,
            'education' => $request->staff_personel_education,
        ]);

        return response()->json(['success' => 'Pravna osoba uspješno spremljena.', 'request' => $request->all()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shelterPersonelStaff = new ShelterStaff;
        $shelterPersonelStaff::find($id)->delete();

        return response()->json(['success' => 'Osoba je uspješno izbrisana']);
    }
}
