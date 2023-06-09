<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasswordAuthsTable extends Migration
{
    public function up()
    {
        Schema::create('password_auths', function (Blueprint $table) {
            $table->string('email', 100)->primary();
            $table->string('password', 200);
            $table->timestamps();
        });

        Schema::table('password_auths', function (Blueprint $table) {
            $table->foreign('email')->references('email')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('password_auths');
    }
}
