<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string("full_name")->nullable();
            $table->string("avatar");
            $table->string("passport");
            $table->string("country_iso")->index();
            $table->foreign('country_iso')->references('iso')->on('countries');
            $table->string("city");
            $table->string("address");
            $table->string("video_welcome")->nullable();
            $table->text("about")->nullable();
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
        Schema::dropIfExists('teachers');
    }
}
