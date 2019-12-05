<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Topic', function (Blueprint $table) {
            $table->increments('TopicID');
            $table->integer('TrainerID')->unsigned();
            //$table->foreign('TrainerID')->references('TrainerID')->on('Trainer');
            $table->string('TopicName');
            $table->string('TopicDescription');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Topic');
    }
}
