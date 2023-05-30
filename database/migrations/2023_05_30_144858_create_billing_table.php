<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateBillingTable extends Migration
{

    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->string('order_id', 100)->primary();
            $table->string('phone_number', 15);
            $table->string('payment_method', 10);
            $table->double('amount');

            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
        });

        // Add explicit cast for the "address" column
        DB::statement('ALTER TABLE billings
        ADD COLUMN address ADDRESS_TYPE');
        DB::statement('ALTER TABLE billings
        ADD COLUMN full_name FULL_NAME');
    }


    public function down()
    {
        Schema::dropIfExists('billings');
    }
}
