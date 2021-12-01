<?php

namespace App\Http\Controllers\Animal;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;
use App\Models\Animal\Animal;
use App\Models\Animal\AnimalCode;
use App\Models\Animal\AnimalType;
use App\Http\Controllers\Controller;
use App\Models\Animal\AnimalCategory;
use App\Models\Animal\AnimalSystemCategory;

class AnimalSeizedTypeController extends Controller
{

  public function getZJAnimalTypes(Request $request)
  {
    $animalSystemCategory = AnimalSystemCategory::all();


    $animals = Animal::with('animalType', 'animalCodes', 'animalCategory', 'animalType')
      ->whereHas('animalType', function ($q) {
        $q->where('type_code', 'ZJ');
      })->get();

    if ($request->ajax()) {

      return DataTables::of($animals)
        ->addIndexColumn()
        ->addColumn('animal_category', function (Animal $animal) {

          return $animal->animalCategory->latin_name ?? '';
        })
        ->addColumn('animal_system_category', function (Animal $animal) {

          $animalCategory = $animal->animalCategory;
          return $animalCategory->animalSystemCategory->latin_name ?? '';
        })

        ->addColumn('animal_code', function (Animal $animal) {
          return $animal->animalCodes->map(function ($code) {

            switch ($code->name) {
              case "CR":
                $btn_class = 'danger';
                break;
              case "EN":
                $btn_class = 'warning';
                break;
              case "NT":
                $btn_class = 'primary';
                break;

              case "RE":
                $btn_class = 'danger-muted';
                break;

              case "VU":
                $btn_class = 'secondary';
                break;
              default:
                $btn_class = 'light';
            }

            return  '<button type="button" class="btn btn-' . ($btn_class) . '" data-toggle="tooltip" data-placement="left" title="' . ($code->desc) . '">
                           ' . $code->name . '
                          </button>';

            // return $code->name;
          })->implode('<br>');
        })

        ->addColumn('animal_type', function (Animal $animal) {
          return $animal->animalType->map(function ($type) {

            return  '<button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="left" title="' . ($type->type_name) . '">
                        ' . $type->type_code . '
                       </button>';
            //  return $type->type_code;
          })->implode('<br>');
        })

        ->addColumn('action', function (Animal $animal) {
          return '
                <div class="d-flex align-items-center">
                
                    <a href="/zj_animal_type/' . $animal->id . '" class="btn btn-xs btn-primary mr-2">
                        <i class="mdi mdi-tooltip-edit"></i> 
                        Edit
                    </a>
                    <a href="javascript:void(0)" id="bntDeleteUser" class="btn btn-xs btn-danger" >
                        <i class="mdi mdi-delete"></i>
                        <input type="hidden" id="userId" value="' . $animal->id . '" />
                        Delete
                    </a>
                </div>
                ';
        })

        ->rawColumns(['animal_code', 'animal_type', 'action'])
        ->make();
    }

    return view('animal.animal_type.zj_animal_type', compact('animalSystemCategory'));
  }

  public function createZJAnimalTypes()
  {
    $animalCategory = AnimalCategory::all();
    $animalSystemCategory = AnimalSystemCategory::all();
    $animalCodes = AnimalCode::all();
    $animalType = AnimalType::where('type_code', 'ZJ')->first();

    return view('animal.animal_type.zj_animal_type_create', compact('animalCodes', 'animalCategory', 'animalSystemCategory', 'animalType'));
  }

  public function storeZJAnimalTypes(Request $request)
  {
    $szAnimal = new Animal;

    $szAnimalCat = AnimalCategory::findOrFail($request->animal_category);
    $szAnimalSystemcat = AnimalSystemCategory::findOrFail($request->animal_system_category);

    $szAnimal->name = $request->name;
    $szAnimal->latin_name = $request->latin_name;

    $szAnimal->animalCategory()->associate($szAnimalCat);
    $szAnimalSystemcat->animalCategory()->save($szAnimalCat);

    $szAnimal->save();

    $szAnimal->animalCodes()->attach($request->animal_code);
    $szAnimal->animalType()->attach($request->animal_type);

    return redirect('zj_animal_type')->with('msg', 'Jedinka je uspješno kreirana.');
  }

  public function showZJAnimalTypes($id)
  {
    $animal = Animal::with('animalType', 'animalCodes', 'animalCategory')
      ->whereHas('animalType', function ($q) {
        $q->where('type_code', 'ZJ');
      })->findOrFail($id);



    $selectedCodes = $animal->animalCodes()->get();
    $selectedCat = $animal->animalCategory->id;
    $selectedSystemCat = $animal->animalCategory->animalSystemCategory->id;

    $animalCategory = AnimalCategory::all();
    $animalSystemCategory = AnimalSystemCategory::all();
    $animalCodes = AnimalCode::all();
    $animalTypes = AnimalType::all();

    return view('animal.animal_type.zj_animal_type_show', compact('animal', 'animalCodes', 'animalCategory', 'animalSystemCategory', 'animalTypes', 'selectedCat', 'selectedCodes', 'selectedSystemCat'));
  }

  public function updateZJAnimalTypes(Request $request, $id)
  {
    $category = AnimalCategory::findOrFail($request->animal_category);
    $systemCategory = AnimalSystemCategory::findOrFail($request->animal_system_category);

    $animal = Animal::find($id);
    $animal->name = $request->name;
    $animal->latin_name = $request->latin_name;
    $animal->animalCategory()->associate($category); // animal belongs to animalCategory
    $systemCategory->animalCategory()->save($category); // systemCat hasMany animalCats

    $animal->animalCodes()->sync($request->animal_code); // manyToMany

    $animal->save();

    return redirect()->route('zj_animal_type')->with('msg', 'Jedinka je uspješno izmjenjena.');
  }

  public function deleteZJAnimalType($id)
  {
    $szAnimal = Animal::findOrFail($id);

    $szAnimal->animalCodes()->detach();
    $szAnimal->animalType()->detach();

    $szAnimal->delete();

    return redirect()->route('zj_animal_type')->with('msg', 'Jedinka je uspješno izbrisana.');
  }
}