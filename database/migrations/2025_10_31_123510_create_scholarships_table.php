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
        Schema::create('scholarships', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('funder');
            $table->text('description');
            $table->enum('education_level', ['Any', 'Senior High', 'College'])->default('Any');
            $table->date('application_start')->default(DB::raw('CURRENT_DATE'));             
            $table->date('submission_deadline');
            $table->integer('amount');
            $table->enum('status', ['Open', 'Close'])->default('Open');
            $table->binary('image');
            $table->string('residency_requirement')->default('Padre Garcia, Batangas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholarships');
    }
};
