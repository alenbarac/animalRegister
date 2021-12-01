<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShelterEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shelter_equipment', function (Blueprint $table) {
            $table->id();
            $table->string('equipment_title');
            $table->longText('equipment_desc');
            $table->foreignId('shelter_id')->constrained('shelters');
            $table->foreignId('shelter_equipment_type_id')->nullable();
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
        Schema::dropIfExists('shelter_equipment');
    }
}
