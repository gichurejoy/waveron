<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FastInquiry extends Model
{
    use SoftDeletes;
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
