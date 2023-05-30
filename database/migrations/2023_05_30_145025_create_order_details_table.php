<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{

    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->string('order_id', 100);
            $table->string('cloth_type', 50);
            $table->string('operation', 50);
            $table->string('manager_email', 100);
            $table->boolean('completed');
            $table->integer('quantity');

            $table->primary(['order_id', 'cloth_type', 'operation']);
            $table->foreign('manager_email')->references('email')->on('manager')->onDelete('cascade');
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
            $table->foreign(['manager_email', 'cloth_type', 'operation'])->references(['manager_email', 'cloth_type', 'operation'])->on('service')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
