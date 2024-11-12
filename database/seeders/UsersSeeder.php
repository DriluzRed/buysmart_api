<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@buysmart.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
            'ci' => '11111111',
            'phone' => '12345678',
            'birthdate ' => '1990-01-01',
        ]);

        \App\Models\Customer::create([
            'name' => 'Customer',
            'email' => 'customer@buysmart.com',
            'phone' => '12345678',
            'ci' => '11111111',
            'ruc' => '11111111-1',
            'birthdate' => '1990-01-01',
            'password' => Hash::make('123456'),
        ]);
    }
}
