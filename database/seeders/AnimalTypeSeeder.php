<?php

namespace Database\Seeders;

use App\Models\Animal\AnimalType;
use Illuminate\Database\Seeder;

class AnimalTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AnimalType::create(['type_code' => 'SZJ', 'type_name' => 'Strogo zaštićena jedinka']);
        AnimalType::create(['type_code' => 'IJ', 'type_name' => 'Invazivna jedinka']);
        AnimalType::create(['type_code' => 'ZJ', 'type_name' => 'Zaplijenjena jedinka']);
    }
}
