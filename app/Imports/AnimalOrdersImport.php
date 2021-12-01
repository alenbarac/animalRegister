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

class AnimalOrdersImport implements OnEachRow, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function onRow(Row $row)
    {
        $row = $row->toArray();

        $animalSystemCategoryId = AnimalSystemCategory::where('latin_name', $row['order_class'])->pluck('id')->first();


        AnimalOrder::updateOrCreate([
            'animal_system_category_id' => $animalSystemCategoryId,
            'order_name' => $row['order_name'],
        ]);
    }

    public function uniqueBy()
    {
        return 'id';
    }
}