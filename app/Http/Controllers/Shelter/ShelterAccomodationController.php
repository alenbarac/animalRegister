<?php

namespace App\Http\Controllers\Shelter;

use Illuminate\Http\Request;
use App\Models\Shelter\Shelter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Shelter\ShelterAccomodation;
use App\Models\Shelter\ShelterAccomodationType;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ShelterAccomodationController extends Controller
{
    public function index(Shelter $shelter)
    {

        $shelterAccomodationItems = ShelterAccomodation::with('accommodationType')->where('shelter_id', $shelter->id)->get();
        return view('shelter.shelter_accomodation.index', compact('shelterAccomodationItems', 'shelter'));
    }

    public function create(Shelter $shelter)
    {
        $accomodation_types = ShelterAccomodationType::all('id', 'name');
        $shelterAccomodationItems = ShelterAccomodation::with('accommodationType')->where('shelter_id', $shelter->id)->get();

        return view('shelter.shelter_accomodation.create', ['accomodation_types' => $accomodation_types, 'shelter_id' => $shelter->id, 'shelterAccomodationItems' => $shelterAccomodationItems]);
    }


    public function store(Request $request, Shelter $shelter)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'accomodation_name' => 'required',
                'accomodation_size' => 'required',
                'accomodation_desc' => 'required',
            ],
            [
                'accomodation_name.required' => 'Naziv je obvezano polje',
                'accomodation_size.required' => 'Dimenzije su obvezano polje',
                'accomodation_desc.required' => 'Opis je obvezno polje',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $accomodation_type = ShelterAccomodationType::findOrFail($request->accomodation_type);
        $shelter_id = $shelter->id;

        $shelter_accomodation = ShelterAccomodation::create([
            'shelter_id' => $shelter_id,
            'shelter_accomodation_type_id' => $accomodation_type->id,
            'name' => $request->accomodation_name,
            'dimensions' => $request->accomodation_size,
            'description' => $request->accomodation_desc
        ]);
        $accomodation_type->shelterAccomodation()->save($shelter_accomodation);

        if ($request->hasFile('accomodation_photos')) {
            foreach ($request->file('accomodation_photos') as $image) {
                $shelter_accomodation->addMedia($image)->toMediaCollection('accomodation-photos');
            }
        }
        $redirectUrl = '/shelters/' . $shelter->id . '/accomodations/' . $shelter_accomodation->id . '/';

        return response()->json(['success' => 'Smještajna jedinica uspješno spremljena.', 'redirectTo' => $redirectUrl]);
    }

    public function show(Shelter $shelter, ShelterAccomodation $shelter_accomodation)
    {

        return view('shelter.shelter_accomodation.show', ['shelterAccomodationItem' => $shelter_accomodation, 'shelter' => $shelter]);
    }

    public function edit(Shelter $shelter, ShelterAccomodation $shelter_accomodation)
    {
        return view('shelter.shelter_accomodation.edit', ['shelterAccomodationItem' => $shelter_accomodation, 'shelter' => $shelter]);
    }

    public function update(Request $request, Shelter $shelter, ShelterAccomodation $shelter_accomodation)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'edit_accomodation_name' => 'required',
                'edit_accomodation_size' => 'required',
                'edit_accomodation_desc' => 'required',
            ],
            [
                'edit_accomodation_name.required' => 'Naziv je obvezno polje',
                'edit_accomodation_size.required' => 'Dimenzije su obvezno polje',
                'edit_accomodation_desc.required' => 'Opis je obvezno polje',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $shelter_accomodation->update([
            'name' => $request->edit_accomodation_name,
            'dimensions' => $request->edit_accomodation_size,
            'description' => $request->edit_accomodation_desc
        ]);

        if ($request->hasFile('edit_accomodation_photos')) {
            foreach ($request->file('edit_accomodation_photos') as $image) {
                $shelter_accomodation->addMedia($image)->toMediaCollection('accomodation-photos');
            }
        }
        $redirectUrl = '/shelters/' . $shelter->id . '/accomodations/' . $shelter_accomodation->id . '/';
        return response()->json(['success' => 'Smještajna jedinica uspješno spremljena.', 'redirectTo' => $redirectUrl]);
    }

    public function destroy(Shelter $shelter, ShelterAccomodation $shelter_accomodation)
    {
        $shelter_accomodation->delete();
        return response()->json(['success' => 'Smještajna jedinica uspješno izbrisana.']);
    }

    public function deleteImage($img)
    {
        $media = Media::find($img);
        $media->delete();

        return response()->json(['msg' => 'success']);
    }
}
