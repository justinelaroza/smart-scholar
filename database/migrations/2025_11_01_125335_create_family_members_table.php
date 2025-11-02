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
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name');
            $table->enum('sex', ['Male', 'Female'])->default('Male');
            $table->date('birthdate');
            $table->enum('civil_status', ['Single', 'Married', 'Others'])->default('Single');
            $table->string('relationship');
            $table->enum('education', ['Elementary','High School','Senior High School','College Undergraduate','College Graduate'])->default('Elementary');
            $table->string('occupation');
            $table->enum('income', ['less_10k','10k_20k','20k_50k','50k_100k','above_100k'])->default('less_10k');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_members');
    }
};
