<?php

namespace App\Http\Controllers;

use App\Models\FounderData;
use Illuminate\Http\Request;
use App\Models\Shelter\Shelter;
use Yajra\Datatables\Datatables;
use App\Models\Shelter\ShelterType;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\Validator;

class FounderDataController extends Controller
{

    public function index(Request $request)
    {
        $founders = FounderData::all();

        if($request->ajax()){
            $founders = FounderData::with('shelter')->where('shelter_id', auth()->user()->shelter->id)->get();

            return Datatables::of($founders)
                ->addColumn('action', function ($founder) {
                    $deleteUrl = route('shelters.founders.destroy', [$founder->shelter->id, $founder->id]);
                    $editUrl = route('shelters.founders.edit', [$founder->shelter->id, $founder->id]);

                    return '
                    <div class="d-flex align-items-center">
                        <a href="javascript:void()" class="trash btn btn-xs btn-danger mr-2" data-href="'. $deleteUrl .'">
                            <i class="mdi mdi-tooltip-trash"></i> 
                            Delete
                        </a>

                        <a href="'.$editUrl.'" class="edit btn btn-xs btn-info mr-2">
                            <i class="mdi mdi-tooltip-edit"></i> 
                            Edit
                        </a>
                    </div>
                    ';
                })->make(true);
        }

        return view('founder.index', [
            'founders' => $founders,
        ]);
    }

    public function create()
    {
        $type = ShelterType::all();

        return view('founder.create', [
            'type' => $type
        ]);
    }

    public function store(Request $request)
    {   
        $founder = new FounderData;
        $founder->shelter_id = auth()->user()->shelter->id;
        $founder->shelter_type_id = $request->shelter_type;
        $founder->name = $request->name;
        $founder->lastname = $request->lastname;
        $founder->address = $request->address;
        $founder->country = $request->country;
        $founder->contact = $request->contact;
        $founder->email = $request->email;
        $founder->service = $request->service;
        $founder->others = $request->others;
        $founder->save();

        if($request->founder_documents){
            $founder->addMultipleMediaFromRequest(['founder_documents'])
            ->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('founder_documents');
            });
        }
    
        return redirect()->back()->with('founder', 'Uspješno. Dodali ste novog nalaznika.');
    }

    public function edit(Shelter $shelter, FounderData $founder)
    {
        $mediaFiles = $founder->getMedia('founder_documents');
        $type = ShelterType::all();

        return view('founder.edit', [
            'founder' => $founder, 
            'mediaFiles' => $mediaFiles,
            'type' => $type
        ]);
    }

    public function update(Request $request, Shelter $shelter, FounderData $founder)
    {
        $founder->shelter_id = auth()->user()->shelter->id;
        $founder->shelter_type_id = $request->shelter_type;
        $founder->name = $request->name;
        $founder->lastname = $request->lastname;
        $founder->address = $request->address;
        $founder->country = $request->country;
        $founder->contact = $request->contact;
        $founder->email = $request->email;
        $founder->service = $request->service;
        $founder->others = $request->others;
        $founder->save();

        if($request->founder_documents){
            $founder->addMultipleMediaFromRequest(['founder_documents'])
            ->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('founder_documents');
            });
        }

        return redirect()->back()->with('msg_update', 'Uspješno ažurirano.');
    }

    public function destroy(Shelter $shelter, FounderData $founder)
    {
        $founder->delete();

        return response()->json(['msg'=>'success']);
        //return redirect()->route("founder.index")->with('msg', 'Uspješno obrisano.');
    }

    public function fileDelete($file)
    {
        $media = Media::find($file);
        $media->delete();

        return response()->json(['msg' => 'success']);
    }

    public function modalCreateFounder()
    {
        $type = ShelterType::all();

        $returnHTML = view('founder.modalCreate', ['type'=> $type])->render();

        return response()->json( array('success' => true, 'html' => $returnHTML) );
    }

    public function createFounder(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'service' => 'required',
                'shelter_type' => 'required'
            ],
            [
                'service.required' => 'Služba koja je izvršila zaplijenu je obvezno polje',
                'shelter_type.required' => 'Type je obvezno polje',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $founder = new FounderData;
        $founder->shelter_id = auth()->user()->shelter->id;
        $founder->shelter_type_id = $request->shelter_type;
        $founder->name = $request->name;
        $founder->lastname = $request->lastname;
        $founder->address = $request->address;
        $founder->country = $request->country;
        $founder->contact = $request->contact;
        $founder->email = $request->email;
        $founder->service = $request->service;
        $founder->others = $request->others;
        $founder->save();

        if($request->founder_documents){
            $founder->addMultipleMediaFromRequest(['founder_documents'])
            ->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('founder_documents');
            });
        }

        return response()->json(['success' => 'Uspješno dodano.']);
    }
}
