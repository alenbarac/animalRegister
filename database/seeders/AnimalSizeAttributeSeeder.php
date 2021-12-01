<?php

namespace Database\Seeders;

use App\Models\Animal\AnimalSizeAttribute;
use Illuminate\Database\Seeder;

class AnimalSizeAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AnimalSizeAttribute::create([
            'animal_size_id' => 1,
            'name' => 'sve veličine jedinke',
            'base_price' => 15,
            'group_price' => 9
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 2,
            'name' => 'male <= 0,5 kg',
            'base_price' => 14,
            'group_price' => 8
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 2,
            'name' => 'srednje 0,5 do 2 kg',
            'base_price' => 30,
            'group_price' => 22
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 2,
            'name' => 'velike > 2 kg',
            'base_price' => 50,
            'group_price' => 35
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 3,
            'name' => 'male <= 0,5 kg',
            'base_price' => 16,
            'group_price' => 8
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 3,
            'name' => 'srednje 0,5 do 2 kg',
            'base_price' => 32,
            'group_price' => 18
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 3,
            'name' => 'velike > 2 kg',
            'base_price' => 55,
            'group_price' => 35
        ]);


        AnimalSizeAttribute::create([
            'animal_size_id' => 4,
            'name' => 'male duljine <= 0,5 m',
            'base_price' => 5,
            'group_price' => 3
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 4,
            'name' => 'srednje duljine 0,5 do 1,5 m',
            'base_price' => 8,
            'group_price' => 5
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 4,
            'name' => 'velike duljine > 1,5 m',
            'base_price' => 15,
            'group_price' => 12
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 5,
            'name' => 'mali (do 99 g)',
            'base_price' => 5,
            'group_price' => 2
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 5,
            'name' => 'srednji (do 1 kg)',
            'base_price' => 14,
            'group_price' => 8
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 5,
            'name' => 'veliki (iznad 1 kg)',
            'base_price' => 23,
            'group_price' => 15
        ]);


        AnimalSizeAttribute::create([
            'animal_size_id' => 6,
            'name' => 'male duljine <= 70 cm',
            'base_price' => 20,
            'group_price' => 14
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 6,
            'name' => 'velike duljine > 70 cm',
            'base_price' => 33,
            'group_price' => 25
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 7,
            'name' => 'male <= 100 g',
            'base_price' => 4,
            'group_price' => 4
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 7,
            'name' => 'srednje 101-399 g',
            'base_price' => 6,
            'group_price' => 6
        ]);


        AnimalSizeAttribute::create([
            'animal_size_id' => 7,
            'name' => 'velike >= 400 g',
            'base_price' => 10,
            'group_price' => 10
        ]);


        AnimalSizeAttribute::create([
            'animal_size_id' => 8,
            'name' => 'male <= 30 g',
            'base_price' => 2,
            'group_price' => 2
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 8,
            'name' => 'srednje 31-299 g',
            'base_price' => 6,
            'group_price' => 6
        ]);


        AnimalSizeAttribute::create([
            'animal_size_id' => 8,
            'name' => 'velike >= 300 g',
            'base_price' => 12,
            'group_price' => 12
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 9,
            'name' => 'male <= 1 kg',
            'base_price' => 12,
            'group_price' => 8
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 9,
            'name' => 'velike > 1 kg',
            'base_price' => 14,
            'group_price' => 10
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 10,
            'name' => 'male <= 1 kg',
            'base_price' => 5,
            'group_price' => 4
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 10,
            'name' => 'velike > 1 kg',
            'base_price' => 17,
            'group_price' => 15
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 11,
            'name' => 'male <= 199 g',
            'base_price' => 15,
            'group_price' => 10
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 11,
            'name' => 'srednje 200g - 2 kg',
            'base_price' => 45,
            'group_price' => 40
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 11,
            'name' => 'velike >= 2 kg',
            'base_price' => 75,
            'group_price' => 70
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 12,
            'name' => 'sve veličine jedinke',
            'base_price' => 4,
            'group_price' => 3
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 13,
            'name' => 'sve veličine jedinke',
            'base_price' => 25,
            'group_price' => 22
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 14,
            'name' => 'sve veličine jedinke',
            'base_price' => 25,
            'group_price' => 22
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 15,
            'name' => 'sve veličine jedinke',
            'base_price' => 16,
            'group_price' => 15
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 16,
            'name' => 'sve veličine jedinke',
            'base_price' => 15,
            'group_price' => 12
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 17,
            'name' => 'mali <= 100 g',
            'base_price' => 25,
            'group_price' => 8
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 17,
            'name' => 'veliki > 100 g',
            'base_price' => 25,
            'group_price' => 13
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 18,
            'name' => 'mali <= 1 kg',
            'base_price' => 80,
            'group_price' => 60
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 18,
            'name' => 'srednji od 1 do 5 kg',
            'base_price' => 40,
            'group_price' => 25
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 18,
            'name' => 'veliki od 5 kg do 20 kg',
            'base_price' => 45,
            'group_price' => 35
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 18,
            'name' => 'vrlo veliki > 20 kg',
            'base_price' => 130,
            'group_price' => 100
        ]);


        AnimalSizeAttribute::create([
            'animal_size_id' => 19,
            'name' => 'mali <= 1 kg',
            'base_price' => 9,
            'group_price' => 5
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 19,
            'name' => 'srednji od 1 kg do 5 kg',
            'base_price' => 13,
            'group_price' => 8
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 19,
            'name' => 'veliki > 5 kg',
            'base_price' => 17,
            'group_price' => 12
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 20,
            'name' => 'male <=1 kg',
            'base_price' => 35,
            'group_price' => 30
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 20,
            'name' => 'srednje od 1 do 10 kg',
            'base_price' => 65,
            'group_price' => 60
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 20,
            'name' => 'velike od 10 kg do 50 kg',
            'base_price' => 90,
            'group_price' => 80
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 20,
            'name' => 'vrlo velike > 50 kg',
            'base_price' => 250,
            'group_price' => 200
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 21,
            'name' => 'mali do 2 kg',
            'base_price' => 25,
            'group_price' => 18
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 21,
            'name' => 'srednji od 2 do 15 kg',
            'base_price' => 45,
            'group_price' => 35
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 21,
            'name' => 'veliki > 15 kg',
            'base_price' => 160,
            'group_price' => 130
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 22,
            'name' => 'sve veličine jedinke',
            'base_price' => 65,
            'group_price' => 50
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 23,
            'name' => 'mali do 50 kg',
            'base_price' => 40,
            'group_price' => 30
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 23,
            'name' => 'veliki > 50 kg',
            'base_price' => 75,
            'group_price' => 50
        ]);

        AnimalSizeAttribute::create([
            'animal_size_id' => 24,
            'name' => 'sve veličine jedinke',
            'base_price' => 80,
            'group_price' => 70
        ]);
    }
}
