<?php

namespace App\Imports;

use Maatwebsite\Excel\Row;
use App\Models\Animal\Animal;
use App\Models\Animal\AnimalCode;
use App\Models\Animal\AnimalOrder;
use App\Models\Animal\AnimalCategory;
use Maatwebsite\Excel\Concerns\OnEachRow;
use App\Models\Animal\AnimalSystemCategory;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AnimalCategoryImport implements OnEachRow, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function onRow(Row $row)
    {
        $row = $row->toArray();

        $animalSystemCategoryId = AnimalSystemCategory::where('latin_name', $row['razred'])->select('id')->first()->id;
        $animalOrderId = AnimalOrder::where('order_name', $row['red'])->select('id')->first()->id;

        AnimalCategory::updateOrCreate([
            'animal_system_category_id' => $animalSystemCategoryId,
            'animal_order_id' => $animalOrderId,
            'latin_name' => $row['porodica'],
        ]);
    }

    public function uniqueBy()
    {
        return 'id';
    }
}