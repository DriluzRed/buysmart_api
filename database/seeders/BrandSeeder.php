<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['name' => 'Apple', 'slug' => Str::slug('Apple')],
            ['name' => 'Samsung', 'slug' => Str::slug('Samsung')],
            ['name' => 'LG', 'slug' => Str::slug('LG')],
            ['name' => 'Sony', 'slug' => Str::slug('Sony')],
            ['name' => 'Nike', 'slug' => Str::slug('Nike')],
            ['name' => 'Adidas', 'slug' => Str::slug('Adidas')],
            ['name' => 'Puma', 'slug' => Str::slug('Puma')],
            ['name' => 'Under Armour', 'slug' => Str::slug('Under Armour')],
            ['name' => 'Dell', 'slug' => Str::slug('Dell')],
            ['name' => 'HP', 'slug' => Str::slug('HP')],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
