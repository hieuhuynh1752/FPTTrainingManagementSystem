<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Course', function (Blueprint $table) {
            $table->increments('CourseID');
            $table->integer('CourseCategoryID')->unsigned();
            //$table->foreign('CourseCategoryID')->references('CourseCategoryID')->on('CourseCategory');
            $table->string('CourseName');
            $table->string('CourseDescription');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Course');
    }
}
