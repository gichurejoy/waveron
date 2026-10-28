<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactSubmission extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'full_name',
        'email',
        'company',
        'subject',
        'message',
        'budget',
        'timeline',
        'services',
        'status',
    ];

    const STATUSES = ['Unread', 'Read', 'Replied'];
}
