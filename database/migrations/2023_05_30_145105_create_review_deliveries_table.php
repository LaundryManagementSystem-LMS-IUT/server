<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewDeliveriesTable extends Migration
{

    public function up()
    {
        Schema::create('review_deliveries', function (Blueprint $table) {
            $table->string('delivery_email', 100);
            $table->string('customer_email', 100);
            $table->decimal('review_stars', 3, 1);
            $table->text('review');

            $table->primary(['delivery_email', 'customer_email']);
            $table->foreign('delivery_email')->references('email')->on('deliveries')->onDelete('cascade');
            $table->foreign('customer_email')->references('email')->on('customers')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('review_deliveries');
    }
}
