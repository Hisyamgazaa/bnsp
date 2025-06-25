<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Medical Equipment',
                'description' => 'Professional medical devices and equipment for healthcare facilities',
                'is_active' => true,
            ],
            [
                'name' => 'Medication',
                'description' => 'Pharmaceutical products and medications',
                'is_active' => true,
            ],
            [
                'name' => 'First Aid',
                'description' => 'Emergency care supplies and first aid kits',
                'is_active' => true,
            ],
            [
                'name' => 'Rehabilitation',
                'description' => 'Physical therapy and rehabilitation equipment',
                'is_active' => true,
            ],
            [
                'name' => 'Diagnostic',
                'description' => 'Diagnostic tools and testing equipment',
                'is_active' => true,
            ],
            [
                'name' => 'Personal Care',
                'description' => 'Personal health and hygiene products',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}
