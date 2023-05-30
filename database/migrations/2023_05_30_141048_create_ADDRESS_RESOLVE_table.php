<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressResolveTable extends Migration
{
    public function up()
    {
        Schema::create('address_resolve', function (Blueprint $table) {
            $table->double('latitude');
            $table->double('longitude');
            $table->string('formatted_address', 100);
            $table->primary(['latitude', 'longitude']);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('address_resolve');
    }
}
