<?php

namespace Database\Seeders;

use App\Models\Animal\AnimalSize;
use Illuminate\Database\Seeder;

class AnimalSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        AnimalSize::create([
            'group_name' => 'vodozemci',
        ]);

        AnimalSize::create([
            'group_name' => 'kopnene kornjače',
        ]);

        AnimalSize::create([
            'group_name' => 'morske i vodene kornjače',
        ]);

        AnimalSize::create([
            'group_name' => 'zmije',
        ]);

        AnimalSize::create([
            'group_name' => 'gušteri',
        ]);

        AnimalSize::create([
            'group_name' => 'krokodili, aligatori, gavijali',
        ]);

        AnimalSize::create([
            'group_name' => 'papige',
        ]);

        AnimalSize::create([
            'group_name' => 'pjevice',
        ]);

        AnimalSize::create([
            'group_name' => 'vodarice i guske',
        ]);

        AnimalSize::create([
            'group_name' => 'rodarice i ždralovke',
        ]);

        AnimalSize::create([
            'group_name' => 'grabljivice i sovke',
        ]);

        AnimalSize::create([
            'group_name' => 'golubovi i grlice',
        ]);

        AnimalSize::create([
            'group_name' => 'djetlovke i tukani',
        ]);

        AnimalSize::create([
            'group_name' => 'vodomari',
        ]);

        AnimalSize::create([
            'group_name' => 'fazani',
        ]);

        AnimalSize::create([
            'group_name' => 'kukcojedi',
        ]);

        AnimalSize::create([
            'group_name' => 'šišmiši',
        ]);

        AnimalSize::create([
            'group_name' => 'primati',
        ]);

        AnimalSize::create([
            'group_name' => 'glodavci',
        ]);

        AnimalSize::create([
            'group_name' => 'zvijeri',
        ]);

        AnimalSize::create([
            'group_name' => 'tobolčari',
        ]);

        AnimalSize::create([
            'group_name' => 'neparnoprstaši',
        ]);

        AnimalSize::create([
            'group_name' => 'parnoprstaši',
        ]);

        AnimalSize::create([
            'group_name' => 'mravojedi i srodnici',
        ]);
    }
}
