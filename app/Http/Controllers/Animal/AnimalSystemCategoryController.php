<?php

namespace App\Http\Controllers\Animal;

use Illuminate\Http\Request;
use App\Models\Shelter\Shelter;
use App\Http\Controllers\Controller;
use App\Models\Animal\AnimalSystemCategory;


class AnimalSystemCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shelter = Shelter::all();

        return view('animal.animal_system_category.create', [
            'shelter' => $shelter,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $animalSystemCategory = new AnimalSystemCategory;
        $animalSystemCategory->name = $request->name;
        $animalSystemCategory->shelter_unit_id = $request->shelter_unit_id;
        $animalSystemCategory->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AnimalSystemCategory  $animalSystemCategory
     * @return \Illuminate\Http\Response
     */
    public function show(AnimalSystemCategory $animalSystemCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AnimalSystemCategory  $animalSystemCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(AnimalSystemCategory $animalSystemCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AnimalSystemCategory  $animalSystemCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnimalSystemCategory $animalSystemCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AnimalSystemCategory  $animalSystemCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnimalSystemCategory $animalSystemCategory)
    {
        //
    }
}
