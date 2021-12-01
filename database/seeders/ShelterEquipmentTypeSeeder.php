<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shelter\ShelterEquipmentType;

class ShelterEquipmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShelterEquipmentType::create([
            'name' => 'Oprema za hvatanje životinja',
            'type' => 'oprema',
            'type_mark' => 'B6',
            'type_description' => 'Osigurana oprema za hvatanje životinja, transport i provođenje skrbi za sve vrste ili skupine divljih životinja za koje podnositelj prijave iskazuje interes'
        ]);

        ShelterEquipmentType::create([
            'name' => 'Transport životinja',
            'type' => 'oprema',
            'type_mark' => 'B6',
            'type_description' => 'Osigurana oprema za hvatanje životinja, transport i provođenje skrbi za sve vrste ili skupine divljih životinja za koje podnositelj prijave iskazuje interes'
        ]);

        ShelterEquipmentType::create([
            'name' => 'Oprema za provođenje skrbi',
            'type' => 'oprema',
            'type_mark' => 'B6',
            'type_description' => 'Osigurana oprema za hvatanje životinja, transport i provođenje skrbi za sve vrste ili skupine divljih životinja za koje podnositelj prijave iskazuje interes'
        ]);

        ShelterEquipmentType::create([
            'name' => 'Osiguran prijevoz životinja prometnim sredstvima',
            'type' => 'prijevoz',
            'type_mark' => 'B7',
            'type_description' => 'Osiguran prijevoz životinja prometnim sredstvima u skladu s posebnim propisima o zaštiti životinja tijekom prijevoza i s prijevozom povezanih postupaka'
        ]);

        ShelterEquipmentType::create([
            'name' => 'Održavanje i dezinfekcija prostora te opreme',
            'type' => 'održavanje i dezinfekcija',
            'type_mark' => 'B9',
            'type_description' => 'Osigurano održavanje i dezinfekcija prostora te opreme u skladu s posebnim propisima'
        ]);

        ShelterEquipmentType::create([
            'name' => 'Zbrinjavanje lešina i nusproizvoda životinjskog podrijetla',
            'type' => 'zbrinjavanje lešina',
            'type_mark' => 'B8',
            'type_description' => 'Osigurano redovito zbrinjavanje lešina životinja i nusproizvoda životinjskog podrijetla u skladu s posebnim propisima'
        ]);
    }
}
