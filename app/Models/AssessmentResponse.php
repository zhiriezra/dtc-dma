<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentResponse extends Model
{
    protected $guarded = [];

    protected $casts = [
        'assessment_answers' => 'array',
        'section_scores' => 'array',
        'has_disability' => 'boolean',
        'consent_given' => 'boolean',
        'multiple_states' => 'boolean'
    ];
}
