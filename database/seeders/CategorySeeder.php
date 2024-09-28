<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $categories = [
            ['name' => 'Work', 'user_id' => 1],
            ['name' => 'Personal', 'user_id' => 1],
            ['name' => 'Urgent', 'user_id' => 2],
            ['name' => 'Hobbies', 'user_id' => 2],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'user_id' => $user->id
            ]);
        }
    }
}
