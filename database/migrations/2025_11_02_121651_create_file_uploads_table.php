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

            $table->binary('school_registration_form');
            $table->binary('barangay_clearance');
            $table->binary('certificate_of_indigency');
            $table->binary('school_id_front');
            $table->binary('school_id_back');
            $table->binary('cedula');
            $table->binary('breakdown_of_expenses');
            
            $table->string('school_registration_form_mime')->nullable();
            $table->string('barangay_clearance_mime')->nullable();
            $table->string('certificate_of_indigency_mime')->nullable();
            $table->string('school_id_front_mime')->nullable();
            $table->string('school_id_back_mime')->nullable();
            $table->string('cedula_mime')->nullable();
            $table->string('breakdown_of_expenses_mime')->nullable();

            $table->text('remarks_school_registration_form')->default('No Remarks');
            $table->text('remarks_barangay_clearance')->default('No Remarks');
            $table->text('remarks_certificate_of_indigency')->default('No Remarks');
            $table->text('remarks_school_id_front')->default('No Remarks');
            $table->text('remarks_school_id_back')->default('No Remarks');
            $table->text('remarks_cedula')->default('No Remarks');
            $table->text('remarks_breakdown_of_expenses')->default('No Remarks');

            $table->enum('progress', ['Under Review', 'Approved', 'Rejected', 'Requires Revision'])->default('Under Review');
            $table->binary('qr_code')->nullable();
            $table->string('qr_code_mime')->nullable();
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
