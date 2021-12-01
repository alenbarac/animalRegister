<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShelterStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shelter_staff', function (Blueprint $table) {
            $table->id();

            $table->foreignId('shelter_staff_type_id');
            $table->foreignId('shelter_id')->nullable();

            $table->string('name');
            $table->string('oib');
            $table->string('address');
            $table->string('address_place');
            $table->string('phone');
            $table->string('phone_cell');
            $table->string('email')->unique();
            $table->string('education')->nullable();
            $table->string('file_contract')->nullable();
            $table->string('file_legal')->nullable();
            $table->string('file_education')->nullable();

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
        Schema::dropIfExists('shelter_staff');
    }
}
