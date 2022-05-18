<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTvTimerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tvs_timer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tv_id');
            $table->foreign('tv_id')->references('id')->on('tvs');
            $table->time('display_start');
            $table->time('display_end');
            $table->dateTime('remove_after');
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
        Schema::dropIfExists('tvs_timer');
    }
}
