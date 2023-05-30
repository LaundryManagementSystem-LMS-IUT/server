<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{

    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->string('order_id', 100)->primary();
            $table->string('customer_email', 100);
            $table->string('manager_email', 100);
            $table->enum('status', ['PENDING', 'COMPLETED', 'DELIVERING', 'DELIVERED', 'PROCESSING', 'COLLECTING', 'CANCELLED']);

            $table->foreign('customer_email')->references('email')->on('customers')->onDelete('cascade');
            $table->foreign('manager_email')->references('email')->on('managers')->onDelete('cascade');

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
