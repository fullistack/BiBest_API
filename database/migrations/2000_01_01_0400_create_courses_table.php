<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("company_id")->index();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unsignedBigInteger("teacher_id")->index();
            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->string("title");
            $table->text("description")->nullable();
            $table->date("date_start");
            $table->time("time_start");
            $table->string("image");
            $table->integer("price");
            $table->integer("students_max_count");
            $table->integer("lessons_duration");
            $table->integer("works_duration");
            $table->integer("tests_duration");
            $table->unsignedBigInteger("training_level_id")->index();
            $table->foreign('training_level_id')->references('id')->on('training_levels');
            $table->unsignedBigInteger("student_age_id")->index();
            $table->foreign('student_age_id')->references('id')->on('student_ages');
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
        Schema::dropIfExists('courses');
    }
}
