<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupLessonStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_lesson_students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("group_lesson_id")->index();
            $table->foreign('group_lesson_id')->references('id')->on('group_lessons');
            $table->unsignedBigInteger("student_id");
            $table->foreign('student_id')->references('id')->on('students');
            $table->enum("status",\App\Models\GroupLessonStudent::STATUSES);
            $table->text("text")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_lesson_students');
    }
}
