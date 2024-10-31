<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocumentCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DocumentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DocumentCategory::create([
            'name' => 'Services',
            'user_id' => 1,
        ]);

        DocumentCategory::create([
            'name' => 'Resources',
            'user_id' => 1,
        ]);
    }
}
