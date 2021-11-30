<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumThemeMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_theme_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("theme_id")->index();
            $table->foreign('theme_id')->references('id')->on('forum_themes');
            $table->unsignedBigInteger("user_id")->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger("message_id")->nullable()->index();
            $table->foreign('message_id')->references('id')->on('forum_theme_messages');
            $table->text("message");
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
        Schema::dropIfExists('forum_theme_messages');
    }
}
