<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatReceiverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_receiver', function (Blueprint $table) {
            $table->string('message_id', 100)->primary();
            $table->string('receiver_email', 100);
            $table->boolean('read_status')->default(false);

            $table->foreign('message_id')->references('message_id')->on('chat')->onDelete('cascade');
            $table->foreign('receiver_email')->references('email')->on('users');

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
        Schema::dropIfExists('chat_receiver');
    }
}
