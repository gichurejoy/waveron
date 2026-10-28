<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CareerRole extends Model
{
    protected $fillable = [
        'code',
        'title',
        'employment_type',
        'location',
        'compensation',
        'prerequisites',
        'status',
    ];

    protected $casts = [
        'prerequisites' => 'array',
    ];

    const STATUSES = ['Active', 'Archived'];
    const EMPLOYMENT_TYPES = ['Full-Time', 'Contract', 'Part-Time', 'Internship'];

    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }
}
