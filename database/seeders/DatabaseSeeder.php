<?php

use Illuminate\Database\Seeder;
use Database\Seeders\ShelterSeeder;
use Database\Seeders\AnimalCodeSeeder;
use Database\Seeders\AnimalSizeSeeder;
use Database\Seeders\AnimalTypeSeeder;
use Database\Seeders\ShelterTypeSeeder;
use Database\Seeders\AnimalMarkTypeSeeder;
use Database\Seeders\PermissionsDemoSeeder;
use Database\Seeders\ShelterStaffTypeSeeder;
use Database\Seeders\AnimalItemLogTypeSeeder;
use Database\Seeders\AnimalSizeAttributeSeeder;
use Database\Seeders\AnimalSystemCategorySeeder;
use Database\Seeders\ShelterEquipmentTypeSeeder;
use Database\Seeders\ShelterAccomodationTypeSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsDemoSeeder::class);
        $this->call(ShelterSeeder::class);
        $this->call(ShelterTypeSeeder::class);
        $this->call(ShelterStaffTypeSeeder::class);
        $this->call(ShelterStaffTypeSeeder::class);
        $this->call(AnimalSystemCategorySeeder::class);
        $this->call(ShelterAccomodationTypeSeeder::class);
        $this->call(AnimalTypeSeeder::class);
        $this->call(AnimalCodeSeeder::class);
        $this->call(AnimalSizeSeeder::class);
        $this->call(AnimalSizeAttributeSeeder::class);
        $this->call(ShelterEquipmentTypeSeeder::class);
        $this->call(AnimalMarkTypeSeeder::class);
        $this->call(AnimalItemLogTypeSeeder::class);
    }
}
