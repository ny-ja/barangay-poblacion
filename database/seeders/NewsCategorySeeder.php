<?php

namespace Database\Seeders;

use App\Models\NewsCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NewsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NewsCategory::create([
            'name' => 'Announcement',
            'user_id' => 1,
        ]);

        NewsCategory::create([
            'name' => 'Event and Activity',
            'user_id' => 1,
        ]);

        NewsCategory::create([
            'name' => 'Community Project',
            'user_id' => 1,
        ]);

        NewsCategory::create([
            'name' => 'Public Service',
            'user_id' => 1,
        ]);

        NewsCategory::create([
            'name' => 'Safety and Security',
            'user_id' => 1,
        ]);

        NewsCategory::create([
            'name' => 'Health and Wellness',
            'user_id' => 1,
        ]);

        NewsCategory::create([
            'name' => 'Education and Training',
            'user_id' => 1,
        ]);

        NewsCategory::create([
            'name' => 'Environmental Initiative',
            'user_id' => 1,
        ]);

        NewsCategory::create([
            'name' => 'Legislation and Policy',
            'user_id' => 1,
        ]);

        NewsCategory::create([
            'name' => 'Award and Recognition',
            'user_id' => 1,
        ]);

        NewsCategory::create([
            'name' => 'Community Spotlight',
            'user_id' => 1,
        ]);
    }
}
