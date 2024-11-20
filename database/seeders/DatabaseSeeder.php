<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            MainSeeder::class,
            CategorySeeder::class,
            SubcategorySeeder::class,
            BrandSeeder::class,
            ReportSeeder::class,
        ]);
    }
}
