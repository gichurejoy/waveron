<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
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
