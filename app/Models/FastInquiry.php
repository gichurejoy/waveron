<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FastInquiry extends Model
{
    protected $fillable = [
        'name',
        'email',
        'company',
        'budget',
        'timeline',
        'services_requested',
        'project_details',
        'status',
        'internal_notes',
    ];

    protected $casts = [
        'internal_notes' => 'array',
    ];

    const STATUSES = ['New', 'Contacted', 'Qualified', 'Lost'];
}
