<?php

namespace Database\Seeders;

use App\Models\Animal\AnimalSystemCategory;
use Illuminate\Database\Seeder;

class AnimalSystemCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $animalSystemCategory1 = AnimalSystemCategory::create([
            'name' => 'sisavci',
            'latin_name' => 'Mammalia'
        ]);
        $animalSystemCategory2 = AnimalSystemCategory::create([
            'name' => 'ptice',
            'latin_name' => 'Aves'
        ]);
        $animalSystemCategory3 = AnimalSystemCategory::create([
            'name' => 'gmazovi',
            'latin_name' => 'Reptilia'
        ]);
        $animalSystemCategory4 = AnimalSystemCategory::create([
            'name' => 'vodozemci',
            'latin_name' => 'Amphibia'
        ]);
        $animalSystemCategory5 = AnimalSystemCategory::create([
            'name' => 'ribe',
            'latin_name' => 'Pisces'
        ]);

        $animalSystemCategory1->shelterType()->attach([1,2,3,4]);
        $animalSystemCategory2->shelterType()->attach([2,3,4]);
        $animalSystemCategory3->shelterType()->attach([1,2,3]);
        $animalSystemCategory4->shelterType()->attach([1,2,3]);
        $animalSystemCategory5->shelterType()->attach([1,2,4]);
    }
}
