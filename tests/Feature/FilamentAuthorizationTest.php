<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Filament\Panel;
use Tests\TestCase;

class FilamentAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_waveron_email_domain_user_can_access_filament_panel(): void
    {
        $user = User::create([
            'email' => 'developer@waverontechnologies.co.ke',
            'name' => 'Developer',
            'password' => bcrypt('password'),
        ]);

        $panel = new Panel();
        $this->assertTrue($user->canAccessPanel($panel));
    }

    public function test_admin_email_user_can_access_filament_panel(): void
    {
        $user = User::create([
            'email' => 'admin@waverontechnologies.co.ke',
            'name' => 'Admin',
            'password' => bcrypt('password'),
        ]);

        $panel = new Panel();
        $this->assertTrue($user->canAccessPanel($panel));
    }

    public function test_external_email_user_cannot_access_filament_panel(): void
    {
        $user = User::create([
            'email' => 'unauthorized@gmail.com',
            'name' => 'External',
            'password' => bcrypt('password'),
        ]);

        $panel = new Panel();
        $this->assertFalse($user->canAccessPanel($panel));
    }

    public function test_hired_active_employee_with_external_email_can_access_filament_panel(): void
    {
        $user = User::create([
            'email'              => 'jane.doe@gmail.com',
            'name'               => 'Jane Doe',
            'password'           => bcrypt('password'),
            'job_application_id' => 1,
            'employment_status'  => 'Active',
        ]);

        $panel = new Panel();
        $this->assertTrue($user->canAccessPanel($panel));
    }

    public function test_hired_inactive_employee_with_external_email_cannot_access_filament_panel(): void
    {
        $user = User::create([
            'email'              => 'jane.doe@gmail.com',
            'name'               => 'Jane Doe',
            'password'           => bcrypt('password'),
            'job_application_id' => 1,
            'employment_status'  => 'Terminated',
        ]);

        $panel = new Panel();
        $this->assertFalse($user->canAccessPanel($panel));
    }
}
