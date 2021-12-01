<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalSizeAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal_size_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('animal_size_id');
            $table->string('name');
            $table->decimal('base_price', 10, 2)->default(0);
            $table->decimal('group_price', 10, 2)->default(0);

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
        Schema::dropIfExists('animal_size_attributes');
    }
}
