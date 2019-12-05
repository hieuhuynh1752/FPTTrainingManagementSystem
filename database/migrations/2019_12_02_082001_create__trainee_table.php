<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraineeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Trainee', function (Blueprint $table) {
            $table->increments('TraineeID');
            $table->integer('UserID')->unsigned();
            //$table->foreign('UserID')->references('UserID')->on('User');
            $table->string('TraineeName');
            $table->date('TraineeDoB');
            $table->string('TraineeEmail');
            $table->string('TraineeEducation');
            $table->string('TraineePhone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Trainee');
    }
}
