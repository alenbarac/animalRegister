<?php

namespace App\Http\Controllers\Shelter;

use Illuminate\Http\Request;
use App\Models\Shelter\Shelter;
use App\Http\Controllers\Controller;
use App\Models\Shelter\ShelterEquipment;
use Illuminate\Support\Facades\Validator;
use App\Models\Shelter\ShelterEquipmentType;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ShelterEquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Shelter $shelter)
    {
        $shelterEquipmentItems = ShelterEquipment::with('equipmentType')->where('shelter_id', $shelter->id)->get();
        return view('shelter.shelter_equipment.index', compact('shelterEquipmentItems', 'shelter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Shelter $shelter)
    {
        $equipment_types = ShelterEquipmentType::all('id', 'name');
        $shelterEquipmentItems = ShelterEquipment::with('equipmentType')->where('shelter_id', $shelter->id)->get();

        return view('shelter.shelter_equipment.create', ['equipment_types' => $equipment_types, 'shelter_id' => $shelter->id, 'shelterEquipmentItems' => $shelterEquipmentItems]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Shelter $shelter)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'equipment_desc' => 'required',
                'equipment_type' => 'required',
            ],
            [
                'equipment_type.required' => 'Odaberite tip opreme',
                'equipment_desc.required' => 'Opis je obvezno polje',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $equipment_type = ShelterEquipmentType::findOrFail($request->equipment_type);
        $shelter_id = $shelter->id;

        $shelterEquipmentItem = ShelterEquipment::create([
            'shelter_id' => $shelter_id,
            'shelter_equipment_type_id' => $equipment_type->id,
            'equipment_title' => $request->equipment_title ? $request->equipment_title : $request->equipment_valture_service,
            'equipment_desc' => $request->equipment_desc
        ]);
        $equipment_type->shelterEquipment()->save($shelterEquipmentItem);

        if ($request->hasFile('equipment_photos')) {
            foreach ($request->file('equipment_photos') as $image) {
                $shelterEquipmentItem->addMedia($image)->toMediaCollection('equipment-photos');
            }
        }

        if ($request->hasFile('equipment_docs')) {
            foreach ($request->file('equipment_docs') as $doc) {
                $shelterEquipmentItem->addMedia($doc)->toMediaCollection('equipment-docs');
            }
        }
        $redirectUrl = '/shelters/' . $shelter->id . '/equipments/' . $shelterEquipmentItem->id . '/';

        return response()->json(['success' => 'Oprema oporavališta uspješno spremljena.', 'redirectTo' => $redirectUrl]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shelter\ShelterEquipment  $shelterEquipment
     * @return \Illuminate\Http\Response
     */
    public function show(Shelter $shelter, ShelterEquipment $shelterEquipment)
    {
        return view('shelter.shelter_equipment.show', ['shelterEquipmentItem' => $shelterEquipment, 'shelter' => $shelter]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shelter\ShelterEquipment  $shelterEquipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Shelter $shelter, ShelterEquipment $shelterEquipment)
    {
        $equipment_types = ShelterEquipmentType::all('id', 'name');
        $selectedEquipmentType = $shelterEquipment->shelter_equipment_type_id;
        return view(
            'shelter.shelter_equipment.edit',
            ['shelterEquipmentItem' => $shelterEquipment, 'shelter' => $shelter, 'equipment_types' => $equipment_types, 'selectedEquipmentType' => $selectedEquipmentType]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shelter\ShelterEquipment  $shelterEquipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shelter $shelter, ShelterEquipment $shelterEquipment)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'edit_equipment_desc' => 'required',
            ],
            [
                'edit_equipment_desc.required' => 'Opis je obvezno polje',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        //$shelter_equipment_type = ShelterEquipmentType::findOrFail($request->equipment_type);

        $shelterEquipmentItem = ShelterEquipment::find($shelterEquipment->id);
        $shelterEquipmentItem->equipment_title = $request->edit_equipment_title ? $request->edit_equipment_title : $request->edit_equipment_valture_service;
        $shelterEquipmentItem->equipment_desc = $request->edit_equipment_desc;
        // $shelterEquipmentItem->shelter_id = $shelter->id;

        // $shelterEquipmentItem->equipmentType()->associate($shelter_equipment_type);
        $shelterEquipmentItem->save();

        if ($request->hasFile('edit_equipment_photos')) {
            foreach ($request->file('edit_equipment_photos') as $image) {
                $shelterEquipmentItem->addMedia($image)->toMediaCollection('equipment-photos');
            }
        }
        if ($request->hasFile('edit_equipment_docs')) {
            foreach ($request->file('edit_equipment_docs') as $doc) {
                $shelterEquipmentItem->addMedia($doc)->toMediaCollection('equipment-docs');
            }
        }
        $redirectUrl = '/shelters/' . $shelter->id . '/equipments/' . $shelterEquipmentItem->id . '/';
        return response()->json(['success' => 'Oprema je uspješno spremljena.', 'redirectTo' => $redirectUrl]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shelter\ShelterEquipment  $shelterEquipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shelter $shelter, ShelterEquipment $shelterEquipment)
    {
        $shelterEquipment->delete();
        return response()->json(['success' => 'Uspješno izbrisano.']);
    }

    public function deleteImage($img)
    {
        $media = Media::find($img);
        $media->delete();

        return response()->json(['msg' => 'success']);
    }
}
