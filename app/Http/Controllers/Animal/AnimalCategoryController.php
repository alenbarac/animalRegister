<?php

namespace App\Http\Controllers\Animal;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Animal\AnimalCategory;
use Illuminate\Support\Facades\Validator;
use App\Models\Animal\AnimalSystemCategory;

class AnimalCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $animalCats = AnimalCategory::with('animalSystemCategory')->get();
        $animalClass = AnimalSystemCategory::all();

        if ($request->ajax()) {

            return DataTables::of($animalCats)
                ->addIndexColumn()

                ->addColumn('animal_system_category', function (AnimalCategory $animalCats) {
                    return $animalCats->animalSystemCategory->latin_name ?? '';
                })

                ->addColumn('animal_category', function (AnimalCategory $animalCats) {
                    return $animalCats->latin_name ?? '';
                })

                ->addColumn('action', function (AnimalCategory $animalCats) {
                    return  '<button type="button" class="btn btn-primary btn-sm" id="getEditCatData" data-id="' . $animalCats->id . '">Uredi</button>
                    <button type="button" data-id="' . $animalCats->id . '" data-toggle="modal" data-target="#DeleteCatModal" class="btn btn-danger btn-sm" id="getDeleteCatId">Briši</button>';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('animal.animal_category.index', compact('animalCats', 'animalClass'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AnimalCategory $animalCategory)
    {

        $validator = Validator::make($request->all(), [
            'animal_class' => 'required',
            'category_name' => 'required'
        ], [
            'animal_class.required' => 'Odaberite razred',
            'category_name.required' => 'Unesite ime porodice ako već nije na popisu'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $animalCategory = new AnimalCategory;
        $animalCategory->animalSystemCategory()->associate($request->animal_class);
        $animalCategory->latin_name = $request->category_name;
        $animalCategory->save();

        return response()->json(['success' => 'Porodica je uspješno kreirana.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $animalCategory = new AnimalCategory;

        $data = $animalCategory->find($id);
        $systemCat = $data->AnimalSystemCategory->id;
        $animalClass = AnimalSystemCategory::all();

        $dropdown = '';

        foreach ($animalClass as $class) {
            $class_id = $class->id;
            $class_name = $class->latin_name;

            $dropdown .= '<option value="' . $class_id . '" ' . (($class_id == $systemCat) ? 'selected="selected"' : "") . '>' . $class_name . '</option>';
        }

        $html = ' <div class="form-group">
                    <label>Razred Jedinke</label>
                        <select class="form-control" name="animal_class" id="editAnimalClass">     
                              "' . $dropdown . '"
                        </select> 
                </div>  
            <div class="form-group">
                 <label for="groupName">Naziv porodice:</label>
                    <input type="text" class="form-control" name="category_name" id="editCatName" value="' . $data->latin_name . '">                                  
            </div>';

        return response()->json(['html' => $html]);
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
            'animal_class' => 'required',
            'category_name' => 'required'
        ], [
            'animal_class.required' => 'Odaberite razred',
            'category_name.required' => 'Unesite ime porodice ako već nije na popisu'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $animalCategory = new AnimalCategory;

        $animalCategory::find($id)->update([
            'animal_system_category_id' => $request->animal_class,
            'latin_name' => $request->category_name
        ]);


        return response()->json(['success' => 'Porodica je uspješno spremljena.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $animalCategory = new AnimalCategory;
        $animalCategory::find($id)->delete();

        return response()->json(['success' => 'Porodica je uspješno izbrisana']);
    }
}
