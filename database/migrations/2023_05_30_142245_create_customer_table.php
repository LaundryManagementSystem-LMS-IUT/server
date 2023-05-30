<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCustomerTable extends Migration
{

    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->string('email', 100)->primary();
            $table->timestamps();
        });

        DB::statement('ALTER TABLE customer
        ADD COLUMN address ADDRESS_TYPE');

        Schema::table('customer', function (Blueprint $table) {
            $table->foreign('email')->references('email')->on('users')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('customer');
    }
}
