<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Trainer', function (Blueprint $table) {
            $table->increments('TrainerID');
            $table->integer('UserID')->unsigned();
            //$table->foreign('UserID')->references('UserID')->on('User');
            $table->string('TrainerName');
            $table->string('TrainerType');
            $table->string('TrainerEmail');
            $table->string('TrainerPhone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Trainer');
    }
}
