<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryInformationTable extends Migration
{

    public function up()
    {
        Schema::create('delivery_informations', function (Blueprint $table) {
            $table->string('order_id', 100);
            $table->string('delivery_email', 100);

            $table->primary(['order_id', 'status']);
            $table->foreign('delivery_email')->references('email')->on('delivery')->onDelete('cascade');
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');

            $table->enum('status', ['COMPLETED', 'DELIVERING', 'DELIVERED', 'COLLECTING', 'CANCELLED']);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('delivery_informations');
    }
}
