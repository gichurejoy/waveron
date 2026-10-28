<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'hired_at'          => 'datetime',
            'commission_rate'   => 'decimal:2',
            'base_salary'       => 'decimal:2',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if (str_ends_with($this->email, '@waverontechnologies.co.ke') || $this->email === 'admin@waverontechnologies.co.ke') {
            return true;
        }

        return !empty($this->job_application_id) && $this->employment_status === 'Active';
    }

    public function posts()
    {
        return $this->hasMany(BlogPost::class, 'author_id');
    }

    public function payouts()
    {
        return $this->hasMany(EmployeePayout::class);
    }

    public function jobApplication()
    {
        return $this->belongsTo(JobApplication::class, 'job_application_id');
    }

    public function getTotalPaidPayoutsAttribute(): float
    {
        return (float) $this->payouts()->where('status', 'Paid')->sum('amount');
    }

    public function getPendingPayoutsAttribute(): float
    {
        return (float) $this->payouts()->where('status', 'Pending')->sum('amount');
    }

    public function getTotalCommissionPaidAttribute(): float
    {
        return (float) $this->payouts()->where('status', 'Paid')->where('type', 'Commission')->sum('amount');
    }

    public function getPayoutsCountAttribute(): int
    {
        return $this->payouts()->count();
    }
}
