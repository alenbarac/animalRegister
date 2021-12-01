<?php

namespace App\Http\Controllers\Shelter;

use Illuminate\Http\Request;
use App\Models\Shelter\Shelter;
use App\Http\Controllers\Controller;
use App\Models\Animal\AnimalSystemCategory;
use App\Models\Shelter\ShelterNutrition;
use Illuminate\Support\Facades\Validator;

class ShelterNutritionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Shelter $shelter)
    {

        $shelterNutritionItems = ShelterNutrition::with('animalSystemCategory')->where('shelter_id', $shelter->id)->get();

        return view('shelter.shelter_nutrition.index', compact('shelterNutritionItems', 'shelter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Shelter $shelter)
    {
        $shelterNutritionItems = ShelterNutrition::where('shelter_id', $shelter->id)->get();


        return view('shelter.shelter_nutrition.create', ['shelterNutritionItems' => $shelterNutritionItems, 'shelter' => $shelter->load(['animalSystemCategory'])]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Shelter $shelter, ShelterNutrition $shelterNutrition)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nutrition_unit' => 'required',
                'nutrition_desc' => 'required',
                'animal_class' => 'required',
            ],
            [
                'nutrition_unit.required' => 'Unesite Vrstu/skupinu divljih životinja',
                'nutrition_desc.required' => 'Opis programa hranjenja je obvezno polje',
                'animal_class.required' => 'Odaberite razred životinje/a',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        $shelter_animal_cat = AnimalSystemCategory::findOrFail($request->animal_class);


        $shelterNutritionItem = new ShelterNutrition;
        $shelterNutritionItem->nutrition_unit = $request->nutrition_unit;
        $shelterNutritionItem->nutrition_desc = $request->nutrition_desc;
        $shelterNutritionItem->shelter_id = $shelter->id;

        $shelterNutritionItem->animalSystemCategory()->associate($shelter_animal_cat);

        $shelterNutritionItem->save();

        return response()->json(['success' => 'Program prehrane uspješno spremljen.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shelter\ShelterNutrition  $shelterNutrition
     * @return \Illuminate\Http\Response
     */
    public function show(Shelter $shelter, ShelterNutrition $shelterNutrition)
    {
        return view('shelter.shelter_nutrition.show', ['shelterNutritionItem' => $shelterNutrition, 'shelter' => $shelter]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shelter\ShelterNutrition  $shelterNutrition
     * @return \Illuminate\Http\Response
     */
    public function edit(Shelter $shelter, ShelterNutrition $shelterNutrition)
    {

        $selectedSystemCat = $shelterNutrition->animal_system_category_id;
        return view('shelter.shelter_nutrition.edit', ['shelterNutritionItem' => $shelterNutrition, 'shelter' => $shelter, 'selectedSystemCat' => $selectedSystemCat]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shelter\ShelterNutrition  $shelterNutrition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shelter $shelter, ShelterNutrition $shelterNutrition)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nutrition_unit' => 'required',
                'nutrition_desc' => 'required',
                'animal_class' => 'required',
            ],
            [
                'nutrition_unit.required' => 'Unesite Vrstu/skupinu divljih životinja',
                'nutrition_desc.required' => 'Opis programa hranjenja je obvezno polje',
                'animal_class.required' => 'Odaberite razred životinje/a',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $shelter_animal_cat = AnimalSystemCategory::findOrFail($request->animal_class);
        $shelterNutritionItem = ShelterNutrition::find($shelterNutrition->id);

        $shelterNutritionItem->nutrition_unit = $request->nutrition_unit;
        $shelterNutritionItem->nutrition_desc = $request->nutrition_desc;
        $shelterNutritionItem->shelter_id = $shelter->id;

        $shelterNutritionItem->animalSystemCategory()->associate($shelter_animal_cat);
        $shelterNutritionItem->save();

        $redirectUrl = '/shelters/' . $shelter->id . '/nutritions/' . $shelterNutrition->id . '/';
        return response()->json(['success' => 'Program hranjenja uspješno spremljen.', 'redirectTo' => $redirectUrl]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shelter\ShelterNutrition  $shelterNutrition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shelter $shelter, ShelterNutrition $shelterNutrition)
    {
        $shelterNutrition->delete();
        return response()->json(['success' => 'Program hranjenja uspješno izbrisan.']);
    }
}
