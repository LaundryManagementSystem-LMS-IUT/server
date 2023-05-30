<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCustomerTable extends Migration
{

    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->string('email', 100)->primary();
            $table->timestamps();
        });

        DB::statement('ALTER TABLE customers
        ADD COLUMN address ADDRESS_TYPE');

        Schema::table('customers', function (Blueprint $table) {
            $table->foreign('email')->references('email')->on('users')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
