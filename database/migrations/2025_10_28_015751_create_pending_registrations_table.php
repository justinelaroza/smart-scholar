<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pending_registrations', function (Blueprint $table) {
            $table->id();

            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->date('birthday')->nullable();
            $table->string('address')->nullable();

            $table->string('email')->nullable(); // may be nullable if not required
            $table->string('phone')->unique();    // phone will be used to send OTP

            $table->string('password');          // store HASHED password here
            $table->string('otp_code', 6);        // "123456"

            // We'll need to know later which pending record we're verifying
            // You will pass this id back to OTP verify step.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_registrations');
    }
};
