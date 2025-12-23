<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote_number',
        'lead_id',
        'service_id',
        'service_type',
        'complexity',
        'timeline',
        'feature_count',
        'base_price',
        'complexity_multiplier',
        'timeline_multiplier',
        'feature_adjustment',
        'addons_total',
        'subtotal',
        'tax_rate',
        'tax_amount',
        'discount_amount',
        'discount_code',
        'total',
        'currency',
        'validity_days',
        'expires_at',
        'status',
        'contact_name',
        'contact_email',
        'contact_phone',
        'notes',
        'selected_addons',
        'viewed_at',
        'responded_at',
        'is_converted',
        'converted_to_order_id',
    ];

    protected $casts = [
        'base_price' => 'decimal:2',
        'complexity_multiplier' => 'decimal:2',
        'timeline_multiplier' => 'decimal:2',
        'feature_adjustment' => 'decimal:2',
        'addons_total' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'tax_rate' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'total' => 'decimal:2',
        'feature_count' => 'integer',
        'validity_days' => 'integer',
        'expires_at' => 'datetime',
        'viewed_at' => 'datetime',
        'responded_at' => 'datetime',
        'selected_addons' => 'array',
        'is_converted' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($quote) {
            if (empty($quote->quote_number)) {
                $quote->quote_number = 'QT-' . strtoupper(uniqid());
            }
            if (empty($quote->expires_at) && $quote->validity_days) {
                $quote->expires_at = now()->addDays($quote->validity_days);
            }
        });
    }

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(QuoteItem::class);
    }

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class, 'feature_quote');
    }

    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    public function markAsViewed(): void
    {
        if (!$this->viewed_at) {
            $this->update(['viewed_at' => now()]);
        }
    }
}
