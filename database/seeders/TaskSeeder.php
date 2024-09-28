<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first(); // Assumes a user exists in the system
        $categories = Category::pluck('id')->toArray();

        $tasks = [
            [
                'title' => 'Complete Project Report',
                'description' => 'Write and submit the final report for the project',
                'due_date' => Carbon::now()->addDays(5),
                'priority' => 'high',
                'status' => 'pending',
                'user_id' => $user->id,
                'category_id' => $categories[array_rand($categories)],
                'reminder_time' => Carbon::now()->addDays(3),
            ],
            [
                'title' => 'Team Meeting',
                'description' => 'Discuss project milestones with the team',
                'due_date' => Carbon::now()->addDays(2),
                'priority' => 'medium',
                'status' => 'in_progress',
                'user_id' => $user->id,
                'category_id' => $categories[array_rand($categories)],
                'reminder_time' => Carbon::now()->addDay(),
            ],
            [
                'title' => 'Code Review',
                'description' => 'Review the new feature code submitted by the team',
                'due_date' => Carbon::now()->addDays(7),
                'priority' => 'medium',
                'status' => 'pending',
                'user_id' => $user->id,
                'category_id' => $categories[array_rand($categories)],
                'reminder_time' => null,
            ],
            [
                'title' => 'Client Presentation',
                'description' => 'Prepare slides and data for the client presentation',
                'due_date' => Carbon::now()->addDays(4),
                'priority' => 'high',
                'status' => 'in_progress',
                'user_id' => $user->id,
                'category_id' => $categories[array_rand($categories)],
                'reminder_time' => Carbon::now()->addDays(2),
            ],
            [
                'title' => 'Update Documentation',
                'description' => 'Update the technical documentation for the latest release',
                'due_date' => Carbon::now()->addDays(10),
                'priority' => 'low',
                'status' => 'pending',
                'user_id' => $user->id,
                'category_id' => $categories[array_rand($categories)],
                'reminder_time' => null,
            ],
            [
                'title' => 'Fix Production Bug',
                'description' => 'Resolve the bug reported in the production environment',
                'due_date' => Carbon::now()->addDays(1),
                'priority' => 'high',
                'status' => 'completed',
                'user_id' => $user->id,
                'category_id' => $categories[array_rand($categories)],
                'reminder_time' => null,
            ],
            [
                'title' => 'Design Feedback',
                'description' => 'Provide feedback on the new design mockups',
                'due_date' => Carbon::now()->addDays(6),
                'priority' => 'medium',
                'status' => 'pending',
                'user_id' => $user->id,
                'category_id' => $categories[array_rand($categories)],
                'reminder_time' => Carbon::now()->addDays(3),
            ],
            [
                'title' => 'Database Optimization',
                'description' => 'Analyze and optimize database queries',
                'due_date' => Carbon::now()->addDays(8),
                'priority' => 'medium',
                'status' => 'pending',
                'user_id' => $user->id,
                'category_id' => $categories[array_rand($categories)],
                'reminder_time' => Carbon::now()->addDays(4),
            ],
            [
                'title' => 'Schedule System Maintenance',
                'description' => 'Coordinate with the team for server maintenance',
                'due_date' => Carbon::now()->addDays(12),
                'priority' => 'low',
                'status' => 'pending',
                'user_id' => $user->id,
                'category_id' => $categories[array_rand($categories)],
                'reminder_time' => null,
            ],
            [
                'title' => 'Submit Invoice',
                'description' => 'Submit the invoice to the client for the completed work',
                'due_date' => Carbon::now()->addDays(3),
                'priority' => 'medium',
                'status' => 'pending',
                'user_id' => $user->id,
                'category_id' => $categories[array_rand($categories)],
                'reminder_time' => Carbon::now()->addDays(1),
            ],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
