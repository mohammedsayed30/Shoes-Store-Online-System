<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            ['name' => 'sports', 'description' => 'Shoes for sports and fitness'],
            ['name' => 'casual', 'description' => 'shoes with casual style'],
            ['name' => 'formal', 'description' => 'shoes with formal style'],
            ['name' => 'widding', 'description' => 'shoes for widdings'],
            ['name' => 'home', 'description' => 'comfortable shoes for home'],
        ];
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
