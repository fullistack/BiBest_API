<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherTrainingLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_training_levels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("level_id")->index();
            $table->foreign('level_id')->references('id')->on('training_levels');
            $table->unsignedBigInteger("teacher_id")->index();
            $table->foreign('teacher_id')->references('id')->on('teachers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_training_levels');
    }
}
