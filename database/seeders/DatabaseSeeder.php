<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\BlogSeeder;
use Database\Seeders\LeadsSeeder;
use Database\Seeders\CareersSeeder;
use Database\Seeders\InvoicesSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\User::firstOrCreate(
            ['email' => 'admin@waverontechnologies.co.ke'],
            [
                'name' => 'Admin',
                'password' => 'Yelloe5433',
            ]
        );

        $this->call([
            BlogSeeder::class,
            LeadsSeeder::class,
            CareersSeeder::class,
            InvoicesSeeder::class,
        ]);
    }
}
