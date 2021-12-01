<?php

namespace Database\Seeders;

use App\Models\Shelter\Shelter;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ShelterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shelter1 = Shelter::factory()->create([
            'name' => 'Aquarium Pula d.o.o.',
            'oib' => 972615522,
            'address' => 'Verudela bb, HR-52100 Pula',
            'address_place' => 'Verudela bb',
            'place_zip' => 52100,
        ]);
        $shelter1->shelterTypes()->attach([1, 2, 3]);
        $shelter1->animalSystemCategory()->attach([1, 3]);

        $shelter2 = Shelter::factory()->create([
            'name' => 'AWAP – Udruga za zaštitu divljih životinja',
            'address' => 'Siget 6, HR-10000 Zagreb',
            'address_place' => 'Siget 6',
            'oib' => 28856251627,
            'place_zip' => 10000,
        ]);
        $shelter2->shelterTypes()->attach([1, 2]);
        $shelter2->animalSystemCategory()->attach([3, 4, 5]);

        $shelter3 = Shelter::factory()->create([
            'name' => 'Javna ustanova Nacionalni park Brijuni',
            'address' => 'Brionska 10, HR-52212 Fažana',
            'address_place' => 'Brionska 10',
            'oib' => 79193158584,
            'place_zip' => 52212,
        ]);
        $shelter3->shelterTypes()->attach(1);
        $shelter3->animalSystemCategory()->attach([2, 5]);
    }
}
