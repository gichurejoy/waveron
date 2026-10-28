<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AuditLog extends Model
{
    protected $guarded = [];

    public static function logAction(string $action, string $description, ?string $entityType = null, ?string $entityId = null): self
    {
        $user = Auth::user();

        return self::create([
            'user_id'     => $user?->id,
            'user_email'  => $user?->email ?? 'System / Anonymous',
            'action'      => $action,
            'description' => $description,
            'entity_type' => $entityType,
            'entity_id'   => $entityId ? (string) $entityId : null,
            'ip_address'  => request()->ip() ?? '127.0.0.1',
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
