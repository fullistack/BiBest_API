<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("company_id")->index();
            $table->string("OGRN")->nullable();
            $table->string("organization_current_account")->nullable();
            $table->string("KPP")->nullable();
            $table->string("correspondent_bank_account")->nullable();
            $table->string("BIK_bank")->nullable();
            $table->string("OKPO")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_infos');
    }
}
