<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shelter\ShelterType;

class ShelterTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShelterType::create([
            'name' => 'Zaplijenjene jedinke',
            'code' => 'ZJ'
        ]);
        ShelterType::create([
            'name' => 'Invazivna jedinka',
            'code' => 'IJ'
        ]);
        ShelterType::create([
            'name' => 'Strogo zaštićena jedinka',
            'code' => 'SZJ'
        ]);
    }
}
