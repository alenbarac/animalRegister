<?php

namespace App\Http\Controllers\Animal;

use Carbon\Carbon;
use App\Models\DateRange;
use App\Models\FounderData;
use Illuminate\Http\Request;
use App\Models\Animal\Animal;
use App\Models\Shelter\Shelter;
use CreateAnimalMarkTypesTable;
use App\Models\Animal\AnimalCode;
use App\Models\Animal\AnimalFile;
use App\Models\Animal\AnimalItem;
use App\Models\Animal\AnimalSize;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Animal\AnimalMarkType;
use App\Http\Requests\AnimalPostRequest;
use Database\Seeders\AnimalMarkTypeSeeder;
use App\Models\Animal\AnimalSystemCategory;
use BayAreaWebPro\MultiStepForms\MultiStepForm as Form;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animals = Animal::with('animalType', 'animalCodes', 'animalCategory')->get();

        return view('animal.animal.index', compact('animals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // auth()->user()->shelter->id
        // $shelter = Shelter::find(auth()->user()->shelter->id);
        // $founder = $shelter->founder;
        // $sysCats = $shelter->animalSystemCategory;
        // $shelterType = $shelter->shelterTypes;
        // $markTypes = AnimalMarkType::all();

        // $pluckCat = $sysCats->pluck('id');
        // $pluckTyp = $shelterType->pluck('code');

        // $type = Animal::whereHas('animalType', function ($q) use ($pluckTyp) {
        //         $q->whereIn('type_code', $pluckTyp);
        //     })
        //     ->whereHas('animalCategory.animalSystemCategory', function ($q) use ($pluckCat) {
        //         $q->whereIn('id', $pluckCat);
        //     })
        //     ->orderBy('name')
        //     ->get();

        // return view('animal.animal.create', [
        //     'typeArray' => $type,
        //     'founder' => $founder,
        //     'markTypes' => $markTypes,
        //     'shelter' => $shelter,
        //     'shelterType' => $shelterType
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnimalPostRequest $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $animal = Animal::with('animalCodes', 'animalCategory', 'animalAttributes', 'animalItems', 'shelters')->findOrFail($id);

        return view('animal.animal_item.show', [
            'animal' => $animal,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $animal = Animal::find($id);

        return view('animal.animal.edit')->with('animals', $animal);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getBySize(Request $request)
    {
        if (!$request->animal_id) {
            $html = '<option value=""></option>';
        } else {
            $html = '';
            $animalSelect = Animal::with('animalSize')->where('id', $request->animal_id)->first();

            foreach ($animalSelect->animalSize->sizeAttributes as $size) {
                $html .= '<option value="' . $size->id . '">' . $size->name . '</option>';
            }
        }

        return response()->json(['html' => $html]);
    }
}
