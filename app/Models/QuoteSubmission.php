<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArray;

class QuoteSubmission extends Model
{
    protected $fillable = [
        'service_type',
        'complexity',
        'timeline',
        'selected_features',
        'selected_addons',
        'estimated_total',
        'user_email',
        'company',
        'status',
        'internal_notes',
    ];

    protected $casts = [
        'selected_features' => 'array',
        'selected_addons'   => 'array',
        'estimated_total'   => 'integer',
    ];

    const STATUSES = ['New', 'In Review', 'Converted', 'Archived'];

    public function getFormattedTotalAttribute(): string
    {
        return 'KES ' . number_format($this->estimated_total);
    }
}
