<?php

namespace App\Http\Controllers\Animal;

use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;
use App\Models\Animal\AnimalOrder;
use App\Http\Controllers\Controller;
use App\Models\Animal\AnimalCategory;
use Illuminate\Support\Facades\Validator;
use App\Models\Animal\AnimalSystemCategory;

class AnimalOrderController extends Controller
{
    public function index(Request $request)
    {
        $animalOrder = AnimalOrder::with('animalSystemCategory', 'animalCategory')->get();
        $animalClass = AnimalSystemCategory::all();

        if ($request->ajax()) {

            return DataTables::of($animalOrder)
                ->addIndexColumn()
                ->addColumn('animal_order', function (AnimalOrder $animalOrder) {

                    return $animalOrder->order_name ?? '';
                })
                ->addColumn('animal_system_category', function (AnimalOrder $animalOrder) {

                    return $animalOrder->animalSystemCategory->latin_name ?? '';
                })
                ->addColumn('action', function (AnimalOrder $animalOrder) {

                    return  '<button type="button" class="btn btn-primary btn-sm" id="getEditOrderData" data-id="' . $animalOrder->id . '">Uredi</button>
                    <button type="button" data-id="' . $animalOrder->id . '" data-toggle="modal" data-target="#DeleteOrderModal" class="btn btn-danger btn-sm" id="getDeleteId">Briši</button>';
                })

                ->rawColumns(['action', 'animal_category'])
                ->make();
        }

        return view('animal.animal_order.index', compact('animalOrder', 'animalClass'));
    }

    public function store(Request $request, AnimalOrder $animalOrder)
    {

        $validator = Validator::make($request->all(), [
            'animal_class' => 'required',
            'order_name' => 'required'
        ], [
            'animal_class.required' => 'Odaberite razred',
            'order_name.required' => 'Unesite ime reda ako već nije na popisu'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $animalOrder = new AnimalOrder;

        $animalOrder->animalSystemCategory()->associate($request->animal_class);
        $animalOrder->order_name = $request->order_name;
        $animalOrder->save();

        return response()->json(['success' => 'Red je uspješno kreiran.']);
    }

    public function edit($id)
    {
        $animalOrder = new AnimalOrder;

        $data = $animalOrder->find($id);
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
                 <label for="groupName">Naziv reda:</label>
                    <input type="text" class="form-control" name="order_name" id="editOrderName" value="' . $data->order_name . '">                                  
            </div>';

        return response()->json(['html' => $html]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'animal_class' => 'required',
            'order_name' => 'required'
        ], [
            'animal_class.required' => 'Odaberite razred',
            'order_name.required' => 'Unesite ime reda ako već nije na popisu'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $animalOrder = new AnimalOrder;

        $animalOrder::find($id)->update([
            'animal_system_category_id' => $request->animal_class,
            'order_name' => $request->order_name
        ]);


        return response()->json(['success' => 'Red je uspješno spremljen.']);
    }

    public function destroy($id)
    {
        $animalOrder = new AnimalOrder;
        $animalOrder::find($id)->delete();

        return response()->json(['success' => 'Red je uspješno izbrisan']);
    }
}
