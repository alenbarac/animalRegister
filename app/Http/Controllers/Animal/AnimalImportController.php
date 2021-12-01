<?php

namespace App\Http\Controllers\Animal;

use Illuminate\Http\Request;

use App\Imports\AnimalOrdersImport;
use App\Imports\AnimalSeizedImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AnimalCategoryImport;
use App\Imports\AnimalInvaziveImport;
use App\Imports\AnimalProtectedImport;


class AnimalImportController extends Controller
{
    public function index()
    {
        return view('animal.animal_import.index');
    }

    public function animalOrderFileImport(Request $request)
    {
        $validated = $request->validate([
            'animal_order_import' => 'required | mimes:xlsx,csv',
        ], [
            'animal_order_import.required' => 'Odaberite Dokument za Učitavanje',
            'animal_order_import.mimes' => 'Datoteka treba biti u XLSX ili CSV formatu'
        ]);

        Excel::import(new AnimalOrdersImport, $request->file('animal_order_import')->store('temp'));

        return redirect()->route('animal_import.index')->with('msg', 'Datoteka je uspješno učtana');
    }

    public function animalCategoryFileImport(Request $request)
    {
        $validated = $request->validate([
            'animal_category_import' => 'required | mimes:xlsx,csv',
        ], [
            'animal_category_import.required' => 'Odaberite Dokument za Učitavanje',
            'animal_category_import.mimes' => 'Datoteka treba biti u XLSX ili CSV formatu'
        ]);

        Excel::import(new AnimalCategoryImport, $request->file('animal_category_import')->store('temp'));
        return redirect()->route('animal_import.index')->with('msg', 'Datoteka je uspješno učtana');
    }

    public function animalProtectedFileImport(Request $request)
    {
        $validated = $request->validate([
            'animal_sz_import' => 'required | mimes:xlsx,csv',
        ], [
            'animal_sz_import.required' => 'Odaberite Dokument sa Strogo Zaštićenim jedinkama',
            'animal_sz_import.mimes' => 'Datoteka treba biti u XLSX ili CSV formatu'
        ]);


        Excel::import(new AnimalProtectedImport(), $request->file('animal_sz_import')->store('temp'));
        return redirect()->route('animal_import.index')->with('msg', 'Datoteka je uspješno učtana');
    }

    public function animalInvaziveImport(Request $request)
    {
        $validated = $request->validate([
            'animal_invazive_import' => 'required | mimes:xlsx,csv',
        ], [
            'animal_invazive_import.required' => 'Odaberite Dokument s Invazivnim jedinkama',
            'animal_invazive_import.mimes' => 'Datoteka treba biti u XLSX ili CSV formatu'
        ]);

        Excel::import(new AnimalInvaziveImport(), $request->file('animal_invazive_import')->store('temp'));
        return redirect()->route('animal_import.index')->with('msg', 'Datoteka je uspješno učtana');
    }

    public function animalSeizedImport(Request $request)
    {

        $validated = $request->validate([
            'animal_seized_import' => 'required | mimes:xlsx,csv',
        ], [
            'animal_seized_import.required' => 'Odaberite Dokument sa Zapljenjenim jedinkama',
            'animal_seized_import.mimes' => 'Datoteka treba biti u XLSX ili CSV formatu'
        ]);

        Excel::import(new AnimalSeizedImport(), $request->file('animal_seized_import')->store('temp'));
        return redirect()->route('animal_import.index')->with('msg', 'Datoteka je uspješno učtana');
    }
}
