<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
 
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->string('notification_id', 100)->primary();
            $table->string('email', 100);
            $table->text('message');
            $table->boolean('read')->default(false);
            $table->timestamps();
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->foreign('email')->references('email')->on('users');
        });
    }


    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
