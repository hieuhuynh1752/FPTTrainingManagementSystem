<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CourseDetails', function (Blueprint $table) {
            $table->increments('CourseDetailsID');
            $table->integer('TopicID')->unsigned();
            //$table->foreign('TopicID')->references('TopicID')->on('Topic');
            $table->integer('CourseID')->unsigned();
            //$table->foreign('CourseID')->references('CourseID')->on('Course');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('CourseDetails');
    }
}
