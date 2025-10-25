<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        DB::table('users')->insert([
            [
                'name' => 'Admin Ruang Nekat',
                'email' => 'admin@ruangnekat.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'category_id' => null,
                'phone' => '081234567890',
                'is_active' => true,
                'created_at' => now(),
            ],
        ]);

        // Sarpras
        DB::table('users')->insert([
            [
                'name' => 'Sarpras SMKN 1 Katapang',
                'email' => 'sarpras@ruangnekat.com',
                'password' => Hash::make('password'),
                'role' => 'sarpras',
                'category_id' => 1,
                'phone' => '081234567891',
                'is_active' => true,
                'created_at' => now(),
            ],
        ]);

        // Toolman Jurusan
        DB::table('users')->insert([
            [
                'name' => 'Toolman Elektronika',
                'email' => 'toolman.elektronika@ruangnekat.com',
                'password' => Hash::make('password'),
                'role' => 'toolman',
                'category_id' => 2,
                'phone' => '081234567892',
                'is_active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Toolman Mekatronika',
                'email' => 'toolman.mekatronika@ruangnekat.com',
                'password' => Hash::make('password'),
                'role' => 'toolman',
                'category_id' => 3,
                'phone' => '081234567893',
                'is_active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Toolman Mesin',
                'email' => 'toolman.mesin@ruangnekat.com',
                'password' => Hash::make('password'),
                'role' => 'toolman',
                'category_id' => 4,
                'phone' => '081234567894',
                'is_active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Toolman Otomotif',
                'email' => 'toolman.otomotif@ruangnekat.com',
                'password' => Hash::make('password'),
                'role' => 'toolman',
                'category_id' => 5,
                'phone' => '081234567895',
                'is_active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Toolman Tekstil',
                'email' => 'toolman.tekstil@ruangnekat.com',
                'password' => Hash::make('password'),
                'role' => 'toolman',
                'category_id' => 6,
                'phone' => '081234567896',
                'is_active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Toolman TJKT',
                'email' => 'toolman.tjkt@ruangnekat.com',
                'password' => Hash::make('password'),
                'role' => 'toolman',
                'category_id' => 7,
                'phone' => '081234567897',
                'is_active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Toolman RPL',
                'email' => 'toolman.rpl@ruangnekat.com',
                'password' => Hash::make('password'),
                'role' => 'toolman',
                'category_id' => 8,
                'phone' => '081234567898',
                'is_active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Toolman BP',
                'email' => 'toolman.bp@ruangnekat.com',
                'password' => Hash::make('password'),
                'role' => 'toolman',
                'category_id' => 9,
                'phone' => '081234567899',
                'is_active' => true,
                'created_at' => now(),
            ],
        ]);
    }
}