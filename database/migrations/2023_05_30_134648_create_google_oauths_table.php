<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoogleOauthsTable extends Migration
{
    public function up()
    {
        Schema::create('google_oauths', function (Blueprint $table) {
            $table->string('email', 100)->primary();
            $table->string('google_id', 200)->unique();
            $table->timestamps();
        });

        Schema::table('google_oauths', function (Blueprint $table) {
            $table->foreign('email')->references('email')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('google_oauths');
    }
}
