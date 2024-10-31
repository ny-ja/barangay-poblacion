<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DocumentType::create([
            'name' => 'Application Forms',
            'user_id' => 1,
        ]);

        DocumentType::create([
            'name' => 'Barangay Clearance Requirements',
            'user_id' => 1,
        ]);

        DocumentType::create([
            'name' => 'Barangay Clearance Requirements',
            'user_id' => 1,
        ]);

        DocumentType::create([
            'name' => 'Informational Materials',
            'user_id' => 1,
        ]);

        DocumentType::create([
            'name' => 'Approved Resolutions',
            'user_id' => 1,
        ]);
        
        DocumentType::create([
            'name' => 'Approved Ordinances',
            'user_id' => 1,
        ]);
        DocumentType::create([
            'name' => 'Educational Materials',
            'user_id' => 1,
        ]);

        DocumentType::create([
            'name' => 'Support and Funding',
            'user_id' => 1,
        ]);
    }
}
