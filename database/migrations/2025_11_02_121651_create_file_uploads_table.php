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

        DB::table('file_uploads')->insert([
    'user_id' => 1,
    'scholarship_id' => 1,

    // All required bytea/binary fields (using small red square PNG)
    'school_registration_form'   => DB::raw("decode('89504e470d0a1a0a0000000d494844520000000a0000000a080200000002505802000000017352474200aece1ce90000000467414d410000b18f0bfc6105000000097048597300000ec300000ec301c76fa8640000001c49444154789c6360f8cf800f30e1951db1d200412c0113b10a73130000000049454e44ae426082', 'hex')"),
    'barangay_clearance'         => DB::raw("decode('89504e470d0a1a0a0000000d494844520000000a0000000a080200000002505802000000017352474200aece1ce90000000467414d410000b18f0bfc6105000000097048597300000ec300000ec301c76fa8640000001c49444154789c6360f8cf800f30e1951db1d200412c0113b10a73130000000049454e44ae426082', 'hex')"),
    'certificate_of_indigency'   => DB::raw("decode('89504e470d0a1a0a0000000d494844520000000a0000000a080200000002505802000000017352474200aece1ce90000000467414d410000b18f0bfc6105000000097048597300000ec300000ec301c76fa8640000001c49444154789c6360f8cf800f30e1951db1d200412c0113b10a73130000000049454e44ae426082', 'hex')"),
    'school_id_front'            => DB::raw("decode('89504e470d0a1a0a0000000d494844520000000a0000000a080200000002505802000000017352474200aece1ce90000000467414d410000b18f0bfc6105000000097048597300000ec300000ec301c76fa8640000001c49444154789c6360f8cf800f30e1951db1d200412c0113b10a73130000000049454e44ae426082', 'hex')"),
    'school_id_back'             => DB::raw("decode('89504e470d0a1a0a0000000d494844520000000a0000000a080200000002505802000000017352474200aece1ce90000000467414d410000b18f0bfc6105000000097048597300000ec300000ec301c76fa8640000001c49444154789c6360f8cf800f30e1951db1d200412c0113b10a73130000000049454e44ae426082', 'hex')"),
    'cedula'                     => DB::raw("decode('89504e470d0a1a0a0000000d494844520000000a0000000a080200000002505802000000017352474200aece1ce90000000467414d410000b18f0bfc6105000000097048597300000ec300000ec301c76fa8640000001c49444154789c6360f8cf800f30e1951db1d200412c0113b10a73130000000049454e44ae426082', 'hex')"),
    'breakdown_of_expenses'      => DB::raw("decode('89504e470d0a1a0a0000000d494844520000000a0000000a080200000002505802000000017352474200aece1ce90000000467414d410000b18f0bfc6105000000097048597300000ec300000ec301c76fa8640000001c49444154789c6360f8cf800f30e1951db1d200412c0113b10a73130000000049454e44ae426082', 'hex')"),

    // mime types
    'school_registration_form_mime' => 'image/png',
    'barangay_clearance_mime'       => 'image/png',
    'certificate_of_indigency_mime' => 'image/png',
    'school_id_front_mime'          => 'image/png',
    'school_id_back_mime'           => 'image/png',
    'cedula_mime'                   => 'image/png',
    'breakdown_of_expenses_mime'    => 'image/png',

    // remarks (defaulted in schema, but explicitly adding)
    'remarks_school_registration_form' => 'No Remarks',
    'remarks_barangay_clearance'       => 'No Remarks',
    'remarks_certificate_of_indigency' => 'No Remarks',
    'remarks_school_id_front'          => 'No Remarks',
    'remarks_school_id_back'           => 'No Remarks',
    'remarks_cedula'                   => 'No Remarks',
    'remarks_breakdown_of_expenses'    => 'No Remarks',

    // progress
    'progress' => 'Under Review',

    // QR code optional, leaving NULL
    'qr_code' => null,
    'qr_code_mime' => null,

    'created_at' => now(),
    'updated_at' => now()
]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints(); // Temporarily disable foreign keys
    Schema::dropIfExists('file_uploads');  // Drop the table
    Schema::enableForeignKeyConstraints();
    }
};
