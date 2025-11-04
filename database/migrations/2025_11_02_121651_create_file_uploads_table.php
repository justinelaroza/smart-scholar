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
        Schema::create('file_uploads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('scholarship_id')->constrained('scholarships')->onDelete('cascade');

            $table->string('school_registration_form');
            $table->string('barangay_clearance');
            $table->string('certificate_of_indigency');
            $table->string('school_id_front');
            $table->string('school_id_back');
            $table->string('cedula');
            $table->string('breakdown_of_expenses');

            $table->text('remarks_school_registration_form')->default('No Remarks');
            $table->text('remarks_barangay_clearance')->default('No Remarks');
            $table->text('remarks_certificate_of_indigency')->default('No Remarks');
            $table->text('remarks_school_id_front')->default('No Remarks');
            $table->text('remarks_school_id_back')->default('No Remarks');
            $table->text('remarks_cedula')->default('No Remarks');
            $table->text('remarks_breakdown_of_expenses')->default('No Remarks');

            $table->enum('progress', ['Under Review', 'Approved', 'Rejected', 'Requires Revision'])->default('Under Review');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_uploads');
    }
};
