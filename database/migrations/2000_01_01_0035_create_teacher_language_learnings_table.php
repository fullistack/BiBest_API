<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherLanguageLearningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_language_learnings', function (Blueprint $table) {
            $table->id();
            $table->string("language_code")->index();
            $table->foreign('language_code')->references('code')->on('learning_languages');
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
        Schema::dropIfExists('teacher_language_learnings');
    }
}
