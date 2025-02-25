<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->insert([
            'name' => 'John',
            'last_name' => 'Doe',
            'position' => 'sw admin', 
            'date_of_birth' => '1990-01-01',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('password123'), 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
