<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Enrollment', function (Blueprint $table) {
            $table->increments('EnrollmentID');
            $table->integer('CourseID')->unsigned();
            //$table->foreign('CourseID')->references('CourseID')->on('Course');
            $table->integer('TraineeID')->unsigned();
            //$table->foreign('TraineeID')->references('TraineeID')->on('Trainee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Enrollment');
    }
}
