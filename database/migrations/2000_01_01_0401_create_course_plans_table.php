<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("course_id");
            $table->foreign('course_id')->references('id')->on('courses');
            $table->enum("type",\App\Models\CoursePlan::TYPES);
            $table->string("title");
            $table->integer("duration");
            $table->date("date_start");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_plans');
    }
}
