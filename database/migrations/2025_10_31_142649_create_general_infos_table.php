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
            $table->foreignId('scholarship_id')->constrained('scholarships')->onDelete('cascade');
            $table->string('client_name');
            $table->enum('sex',['Male','Female'])->default('Male');
            $table->integer('age');
            $table->date('birth_date');
            $table->enum('civil_status',['Single','Married','Others'])->default('Single');
            $table->string('birth_place');
            $table->string('address');
            $table->string('contact_number');
            $table->string('relationship_to_beneficiary');
            $table->string('religion');
            $table->string('nationality');
            $table->enum('education_level',['Elementary','High School','Senior High School','College Undergraduate','College Graduate'])->default('Elementary');
            $table->string('philhealth_no');
            $table->string('occupation');
            $table->enum('income_range',['less_10k','10k_20k','20k_50k','50k_100k','above_100k'])->default('less_10k');
            $table->enum('mode_of_admission',['Walk-in','Referral','4Ps Beneficiary'])->default('Walk-in');
            $table->string('referring_party');
            $table->string('referring_contact');
            $table->enum('beneficiary_category',['NHTS-PR','ISF','Disadvantaged Individual','Indigenous People','Pantawid Beneficiary'])->default('NHTS-PR');
            $table->string('beneficiary_id_no');
            $table->string('beneficiary_name');
            $table->enum('beneficiary_sex',['Male','Female'])->default('Male');
            $table->date('beneficiary_birth_date');
            $table->string('beneficiary_address');
            $table->string('beneficiary_birth_place');
            $table->enum('beneficiary_civil_status',['Single','Married','Others'])->default('Single');

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
