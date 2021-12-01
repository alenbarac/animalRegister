<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSheltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shelters', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->bigInteger('oib');
            $table->string('address');
            $table->string('address_place')->nullable();
            $table->string('place_zip');
            $table->bigInteger('telephone');
            $table->bigInteger('mobile');
            $table->bigInteger('fax');
            $table->string('email');
            $table->string('web_address');
            $table->string('bank_name');
            $table->string('iban');
            $table->date('register_date');
            $table->string('shelter_code');

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
        Schema::dropIfExists('shelters');
    }
}
