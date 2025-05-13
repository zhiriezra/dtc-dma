<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentQuestion extends Model
{
    protected $fillable = [
        'section_id',
        'question',
        'instruction',
        'type',
        'options',
        'order'
    ];

    protected $casts = [
        'options' => 'array'
    ];

    public function section()
    {
        return $this->belongsTo(AssessmentSection::class, 'section_id');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function scopeBySection($query, $sectionId)
    {
        return $query->where('section_id', $sectionId);
    }
} 