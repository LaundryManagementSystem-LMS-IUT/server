<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewLaundryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_laundry', function (Blueprint $table) {
            $table->string('manager_email', 100);
            $table->string('customer_email', 100);
            $table->decimal('review_stars', 3, 1);
            $table->text('review');

            $table->primary(['manager_email', 'customer_email']);
            $table->foreign('manager_email')->references('email')->on('manager')->onDelete('cascade');
            $table->foreign('customer_email')->references('email')->on('customer')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_laundry');
    }
}
