<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateManagerTable extends Migration
{

    public function up()
    {
        Schema::create('manager', function (Blueprint $table) {
            $table->string('email', 100)->primary();
            $table->string('laundry_name', 100);
            $table->time('opening_time');
            $table->time('closing_time');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE manager
        ADD COLUMN address ADDRESS_TYPE');

        Schema::table('manager', function (Blueprint $table) {
            $table->foreign('email')->references('email')->on('users')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('manager');
    }
}
