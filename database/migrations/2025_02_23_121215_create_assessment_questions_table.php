<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assessment_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained('assessment_sections')->onDelete('cascade');
            $table->string('question');
            $table->string('instruction')->nullable();
            $table->string('type'); // select, checkbox, radio
            $table->json('options'); // Store options as JSON
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessment_questions');
    }
}; 