<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherLessonPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_lesson_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("teacher_id")->index();
            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->integer("lesson_1")->nullable();
            $table->integer("lesson_5")->nullable();
            $table->integer("lesson_10")->nullable();
            $table->integer("lesson_20")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_lesson_prices');
    }
}
