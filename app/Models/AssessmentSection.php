<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentSection extends Model
{
    protected $fillable = [
        'name',
        'description',
        'weight',
        'scaling_factor',
        'order'
    ];

    protected $casts = [
        'weight' => 'decimal:2',
        'scaling_factor' => 'decimal:2'
    ];

    public function questions()
    {
        return $this->hasMany(AssessmentQuestion::class, 'section_id')->ordered();
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
} 