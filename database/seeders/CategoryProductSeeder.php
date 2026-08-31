<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Category::factory()->count(5)->create();


       $categories = Category::all();

        foreach ($categories as $category) {
            Product::factory()->count(5)->create([
                'category_id' => $category->id,
            ]);
        }
    }
}
