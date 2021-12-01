<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('animal_system_category_id')->nullable();
            $table->foreignId('animal_order_id')->nullable();
            $table->string('latin_name')->nullable();
            $table->string('name')->nullable();

            $table->timestamps();
        });
    }

    /**ž
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animal_categories');
    }
}
