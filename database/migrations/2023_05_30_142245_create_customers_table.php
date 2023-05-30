<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCustomersTable extends Migration
{

    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->string('email', 100)->primary();
            $table->string('phone_number', 15)->unique()->nullable();
            $table->boolean('phone_number_verified')->default(false);
            $table->timestamps();
        });

        DB::statement('ALTER TABLE customers
        ADD COLUMN address ADDRESS_TYPE NULL');

        Schema::table('customers', function (Blueprint $table) {
            $table->foreign('email')->references('email')->on('users')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
