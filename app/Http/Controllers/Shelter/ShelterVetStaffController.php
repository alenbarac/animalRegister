<?php

namespace App\Http\Controllers\Shelter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shelter\ShelterStaff;
use App\Models\Shelter\ShelterStaffType;
use Illuminate\Support\Facades\Validator;

class ShelterVetStaffController extends Controller
{
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'staff_vet_oib' => 'required',
            'staff_vet_address' => 'required',
            'staff_vet_phone' => 'required',
            'staff_vet_phone_cell' => 'required',
            'staff_vet_email' => 'required',
        ], [
            'staff_vet_oib.required' => 'OIB obvezan podatak',
            'staff_vet_address.required' => 'Adresa prebivališta je obvezan podatak',
            'staff_vet_phone.required' => 'Kontakt telefon je obvezan podatak',
            'staff_vet_phone_cell.required' => 'Kontakt mobilni telefon je obvezan podatak',
            'staff_vet_email.required' => 'Email adresa je obvezan podatak',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $shelterStaffType = ShelterStaffType::where('name', 'veterinar oporavilišta')->first();

        $shelterStaff = ShelterStaff::create([
            'shelter_staff_type_id' => $shelterStaffType->id,
            'shelter_id' => $request->shelter_id,
            'name' => $request->staff_vet_name ? $request->staff_vet_name : $request->staff_vet_ambulance,
            'oib' => $request->staff_vet_oib,
            'address' => $request->staff_vet_address,
            'address_place' => $request->staff_vet_address_place,
            'phone' => $request->staff_vet_phone,
            'phone_cell' => $request->staff_vet_phone_cell,
            'email' => $request->staff_vet_email,
        ]);

        if ($request->hasFile('staff_vet_diploma')) {
            $shelterStaff->addMediaFromRequest('staff_vet_diploma')->toMediaCollection('vet-docs');
        }

        if ($request->hasFile('staff_vet_contract')) {
            $shelterStaff->addMediaFromRequest('staff_vet_contract')->toMediaCollection('contract-docs');
        }

        if ($request->hasFile('staff_ambulance_contract')) {
            $shelterStaff->addMediaFromRequest('staff_ambulance_contract')->toMediaCollection('ambulance-docs');
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
            'staff_vet_oib' => 'required',
            'staff_vet_address' => 'required',
            'staff_vet_address_place' => 'required',
            'staff_vet_phone' => 'required',
            'staff_vet_phone_cell' => 'required',
            'staff_vet_email' => 'required',
        ], [
            'staff_vet_oib.required' => 'OIB obvezan podatak',
            'staff_vet_address.required' => 'Adresa prebivališta je obvezan podatak',
            'staff_vet_phone.required' => 'Kontakt telefon je obvezan podatak',
            'staff_vet_phone_cell.required' => 'Kontakt mobilni telefon je obvezan podatak',
            'staff_vet_email.required' => 'Email adresa je obvezan podatak',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        ShelterStaff::find($id)->update([
            'shelter_id' => $request->shelter_id,
            'name' =>  $request->staff_vet_name ? $request->staff_vet_name : $request->staff_vet_ambulance,
            'oib' => $request->staff_vet_oib,
            'address' => $request->staff_vet_address,
            'address_place' => $request->staff_vet_address_place,
            'phone' => $request->staff_vet_phone,
            'phone_cell' => $request->staff_vet_phone_cell,
            'email' => $request->staff_vet_email,
        ]);


        $shelterStaff = ShelterStaff::vetStaff($request->shelter_id)->last();

        if ($request->hasFile('staff_vet_file')) {
            $shelterStaff->clearMediaCollection('legal-docs');
            $shelterStaff->addMediaFromRequest('staff_vet_file')->toMediaCollection('legal-docs');
        }

        if ($request->hasFile('staff_vet_diploma')) {
            $shelterStaff->clearMediaCollection('vet-docs');
            $shelterStaff->addMediaFromRequest('staff_vet_diploma')->toMediaCollection('vet-docs');
        }

        if ($request->hasFile('staff_vet_contract')) {
            $shelterStaff->clearMediaCollection('contract-docs');
            $shelterStaff->addMediaFromRequest('staff_vet_contract')->toMediaCollection('contract-docs');
        }

        if ($request->hasFile('staff_ambulance_contract')) {
            $shelterStaff->clearMediaCollection('ambulance-docs');
            $shelterStaff->addMediaFromRequest('staff_ambulance_contract')->toMediaCollection('ambulance-docs');
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
        $shelterVetStaff = new ShelterStaff;
        $shelterVetStaff::find($id)->delete();

        return response()->json(['success' => 'Osoba je uspješno izbrisana']);
    }
}
