<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatTable extends Migration
{
 
    public function up()
    {
        Schema::create('chat', function (Blueprint $table) {
            $table->string('message_id', 100)->primary();
            $table->text('message');
            $table->timestamp('time_of_delivery');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('chat');
    }
}
