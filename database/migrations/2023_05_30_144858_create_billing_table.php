<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateBillingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing', function (Blueprint $table) {
            $table->string('order_id', 100)->primary();
            $table->string('phone_number', 15);
            $table->json('address');
            $table->json('full_name');
            $table->string('payment_method', 10);
            $table->double('amount');

            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');

            $table->timestamps();
        });

        DB::statement('ALTER TABLE billing ADD CONSTRAINT address_type CHECK (address IS NULL OR jsonb_typeof(address) = \'object\')');
        DB::statement('ALTER TABLE billing ADD CONSTRAINT full_name CHECK (full_name IS NULL OR jsonb_typeof(address) = \'object\')');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billing');
    }
}
