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
        Schema::create('general_infos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // I. Client’s Identifying Information
            $table->string('client_name');
            $table->enum('sex', ['Male', 'Female']);
            $table->integer('age');
            $table->date('birth_date');
            $table->enum('civil_status', ['Single', 'Married', 'Others']);
            $table->string('birth_place');
            $table->string('address');
            $table->string('contact_number');
            $table->string('relationship_to_beneficiary');
            $table->string('religion');
            $table->string('nationality');
            $table->enum('education_level', [
                'Elementary',
                'High School',
                'Senior High School',
                'College Undergraduate',
                'College Graduate'
            ]);
            $table->string('philhealth_no');
            $table->string('occupation');
            $table->enum('income_range', [
                'Less than ₱10,000',
                '₱10,001 - ₱20,000',
                '₱20,001 - ₱50,000',
                '₱50,001 - ₱100,000',
                'Above ₱100,000'
            ]);
            $table->enum('mode_of_admission', ['Walk-in', 'Referral', '4Ps Beneficiary']);
            $table->string('referring_party');
            $table->string('referring_contact');

            // II. Beneficiary Identifying Information
            $table->enum('beneficiary_category', [
                'NHTS-PR',
                'ISF',
                'Disadvantaged Individual',
                'Indigenous People',
                'Pantawid Beneficiary'
            ]);
            $table->string('beneficiary_id_no');
            $table->string('beneficiary_name');
            $table->enum('beneficiary_sex', ['Male', 'Female']);
            $table->date('beneficiary_birth_date');
            $table->string('beneficiary_address');
            $table->string('beneficiary_birth_place');
            $table->enum('beneficiary_civil_status', ['Single', 'Married', 'Others']);

            // III. Family Composition (you can store as JSON)
            $table->json('family_members');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_infos');
    }
};
