<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogCategory;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Categories
        $categories = [
            ['name' => 'Health', 'slug' => 'health', 'description' => 'Health and wellness related articles.'],
            ['name' => 'Gym', 'slug' => 'gym', 'description' => 'Fitness, workouts, and gym routines.'],
            ['name' => 'High-Converting', 'slug' => 'high-converting', 'description' => 'Conversion rate optimization and copywriting tips.'],
            ['name' => 'Marketing', 'slug' => 'marketing', 'description' => 'Digital marketing strategies and updates.'],
            ['name' => 'Design', 'slug' => 'design', 'description' => 'Graphic design and branding guidelines.'],
        ];

        foreach ($categories as $cat) {
            BlogCategory::updateOrCreate(['slug' => $cat['slug']], $cat);
        }

        // 2. Update/create Admin
        User::updateOrCreate(
            ['email' => 'admin@waverontechnologies.co.ke'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'Administrator',
                'avatar' => null
            ]
        );

        // 3. Update/create Joy
        User::updateOrCreate(
            ['email' => 'info@waverontechnologies.co.ke'],
            [
                'name' => 'Joy Gichure',
                'role' => 'Marketing Lead',
                'avatar' => null
            ]
        );
    }
}
