<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('username', 100);
            $table->string('email', 100)->primary();
            $table->string('profile_picture', 100);
            $table->string('phone_number', 15)->unique();
            $table->boolean('email_verified');
            $table->boolean('phone_number_verified');
            $table->timestamps();
        });
    }

 
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
