<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFounderDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('founder_data', function (Blueprint $table) {
            $table->id();

            $table->foreignId('shelter_id');
            $table->foreignId('shelter_type_id');

            $table->string('name');
            $table->string('lastname');
            $table->string('address');
            $table->string('country');
            $table->string('contact');
            $table->string('email');
            $table->string('service');
            $table->string('others')->nullable();

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
        Schema::dropIfExists('founder_data');
    }
}
