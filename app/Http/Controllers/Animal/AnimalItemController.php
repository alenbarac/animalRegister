<?php

namespace App\Http\Controllers\Animal;

use PDF;
use Carbon\Carbon;
use App\Models\DateRange;
use Illuminate\Support\Str;
use App\Models\DateFullCare;
use Illuminate\Http\Request;
use App\Models\Animal\Animal;
use App\Models\Shelter\Shelter;
use App\Models\Animal\AnimalData;
use App\Models\Animal\AnimalFile;
use App\Models\Animal\AnimalItem;
use App\Models\Animal\AnimalGroup;
use App\Models\ShelterAnimalPrice;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Animal\AnimalItemFile;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AnimalItemPostRequest;
use App\Http\Requests\AnimalItemFilePostRequest;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AnimalItemController extends Controller
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Shelter $shelter, AnimalGroup $animalGroup, AnimalItem $animalItem)
    {
        $animalItem = AnimalItem::with('animal', 'animalSizeAttributes', 'dateRange', 'animalMarks', 'animalItemLogs', 'founder')->find($animalItem->id);

        // Day and Price
        if (!empty($animalItem->dateRange->end_date)) {
            $from = Carbon::createFromFormat('d.m.Y', $animalItem->dateRange->start_date);
            $to = (isset($animalItem->dateRange->end_date)) ? Carbon::createFromFormat('d.m.Y', $animalItem->dateRange->end_date) : '';
            $diff_in_days = $to->diffInDays($from);
        }

        $totalPriceStand = (isset($animalItem->shelterAnimalPrice->stand_care)) ? $animalItem->shelterAnimalPrice->stand_care : 0;
        $totalPriceHibern = (isset($animalItem->shelterAnimalPrice->hibern)) ? $animalItem->shelterAnimalPrice->hibern : 0;
        $totalPriceFullCare = (isset($animalItem->shelterAnimalPrice->full_care)) ? $animalItem->shelterAnimalPrice->full_care : 0;

        return view('animal.animal_item.show', [
            'animalItem' => $animalItem,

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
        $animalItem = AnimalItem::findOrFail($id);
        $mediaItems = $animalItem->getMedia('media');
        $size = $animalItem->animal->animalSize;
        $dateRange = $animalItem->dateRange;

        $dateFullCare_total = $animalItem->dateFullCare;
        $countDays = 0;
        foreach ($dateFullCare_total as $key) {
            $countDays += $key->days;
        }
        $maxDate = 10;
        $totalCountForUse = ($maxDate - $countDays);
        $totalDays = $totalCountForUse;

        return view('animal.animal_item.edit', [
            'animalItem' => $animalItem,
            'mediaItems' => $mediaItems,
            'size' => $size,
            'dateRange' => $dateRange,
            'totalDays' => $totalDays,
            'dateFullCare_total' => $dateFullCare_total
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnimalItemPostRequest $request, $id)
    {
        $animalItem = AnimalItem::findOrFail($id);
        $animalItem->animal_size_attributes_id = $request->animal_size_attributes_id;
        $animalItem->animal_dob = $request->animal_dob;
        $animalItem->animal_gender = $request->animal_gender;
        $animalItem->location = $request->location;
        $animalItem->save();

        return redirect()->back()->with('msg_update', 'Uspješno ažurirano.');
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

    public function file(AnimalItemFilePostRequest $request)
    {
        $animalItemFile = AnimalItem::find($request->animal_item_id);

        // Update
        if ($request->filenames) {
            foreach ($request->filenames as $key) {
                $animalItemFile->addMedia($key)->toMediaCollection('media');
            }
        }

        return redirect('/animal_item/' . $request->animal_item_id . '/edit')->with('msg', 'Uspješno dodan dokument');
    }

    public function deleteFile($file)
    {
        $media = Media::find($file);
        $media->delete();

        return response()->json(['msg' => 'success']);
    }

    public function changeShelter(Request $request, AnimalItem $animalItem)
    {
        $animal_items = AnimalItem::with('dateRange', 'dateFullCare', 'animalGroup')->find($animalItem->id);
        $newShelter = Shelter::find($request->selectedShelter);

        // Zadnji ID u grupi
        $incrementId = AnimalGroup::orderBy('id', 'DESC')->first();
        $increment = $incrementId->id + 1;

        // Promjena količine na trenutnoj grupi
        $animal_group = AnimalGroup::find($animal_items->animalGroup->id);
        $animal_group->decrement('quantity', 1);
        $animal_group->save();

        // New group
        $newAnimalGroup = new AnimalGroup;
        $newAnimalGroup->animal_id = $animal_items->animal_id;
        $newAnimalGroup->shelter_code = Carbon::now()->format('Y') . '' . $newShelter->shelter_code . '/' . $increment;
        $newAnimalGroup->quantity = 1;
        $newAnimalGroup->save();

        // Pivot table
        $newAnimalGroup->shelters()->attach($newAnimalGroup->id, [
            'shelter_id' => $request->selectedShelter,
            'active_group' => true,
        ]);

        // Update status animalItem
        $animal_items->in_shelter = false;
        $animal_items->save();

        // Copy Item
        $newAnimalItem = $animal_items->replicate();
        $newAnimalItem->animal_group_id = $newAnimalGroup->id;
        $newAnimalItem->shelter_id = $newShelter->id;
        $newAnimalItem->in_shelter = true;
        $newAnimalItem->save();

        // Date full care
        $dateFullCare = DateFullCare::where('animal_item_id', $animal_items->id)->get();
        if (!empty($dateFullCare)) {
            foreach ($dateFullCare as $item) {
                $newDateRange = $item->replicate();
                $newDateRange->animal_item_id = $newAnimalItem->id;
                $newDateRange->save();
            }
        }

        // Date Range
        $dateRange = DateRange::find($animal_items->dateRange->id);
        $newDateRange = $dateRange->replicate();
        $newDateRange->animal_item_id = $newAnimalItem->id;
        $newDateRange->save();

        return response()->json([
            'msg' => 'success',
            'back' => $request->currentShelter,
            'newShelter' => $newShelter
        ]);
    }

    public function generatePDF($id)
    {
        $animalItems = AnimalItem::with('animal', 'shelter', 'animalSizeAttributes')->find($id);
        $animalFiles = AnimalFile::where('shelter_code', $animalItems->shelter_code)->get();

        $mediaFiles = $animalFiles->each(function ($item, $key) {
            $item->getMedia('media');
        });

        $pdf = PDF::loadView('myPDF', compact('animalItems', 'mediaFiles'));

        return $pdf->stream('my.pdf');
    }
}
