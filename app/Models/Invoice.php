<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'invoice_number',
        'project_type',
        'client_name',
        'client_email',
        'client_phone',
        'project_brief',
        'amount',
        'issued_at',
        'due_at',
        'status',
        'credit_terms',
        'quote_submission_id',
    ];

    protected $casts = [
        'amount'    => 'integer',
        'issued_at' => 'datetime',
        'due_at'    => 'datetime',
    ];

    const STATUSES = ['Draft', 'Sent', 'Paid', 'Overdue', 'Void'];

    public function quoteSubmission(): BelongsTo
    {
        return $this->belongsTo(QuoteSubmission::class);
    }

    public function getFormattedAmountAttribute(): string
    {
        return 'KES ' . number_format($this->amount);
    }

    public static function generateNextNumber(): string
    {
        $year = now()->year;
        $prefix = "INV-{$year}-";

        $lastInvoice = static::withTrashed()
            ->where('invoice_number', 'like', "{$prefix}%")
            ->orderByRaw('LENGTH(invoice_number) DESC, invoice_number DESC')
            ->first();

        if ($lastInvoice && preg_match('/-(\d+)$/', $lastInvoice->invoice_number, $matches)) {
            $nextNum = ((int) $matches[1]) + 1;
        } else {
            $nextNum = 1;
        }

        return sprintf('%s%03d', $prefix, $nextNum);
    }
}
