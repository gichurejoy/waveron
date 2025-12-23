<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'hero',
        'sections',
        'icon',
        'image',
        'features',
        'technologies',
        'base_price',
        'complexity_multipliers',
        'timeline_multipliers',
        'feature_base_price',
        'default_feature_count',
        'feature_price_per_additional',
        'is_featured',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'hero' => 'array',
        'sections' => 'array',
        'features' => 'array',
        'technologies' => 'array',
        'base_price' => 'decimal:2',
        'complexity_multipliers' => 'array',
        'timeline_multipliers' => 'array',
        'feature_base_price' => 'decimal:2',
        'default_feature_count' => 'integer',
        'feature_price_per_additional' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->title);
            }
        });

        static::updating(function ($service) {
            if ($service->isDirty('title') && empty($service->slug)) {
                $service->slug = Str::slug($service->title);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function quotes(): HasMany
    {
        return $this->hasMany(Quote::class);
    }
}
