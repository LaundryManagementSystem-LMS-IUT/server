<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{

    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->string('manager_email', 100);
            $table->string('cloth_type', 50);
            $table->string('operation', 50);
            $table->double('price');

            $table->primary(['manager_email', 'cloth_type', 'operation']);
            $table->foreign('manager_email')->references('email')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
}
