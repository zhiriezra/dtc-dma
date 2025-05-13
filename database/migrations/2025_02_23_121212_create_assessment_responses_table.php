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
        Schema::create('assessment_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            
            // Personal Information
            $table->string('respondent_name');
            $table->string('gender');
            $table->string('phone_number_1');
            $table->string('phone_number_2');
            $table->string('email');
            $table->string('state');

            // Business Information
            $table->string('business_name');
            $table->string('business_phone_number');
            $table->string('business_email');
            $table->string('business_state');
            $table->string('business_city');
            $table->string('business_sector');
            $table->string('business_type');
            $table->string('business_role');
            $table->integer('years_in_business');
            $table->string('staff_size');
            $table->string('digital_advisor')->nullable();
            $table->boolean('has_disability')->default(false);
            $table->boolean('consent_given')->default(false);
            $table->boolean('multiple_states')->default(false);
            $table->text('operating_states')->nullable();

            // Assessment Responses
            $table->json('assessment_answers');
            $table->json('section_scores');
            $table->integer('overall_score');
            $table->string('maturity_level');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_responses');
    }
};
