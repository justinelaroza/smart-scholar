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

        DB::table('scholarships')->insert([
        'title' => 'Test Scholarship',
        'funder' => 'Test Foundation',
        'description' => 'This is a test scholarship used for deployment verification.',
        'education_level' => 'Any',
        'application_start' => now(),
        'submission_deadline' => now()->addDays(30),
        'amount' => 10000,
        'status' => 'Open',

        // Example bytea/image data (hex → binary)
        'image' => DB::raw("decode('89504E470D0A1A0A', 'hex')"),

        'residency_requirement' => 'Padre Garcia, Batangas',
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
    Schema::dropIfExists('scholarships');  // Drop the table
    Schema::enableForeignKeyConstraints();
    }
};
