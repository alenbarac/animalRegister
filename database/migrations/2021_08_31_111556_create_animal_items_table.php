<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('animal_group_id');
            $table->foreignId('animal_id')->constrained('animals');
            $table->foreignId('shelter_id')->constrained('shelters');
            $table->foreignId('founder_id');
            $table->string('founder_note')->nullable();
            $table->foreignId('animal_size_attributes_id')->nullable();
            $table->boolean('in_shelter');

            // $table->foreignId('animal_mark_type_id');
            //$table->string('animal_mark_note')->nullable();

            $table->string('status_receiving')->nullable();
            $table->string('status_receiving_desc')->nullable();

            $table->string('status_found')->nullable();
            $table->string('status_found_desc')->nullable();

            $table->string('status_reason')->nullable();
            $table->string('reason_desc')->nullable();

            $table->string('animal_found_note');

            $table->date('animal_date_found');

            $table->string('animal_gender');
            $table->string('animal_age');
            $table->string('solitary_or_group');
            $table->string('location');
            $table->string('location_animal_takeover');
            $table->string('seized_doc');
            $table->string('place_seized_select');
            $table->string('place_seized');
            $table->date('date_seized_animal');
            $table->string('location_retrieval_animal');

            $table->decimal('euthanasia_ammount')->nullable();

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
        Schema::dropIfExists('animal_items');
    }
}
