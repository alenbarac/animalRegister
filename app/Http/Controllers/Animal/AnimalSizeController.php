<?php

namespace App\Http\Controllers\Animal;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Animal\AnimalSize;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Animal\AnimalSizeAttribute;

class AnimalSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $size_groups = AnimalSize::all();

        return view('animal.animal_price.index', compact('size_groups'));
    }

    public function getSizes(Request $request)
    {
        $sizeAttribute = AnimalSizeAttribute::with('animalSize')->get();

        if ($request->ajax()) {

            return DataTables::of($sizeAttribute)
                ->addIndexColumn()
                ->addColumn('group_name', function (AnimalSizeAttribute $sizeAttribute) {

                    return $sizeAttribute->animalSize->group_name ?? '';
                })

                ->addColumn('animal_size', function (AnimalSizeAttribute $sizeAttribute) {

                    return $sizeAttribute->name;
                })

                ->addColumn('base_price', function (AnimalSizeAttribute $sizeAttribute) {

                    return $sizeAttribute->base_price;
                })

                ->addColumn('group_price', function (AnimalSizeAttribute $sizeAttribute) {

                    return $sizeAttribute->group_price;
                })

                ->addColumn('action', function (AnimalSizeAttribute $sizeAttribute) {
                    return  '<button type="button" class="btn btn-primary btn-sm" id="getEditSizeData" data-id="' . $sizeAttribute->id . '">Uredi</button>
                    <button type="button" data-id="' . $sizeAttribute->id . '" data-toggle="modal" data-target="#DeleteSizeModal" class="btn btn-danger btn-sm" id="getDeleteId">Briši</button>';
                })

                ->rawColumns(['group_name', 'base_price', 'group_price', 'animal_size', 'action'])
                ->make();
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AnimalSizeAttribute $animalSize)
    {

        $validator = Validator::make($request->only(['name', 'base_price', 'group_price']), [
            'name' => 'required',
            'base_price' => 'required',
            'group_price' =>  'required'
        ], [
            'name.required' => 'Veličina je obvezan podatak',
            'base_price.required' => 'Unesite cijenu za solitarnu skrb',
            'group_price.required' => 'Unesite cijenu za grupnu skrb'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $animalSize = new AnimalSizeAttribute;
        $animalSize->animalSize()->associate($request->group_name);
        $animalSize->name = $request->name;

        $animalSize->base_price = $request->base_price;
        $animalSize->group_price = $request->group_price;
        $animalSize->save();

        return response()->json(['success' => 'Cijene uspješno kreirane.']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Animal\AnimalSize  $animalSize
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $animalSize = new AnimalSizeAttribute;

        $data = $animalSize->find($id);

        $html = ' <div class="form-group">
                        <label for="groupName">Naziv Grupe:</label>
                            <input type="text" class="form-control" name="group_name" id="editgroupName" value="' . $data->animalSize->group_name . '" disabled>
                    </div>
                    <div class="form-group">
                        <label for="groupName">Veličine jedinki:</label>
                            <input type="text" class="form-control" name="name" id="editsizeName" value="' . $data->name . '">                                   
                    </div>
                    <div class="form-group">
                        <label for="groupName">Solitarna skrb - cijena/dan</label>
                            <input type="text" class="form-control" name="base_price" id="editbasePrice"  value="' . $data->base_price . '">                                 
                    </div>
                    <div class="form-group">
                        <label for="groupName">Grupna skrb - cijena/dan</label>
                            <input type="text" class="form-control" name="group_price" id="editgroupPrice"  value="' . $data->group_price . '">                                 
                    </div>';

        return response()->json(['html' => $html]);
    }

    // TODO: update

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->only(['name', 'base_price', 'group_price']), [
            'name' => 'required',
            'base_price' => 'required',
            'group_price' =>  'required'
        ], [
            'name.required' => 'Veličina je obvezan podatak',
            'base_price.required' => 'Unesite cijenu za solitarnu skrb',
            'group_price.required' => 'Unesite cijenu za grupnu skrb'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $sizeAttribute = new AnimalSizeAttribute;

        $sizeAttribute::find($id)->update([
            'name' => $request->name,
            'base_price' => $request->base_price,
            'group_price' => $request->group_price
        ]);

        return response()->json(['success' => 'Cijene uspješno spremljene.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $animal_size = new AnimalSizeAttribute;
        $animal_size::find($id)->delete();

        return response()->json(['success' => 'Cijena je uspješno uklonjena']);
    }
}