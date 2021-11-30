<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string("title");
            $table->string("inn");
            $table->string("country_iso")->index();
            $table->foreign('country_iso')->references('iso')->on('countries');
            $table->string("city");
            $table->string("address");
            $table->string("post");
            $table->string("logo")->nullable()->default("avatar-default.png");
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
        Schema::dropIfExists('companies');
    }
}
