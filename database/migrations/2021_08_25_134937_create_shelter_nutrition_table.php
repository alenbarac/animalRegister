<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShelterNutritionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shelter_nutrition', function (Blueprint $table) {
            $table->id();

            $table->string('nutrition_unit');
            $table->longText('nutrition_desc');
            $table->foreignId('animal_system_category_id')->nullable();
            $table->foreignId('shelter_id')->constrained('shelters');

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
        Schema::dropIfExists('shelter_unit_nutrition');
    }
}
