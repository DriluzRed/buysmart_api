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
        \App\Models\User::create([
            'name' => 'Admin', 
            'email' => 'admin@buysmart.com', 
            'ci' => '12345678',
            'role' => 'admin',
            'phone' => '12345678',
            'birthdate' => '2000-01-01',
            'password' => Hash::make('123456'),
        ]);
        
        $this->call([
            CategorySeeder::class,
            SubcategorySeeder::class,
            BrandSeeder::class,
        ]);
    }
}
