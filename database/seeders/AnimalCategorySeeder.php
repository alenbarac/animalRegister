<?php

namespace Database\Seeders;

use App\Models\Animal\AnimalCategory;
use Illuminate\Database\Seeder;

class AnimalCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AnimalCategory::create([
            'animal_system_category_id' => 1,
            'name' => 'psi',
            'latin_name' => 'Canidae'
        ]);

        AnimalCategory::create([
            'animal_system_category_id' => 1,
            'name' => 'mačke',
            'latin_name' => 'Felidae'
        ]);

        AnimalCategory::create([
            'animal_system_category_id' => 1,
            'name' => 'kune',
            'latin_name' => 'Mustelidae'
        ]);

        AnimalCategory::create([
            'animal_system_category_id' => 1,
            'name' => 'pravi tuljan',
            'latin_name' => 'Phocidae'
        ]);

        AnimalCategory::create([
            'animal_system_category_id' => 1,
            'name' => 'medvjedi',
            'latin_name' => 'Ursidae'
        ]);

        AnimalCategory::create([
            'animal_system_category_id' => 1,
            'name' => 'brazdeni kitovi',
            'latin_name' => 'Balaenopteridae'
        ]);

        AnimalCategory::create([
            'animal_system_category_id' => 1,
            'name' => 'šupljorošci ',
            'latin_name' => 'Bovidae'
        ]);

        AnimalCategory::create([
            'animal_system_category_id' => 1,
            'name' => 'oceanski dupini',
            'latin_name' => 'Delphinidae'
        ]);
    }
}
