<?php

namespace Database\Seeders;

use App\Models\Animal\AnimalMarkType;
use Illuminate\Database\Seeder;

class AnimalMarkTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AnimalMarkType::create([
            'name' => 'mikročip',
            'desc' => 'trajna oznaka'
        ]);

        AnimalMarkType::create([
            'name' => 'odašiljač',
            'desc' => 'trajna oznaka'
        ]);

        AnimalMarkType::create([
            'name' => 'zatvoreni prsten',
            'desc' => 'trajna oznaka'
        ]);

        AnimalMarkType::create([
            'name' => 'otvoreni prsten',
            'desc' => 'privremena oznaka'
        ]);

        AnimalMarkType::create([
            'name' => 'krilna markica',
            'desc' => 'privremena oznaka'
        ]);

        AnimalMarkType::create([
            'name' => 'ušna markica',
            'desc' => 'privremena oznaka'
        ]);

        AnimalMarkType::create([
            'name' => 'neoznačeno',
            'desc' => 'neoznačeno'
        ]);
    }
}
