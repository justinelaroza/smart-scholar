<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('account_code');
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['Male', 'Female'])->default('Male');
            $table->date('birthday');
            $table->string('full_address');
            $table->string('email')->unique();
            $table->string('phone_number', 15)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        DB::table('users')->insert([
    'id' => 1, // force ID so your FK works
    'account_code' => 'USR-0001',
    'password' => bcrypt('password123'),
    'first_name' => 'Test',
    'last_name' => 'User',
    'gender' => 'Male',
    'birthday' => '2000-01-01',
    'full_address' => 'Padre Garcia, Batangas',
    'email' => 'test@example.com',
    'phone_number' => '09123456789',
    'email_verified_at' => now(),
    'remember_token' => null,
    'created_at' => now(),
    'updated_at' => now(),
]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints(); // Temporarily disable foreign keys
    Schema::dropIfExists('users');  // Drop the table
    Schema::enableForeignKeyConstraints();
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
