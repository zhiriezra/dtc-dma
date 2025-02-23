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
            $table->string('respondent_name');
            $table->string('business_name');
            $table->string('gender');
            $table->string('phone_number');
            $table->string('email');
            $table->string('state');
            $table->string('nationality');
            $table->string('business_sector');
            $table->integer('employee_count');
            $table->string('role');
            $table->integer('years_in_business');
            $table->string('digital_advisor')->nullable();
            $table->boolean('has_disability');
            $table->boolean('consent_given');
            $table->boolean('multiple_states');
            $table->text('operating_states')->nullable();
            $table->string('staff_size');

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
