<?php

namespace App\Imports;

use Maatwebsite\Excel\Row;
use App\Models\Animal\Animal;
use App\Models\Animal\AnimalSize;
use App\Models\Animal\AnimalCategory;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AnimalSeizedImport implements OnEachRow, WithHeadingRow
{
  /**
   * @param array $row
   *
   * @return \Illuminate\Database\Eloquent\Model|null
   */


  public function onRow(Row $row)
  {
    $row = $row->toArray();
    $animalCategoryId = AnimalCategory::where('latin_name', $row['order_name'])->pluck('id')->first();
    $animalSizeId = AnimalSize::where('group_name', $row['size_group'])->pluck('id')->first();

    $animal = Animal::updateOrCreate([
      'animal_category_id' => $animalCategoryId,
      'animal_size_id' => $animalSizeId,
      'name' => $row['name'],
      'latin_name' => $row['latin_name'],
    ]);
    $animal->animalType()->sync($row['type']);
  }

  public function uniqueBy()
  {
    return 'id';
  }
}