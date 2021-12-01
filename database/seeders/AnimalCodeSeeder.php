<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Animal\AnimalCode;

class AnimalCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AnimalCode::create(['name' => 'PZ', 'desc' => 'Prioritetne za zbrinjavanje']);

        AnimalCode::create(['name' => 'CR', 'desc' => 'Kritično ugrožena vrsta']);

        AnimalCode::create(['name' => 'DD', 'desc' => 'Nedovoljno poznata']);

        AnimalCode::create(['name' => 'RE', 'desc' => 'Regionalno izumrla vrsta']);

        AnimalCode::create(['name' => 'EN', 'desc' => 'Ugrožena vrsta']);

        AnimalCode::create(['name' => 'VU', 'desc' => 'Osjetljiva vrsta']);

        AnimalCode::create(['name' => 'LC', 'desc' => 'Najmanje zabrinjavajuća']);

        AnimalCode::create(['name' => 'NT', 'desc' => 'Gotovo ugrožena vrsta']);
    }
}
