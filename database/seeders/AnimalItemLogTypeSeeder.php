<?php

namespace Database\Seeders;

use App\Models\Animal\AnimalItemLogType;
use Illuminate\Database\Seeder;

class AnimalItemLogTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AnimalItemLogType::create(['type_name' => 'Tekstualni opis']);
        AnimalItemLogType::create(['type_name' => 'Status - solitarno/grupa']);
        AnimalItemLogType::create(['type_name' => 'Način držanja - hibernacija']);
        AnimalItemLogType::create(['type_name' => 'Prebacivanje u drugu ustanovu']);
        AnimalItemLogType::create(['type_name' => 'Usmrćivanje jedinke']);
    }
}
