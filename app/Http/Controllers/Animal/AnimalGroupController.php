<?php

namespace App\Http\Controllers\Animal;

use Carbon\Carbon;
use App\Models\DateRange;
use Illuminate\Http\Request;
use App\Models\Shelter\Shelter;
use Yajra\Datatables\Datatables;
use App\Models\Animal\AnimalItem;
use App\Models\Animal\AnimalGroup;
use App\Http\Controllers\Controller;

class AnimalGroupController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Shelter $shelter, AnimalGroup $animalGroup)
    {
        $animal_group = AnimalGroup::with('animalItems', 'shelters')->find($animalGroup->id);
        $animal_items = $animal_group->animalItems;
        $shelters = Shelter::where('id', '!=', $shelter->id)->get();

        if ($request->ajax()) {
            return DataTables::of($animal_items)
                ->addIndexColumn()
                ->addColumn('name', function ($animal_items) {
                    return $animal_items->animal->name;
                })
                ->addColumn('latin_name', function ($animal_items) {
                    return $animal_items->animal->latin_name;
                })
                ->addColumn('action', function ($animal_items) {
                    $url = route('shelters.animal_groups.animal_items.show', [$animal_items->shelter_id, $animal_items->animal_group_id, $animal_items->id]);

                    return '
                <div class="d-flex align-items-center">
                    <a href="'.$url.'" class="btn btn-xs btn-info btn-sm mr-2">
                        Info
                    </a>

                    <a href="javascript:void(0)" id="changeShelterItem" data-id="'.$animal_items->id.'" class="btn btn-xs btn-warning btn-sm mr-2">
                        Premjesti
                    </a>
                </div>
                ';
                })
                ->make();
        }

        return view('animal.animal_group.show', [
            'animal_group' => $animal_group,
            'animal_items' => $animal_items,
            'shelters' => $shelters
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
        //
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
        //
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

    public function groupChangeShelter(Request $request, AnimalGroup $animalGroup)
    {
        $animal_group = AnimalGroup::find($animalGroup->id);
        $newShelter = Shelter::find($request->selectedShelter);

        // Promjena stanja na trenutnoj grupi
        $animal_group->shelters()->updateExistingPivot($animal_group->id, array('active_group' => false), false);

        // Zadnji ID u grupi
        $incrementId = AnimalGroup::orderBy('id', 'DESC')->first();
        $increment = $incrementId->id + 1;

        // Duplicate Grupe sa novom šifrom oporavilišta
        $newAnimalGroup = $animal_group->replicate();
        $newAnimalGroup->shelter_code = Carbon::now()->format('Y') .''. $newShelter->shelter_code .'/'. $increment;
        $newAnimalGroup->save();

        // Novi red u pivot tablici koji povezuje dupliciranu grupu i novo oporavilište
        $newAnimalGroup->shelters()->attach($newAnimalGroup->id, [
            'shelter_id' => $request->selectedShelter,
            'active_group' => true,
        ]);

        // Animal Items - Dupliciranje i promjena Id Sheltera
        $animalItems = AnimalItem::with('dateRange')->where('animal_group_id', $animal_group->id)->get();
        foreach ($animalItems as $item) {
            $newAnimalItems = $item->replicate();
            $newAnimalItems->animal_group_id = $newAnimalGroup->id;
            $newAnimalItems->shelter_id = $newShelter->id;
            $newAnimalItems->save();

            // Date Range dulicate for new items
            $dateRange = DateRange::find($item->dateRange->id);
            $newDateRange = $dateRange->replicate();
            $newDateRange->animal_item_id = $newAnimalItems->id;
            $newDateRange->save();
        }

        return response()->json([
            'msg' => 'success', 
            'back' => $request->currentShelter,
            'newShelter' => $newShelter
        ]);
    }
}
