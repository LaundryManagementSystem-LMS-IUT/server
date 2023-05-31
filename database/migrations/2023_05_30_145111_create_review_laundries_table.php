<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewLaundriesTable extends Migration
{

    public function up()
    {
        Schema::create('review_laundries', function (Blueprint $table) {
            $table->string('manager_email', 100);
            $table->string('customer_email', 100);
            $table->decimal('review_stars', 3, 1);
            $table->text('review');

            $table->primary(['manager_email', 'customer_email']);
            $table->foreign('manager_email')->references('email')->on('managers')->onDelete('cascade');
            $table->foreign('customer_email')->references('email')->on('customers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('review_laundries');
    }
}
