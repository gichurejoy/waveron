<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApplication extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'career_role_id',
        'name',
        'contact',
        'resume_path',
        'years_exp',
        'why_fit',
        'largest_deal',
        'proud_sale',
        'first_clients',
        'internal_notes',
        'attachments',
        'status',
    ];

    protected $casts = [
        'internal_notes' => 'array',
        'attachments'    => 'array',
        'years_exp'      => 'integer',
    ];

    const STATUSES = ['New', 'Reviewing', 'Interview', 'Hired', 'Rejected'];

    public function careerRole(): BelongsTo
    {
        return $this->belongsTo(CareerRole::class);
    }
}
