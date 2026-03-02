<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Task;
use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin user
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Regular user
        $user = User::factory()->create([
            'name' => 'John User',
            'email' => 'user@test.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Create some tasks
        Task::create([
            'title' => 'Initial Marketing Project',
            'description' => 'A large-scale project to launch new campaign strategy for the 2026 quarter.',
            'priority' => TaskPriority::HIGH,
            'status' => TaskStatus::IN_PROGRESS,
            'due_date' => now()->addDays(30),
            'assigned_to' => $user->id,
            'ai_summary' => 'AI: Urgent marketing strategy needs high-level oversight.',
            'ai_priority' => 'high'
        ]);

        Task::create([
            'title' => 'Bug fixing session 1',
            'description' => 'Fix minor layout issues reported by the beta testers.',
            'priority' => TaskPriority::LOW,
            'status' => TaskStatus::PENDING,
            'due_date' => now()->addDays(7),
            'assigned_to' => $user->id,
        ]);
    }
}
