<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_number',
        'first_name',
        'last_name',
        'email',
        'phone',
        'company',
        'job_title',
        'website',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
        'source',
        'status',
        'estimated_value',
        'notes',
        'contacted_at',
        'converted_at',
        'assigned_to',
    ];

    protected $casts = [
        'estimated_value' => 'decimal:2',
        'contacted_at' => 'date',
        'converted_at' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($lead) {
            if (empty($lead->lead_number)) {
                $lead->lead_number = 'LD-' . strtoupper(uniqid());
            }
        });
    }

    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function notes(): HasMany
    {
        return $this->hasMany(LeadNote::class);
    }

    public function communications(): HasMany
    {
        return $this->hasMany(LeadCommunication::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(LeadTask::class);
    }

    public function quotes(): HasMany
    {
        return $this->hasMany(Quote::class);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
