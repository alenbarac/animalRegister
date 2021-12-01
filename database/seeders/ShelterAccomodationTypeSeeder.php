<?php

namespace Database\Seeders;

use App\Models\Shelter\ShelterAccomodationType;
use Illuminate\Database\Seeder;

class ShelterAccomodationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShelterAccomodationType::create([
            'name' => 'Kavez',
            'type' => 'nastamba',
            'type_mark' => 'B1',
            'type_description' => 'Osigurane opremljene nastambe'
        ]);

        ShelterAccomodationType::create([
            'name' => 'Boks',
            'type' => 'nastamba',
            'type_mark' => 'B1',
            'type_description' => 'Osigurane opremljene nastambe'
        ]);

        ShelterAccomodationType::create([
            'name' => 'Letnica',
            'type' => 'nastamba',
            'type_mark' => 'B1',
            'type_description' => 'Osigurane opremljene nastambe'
        ]);

        ShelterAccomodationType::create([
            'name' => 'Terarij',
            'type' => 'nastamba',
            'type_mark' => 'B1',
            'type_description' => 'Osigurane opremljene nastambe'
        ]);

        ShelterAccomodationType::create([
            'name' => 'Akvarij',
            'type' => 'nastamba',
            'type_mark' => 'B1',
            'type_description' => 'Osigurane opremljene nastambe'
        ]);

        ShelterAccomodationType::create([
            'name' => 'Bazen',
            'type' => 'nastamba',
            'type_mark' => 'B1',
            'type_description' => 'Osigurane opremljene nastambe'
        ]);

        ShelterAccomodationType::create([
            'name' => 'Prostor - skrb, intenzivno liječenje',
            'type' => 'prostor',
            'type_mark' => 'B2',
            'type_description' => 'Osiguran zaseban prostor za provođenje skrbi o životinji u razdoblju životne ugroze i intenzivnog veterinarskog liječenja'
        ]);

        ShelterAccomodationType::create([
            'name' => 'Prostor - povratak u prirodu, samostalni život',
            'type' => 'prostor',
            'type_mark' => 'B3a',
            'type_description' => 'Prostor namijenjen za pripremu jedinki za povratak u prirodu'
        ]);

        ShelterAccomodationType::create([
            'name' => 'Prostor - mjere za sprječavanje uznemiravanja ptica',
            'type' => 'prostor',
            'type_mark' => 'B3b',
            'type_description' => 'Mjere za sprječavanje uznemiravanja i navikavanja ptica tijekom cijelog postupka oporavka na prisutnost ljudi'
        ]);

        ShelterAccomodationType::create([
            'name' => 'Prostor - priprema za povratak u prirodu',
            'type' => 'prostor',
            'type_mark' => 'B3c',
            'type_description' => 'Priprema životinja za povratak u prirodu'

        ]);

        ShelterAccomodationType::create([
            'name' => 'Prostor - odvajanje, označavanje zaplijenjenih životinja',
            'type' => 'prostor',
            'type_mark' => 'B4',
            'type_description' => 'Mogućnost odvajanja i/ili privremenog označavanja zaplijenjenih i oduzetih životinja'
        ]);
    }
}
