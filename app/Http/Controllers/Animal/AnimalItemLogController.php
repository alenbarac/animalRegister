<?php

namespace App\Http\Controllers\Animal;

use Illuminate\Http\Request;
use App\Models\Animal\AnimalItem;
use App\Http\Controllers\Controller;
use App\Models\Animal\AnimalItemLog;
use App\Models\Animal\AnimalItemLogType;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class AnimalItemLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AnimalItem $animalItem)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(AnimalItem $animalItem)
    {
        $logTypes = AnimalItemLogType::all();
        $animalLogs = AnimalItemLog::with('logType')->latest()->get();

        return view('animal.animal_item_log.create', compact('animalItem', 'logTypes', 'animalLogs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AnimalItem $animalItem)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'log_subject' => 'required',
                'log_body' => 'required',
            ],
            [
                'log_subject.required' => 'Predmet je obvezano polje',
                'log_body.required' => 'Unesite opis postupanja',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        $logType = AnimalItemLogType::find($request->log_type);
        $animalItemLog = new AnimalItemLog;
        $animalItemLog->log_subject = $request->log_subject;
        $animalItemLog->log_body = $request->log_body;
        $animalItemLog->animalItem()->associate($animalItem->id);
        $animalItemLog->logType()->associate($logType);
        $animalItemLog->save();

        if ($request->hasFile('animal_log_photos')) {
            foreach ($request->file('animal_log_photos') as $doc) {
                $animalItemLog->addMedia($doc)->toMediaCollection('log-docs');
            }
        }
        return response()->json(['success' => 'Zapis postupanja uspješno spremljen.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(AnimalItem $animalItem, AnimalItemLog $animalItemLog)
    {
        return view('animal.animal_item_log.show', ['animalItem' => $animalItem, 'animalItemLog' => $animalItemLog]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(AnimalItem $animalItem, AnimalItemLog $animalItemLog)
    {
        $logTypes = AnimalItemLogType::all('id', 'type_name');
        $selectedLogType = $animalItemLog->animal_item_log_type_id;
        return view('animal.animal_item_log.edit', ['animalItem' => $animalItem, 'animalItemLog' => $animalItemLog, 'logTypes' => $logTypes, 'selectedLogType' => $selectedLogType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnimalItem $animalItem, AnimalItemLog $animalItemLog)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'edit_log_subject' => 'required',
                'edit_log_body' => 'required',
            ],
            [
                'edit_log_subject.required' => 'Predmet je obvezano polje',
                'edit_log_body.required' => 'Unesite opis postupanja',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        $logType = AnimalItemLogType::find($request->log_type);
        $animalItemLog = AnimalItemLog::find($animalItemLog->id);
        $animalItemLog->log_subject = $request->edit_log_subject;
        $animalItemLog->log_body = $request->edit_log_body;
        $animalItemLog->animalItem()->associate($animalItem->id);
        $animalItemLog->logType()->associate($logType);
        $animalItemLog->save();

        if ($request->hasFile('edit_animal_log_photos')) {
            foreach ($request->file('edit_animal_log_photos') as $doc) {
                $animalItemLog->addMedia($doc)->toMediaCollection('log-docs');
            }
        }
        $redirectUrl = '/animal_items/' . $animalItem->id . '/animal_item_logs/' . $animalItemLog->id . '/';
        return response()->json(['success' => 'Zapis postupanja uspješno spremljen.', 'redirectTo' => $redirectUrl]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnimalItem $animalItem, AnimalItemLog $animalItemLog)
    {
        $animalItemLog->delete();
        return response()->json(['success' => 'Zapis postupanja uspješno izbrisan.']);
    }

    public function deleteImage($img)
    {
        $media = Media::find($img);
        $media->delete();

        return response()->json(['msg' => 'success']);
    }
}
