<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubCategory;
use Illuminate\Support\Str;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subcategories = [
            ['name' => 'Mobile Phones', 'slug' => Str::slug('Mobile Phones'), 'category_id' => 1], // Electronics
            ['name' => 'Laptops', 'slug' => Str::slug('Laptops'), 'category_id' => 1],              // Electronics
            ['name' => 'Refrigerators', 'slug' => Str::slug('Refrigerators'), 'category_id' => 2], // Home Appliances
            ['name' => 'Novels', 'slug' => Str::slug('Novels'), 'category_id' => 3],               // Books
            ['name' => 'Fiction', 'slug' => Str::slug('Fiction'), 'category_id' => 3],             // Books
            ['name' => 'Men\'s Clothing', 'slug' => Str::slug('Men\'s Clothing'), 'category_id' => 4], // Clothing
            ['name' => 'Women\'s Clothing', 'slug' => Str::slug('Women\'s Clothing'), 'category_id' => 4], // Clothing
            ['name' => 'Football', 'slug' => Str::slug('Football'), 'category_id' => 5],           // Sports
            ['name' => 'Tennis', 'slug' => Str::slug('Tennis'), 'category_id' => 5],               // Sports
        ];

        foreach ($subcategories as $subcategory) {
            SubCategory::create($subcategory);
        }
    }
}
