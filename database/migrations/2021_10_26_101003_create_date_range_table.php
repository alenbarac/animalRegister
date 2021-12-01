<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDateRangeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('date_ranges', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('animal_item_id');
            
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('reason_date_end')->nullable();

            $table->date('hibern_start')->nullable();
            $table->date('hibern_end')->nullable();

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
        Schema::dropIfExists('date_range');
    }
}
