<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_themes', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->unsignedBigInteger("forum_id")->index();
            $table->foreign('forum_id')->references('id')->on('forums');
            $table->unsignedBigInteger("user_id")->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum("type",\App\Models\ForumTheme::TYPES)->default(\App\Models\ForumTheme::TYPE_NORMAL);
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
        Schema::dropIfExists('forum_themes');
    }
}
