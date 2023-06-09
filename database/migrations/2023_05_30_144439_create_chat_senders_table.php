<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatSendersTable extends Migration
{

    public function up()
    {
        Schema::create('chat_senders', function (Blueprint $table) {
            $table->string('message_id', 100)->primary();
            $table->string('sender_email', 100);

            $table->foreign('message_id')->references('message_id')->on('chats')->onDelete('cascade');
            $table->foreign('sender_email')->references('email')->on('users');

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('chat_senders');
    }
}
