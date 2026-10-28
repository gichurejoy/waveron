<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientReferral extends Model
{
    protected $fillable = [
        'referral_code',
        'referrer_name',
        'referrer_contact',
        'client_name',
        'client_contact_person',
        'client_email',
        'client_phone',
        'services_needed',
        'notes',
        'commission_amount',
        'payout_status',
        'status',
        'promoted_to_lead',
        'promoted_at',
        'promoted_lead_id',
    ];

    protected $casts = [
        'commission_amount' => 'integer',
        'promoted_to_lead'  => 'boolean',
        'promoted_at'       => 'datetime',
    ];

    const PAYOUT_STATUSES = ['Pending', 'In Progress', 'Paid', 'Declined'];
    const STATUSES = ['Pending Review', 'Contacted', 'Active Lead', 'Converted / Won', 'Paid Out Commission', 'Declined'];

    public static function generateCode(): string
    {
        do {
            $code = 'WVRN-' . strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6));
        } while (static::where('referral_code', $code)->exists());

        return $code;
    }

    public function promotedLead(): BelongsTo
    {
        return $this->belongsTo(FastInquiry::class, 'promoted_lead_id');
    }
}
