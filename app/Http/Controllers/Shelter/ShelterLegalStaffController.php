<?php

namespace App\Http\Controllers\Shelter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shelter\ShelterStaff;
use App\Models\Shelter\ShelterStaffType;
use Illuminate\Support\Facades\Validator;

class ShelterLegalStaffController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'staff_legal_name' => 'required',
            'staff_legal_oib' => 'required',
            'staff_legal_address' => 'required',
            'staff_legal_phone' => 'required',
            'staff_legal_phone_cell' => 'required',
            'staff_legal_email' => 'required',
            'staff_legal_file' => 'required',
        ], [
            'staff_legal_name.required' => 'Ime i prezime je obvezan podatak',
            'staff_legal_oib.required' => 'OIB obvezan podatak',
            'staff_legal_address.required' => 'Adresa prebivališta je obvezan podatak',
            'staff_legal_phone.required' => 'Kontakt telefon je obvezan podatak',
            'staff_legal_phone_cell.required' => 'Kontakt mobilni telefon je obvezan podatak',
            'staff_legal_email.required' => 'Email adresa je obvezan podatak',
            'staff_legal_file.required' => 'Uvjerenje - kazneni postupak je obvezan podatak',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $shelterStaffType = ShelterStaffType::where('name', 'pravno odgovorna osoba')->first();

        $shelterStaff = ShelterStaff::create([
            'shelter_staff_type_id' => $shelterStaffType->id,
            'shelter_id' => $request->shelter_id,
            'name' => $request->staff_legal_name,
            'oib' => $request->staff_legal_oib,
            'address' => $request->staff_legal_address,
            'address_place' => $request->staff_legal_address_place,
            'phone' => $request->staff_legal_phone,
            'phone_cell' => $request->staff_legal_phone_cell,
            'email' => $request->staff_legal_email,
        ]);

        if ($request->hasFile('staff_legal_file')) {
            $shelterStaff->addMediaFromRequest('staff_legal_file')->toMediaCollection('legal-docs');
        }

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
            'staff_legal_name' => 'required',
            'staff_legal_oib' => 'required',
            'staff_legal_address' => 'required',
            'staff_legal_phone' => 'required',
            'staff_legal_phone_cell' => 'required',
            'staff_legal_email' => 'required',
            'staff_legal_file' => 'required',
        ], [
            'staff_legal_name.required' => 'Ime i prezime je obvezan podatak',
            'staff_legal_oib.required' => 'OIB obvezan podatak',
            'staff_legal_address.required' => 'Adresa prebivališta je obvezan podatak',
            'staff_legal_phone.required' => 'Kontakt telefon je obvezan podatak',
            'staff_legal_phone_cell.required' => 'Kontakt mobilni telefon je obvezan podatak',
            'staff_legal_email.required' => 'Email adresa je obvezan podatak',
            'staff_legal_file.required' => 'Uvjerenje - kazneni postupak je obvezan podatak',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        ShelterStaff::find($id)->update([
            'shelter_id' => $request->shelter_id,
            'name' => $request->staff_legal_name,
            'oib' => $request->staff_legal_oib,
            'address' => $request->staff_legal_address,
            'address_place' => $request->staff_legal_address_place,
            'phone' => $request->staff_legal_phone,
            'phone_cell' => $request->staff_legal_phone_cell,
            'email' => $request->staff_legal_email,
        ]);


        $shelterStaff = ShelterStaff::legalStaff($request->shelter_id)->last();

        if ($request->hasFile('staff_legal_file')) {
            $shelterStaff->clearMediaCollection('legal-docs');
            $shelterStaff->addMediaFromRequest('staff_legal_file')->toMediaCollection('legal-docs');
        }

        return response()->json(['success' => 'Pravna osoba uspješno spremljena.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shelterLegalStaff = new ShelterStaff;
        $shelterLegalStaff::find($id)->delete();

        return response()->json(['success' => 'Osoba je uspješno izbrisana']);
    }
}
