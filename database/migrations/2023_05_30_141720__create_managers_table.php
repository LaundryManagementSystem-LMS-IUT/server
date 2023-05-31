<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateManagersTable extends Migration
{

    public function up()
    {
        Schema::create('managers', function (Blueprint $table) {
            $table->string('email', 100)->primary();
            $table->string('laundry_id',100)->unique()->nullable();
            $table->string('laundry_name', 100)->nullable();
            $table->string('phone_number', 15)->unique()->nullable();
            $table->boolean('phone_number_verified')->default(false);
            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();
            $table->timestamps();
        });

        DB::statement('ALTER TABLE managers
        ADD COLUMN address ADDRESS_TYPE NULL');

        Schema::table('managers', function (Blueprint $table) {
            $table->foreign('email')->references('email')->on('users')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('managers');
    }
}
