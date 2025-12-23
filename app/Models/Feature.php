<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'service_type',
        'group',
        'sort_order',
        'is_default',
        'is_active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_default' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function scopeForServiceType($query, string $serviceType)
    {
        return $query->where('service_type', $serviceType)->where('is_active', true);
    }

    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }

    public function scopeInGroup($query, ?string $group)
    {
        return $query->where('group', $group);
    }

    public function quotes(): BelongsToMany
    {
        return $this->belongsToMany(Quote::class, 'feature_quote');
    }
}
