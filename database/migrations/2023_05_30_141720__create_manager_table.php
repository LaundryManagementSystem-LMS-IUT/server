<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateManagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manager', function (Blueprint $table) {
            $table->string('email', 100)->primary();
            $table->string('laundry_name', 100);
            $table->jsonb('address');
            $table->time('opening_time');
            $table->time('closing_time');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE manager ADD CONSTRAINT address_type CHECK (address IS NULL OR jsonb_typeof(address) = \'object\')');

        Schema::table('manager', function (Blueprint $table) {
            $table->foreign('email')->references('email')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manager');
    }
}
