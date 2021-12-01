<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalSystemCategoryShelterTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal_system_category_shelter_type', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedInteger('animal_system_category_id');
            $table->unsignedInteger('shelter_type_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animal_system_category_shelter_type');
    }
}
