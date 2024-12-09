<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersLevel extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Menambahkan 1 admin
         DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'), // Jangan lupa mengenkripsi password
            'level' => 'admin',
        ]);

        // Menambahkan 1 user
        DB::table('users')->insert([
            'name' => 'Normal User',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'level' => 'user',
        ]);
    }
}
