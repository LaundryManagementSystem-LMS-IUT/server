<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{

    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->string('email', 100)->primary();
            $table->string('mode_of_transportation', 100)->nullable();
            $table->string('phone_number', 15)->unique()->nullable();
            $table->boolean('phone_number_verified')->default(false);
            $table->timestamps();
        });

        Schema::table('deliveries', function (Blueprint $table) {
            $table->foreign('email')->references('email')->on('users')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
}
