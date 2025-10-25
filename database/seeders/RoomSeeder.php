<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        // Ruangan Umum (Category ID 1)
        DB::table('rooms')->insert([
            ['category_id' => 1, 'name' => 'Ruang Kelas Umum', 'capacity' => 40, 'description' => 'Ruang kelas untuk kegiatan umum', 'created_at' => now()],
            ['category_id' => 1, 'name' => 'RSG 1', 'capacity' => 100, 'description' => 'Ruang Serbaguna 1', 'created_at' => now()],
            ['category_id' => 1, 'name' => 'RSG 2', 'capacity' => 100, 'description' => 'Ruang Serbaguna 2', 'created_at' => now()],
            ['category_id' => 1, 'name' => 'RSG 3', 'capacity' => 100, 'description' => 'Ruang Serbaguna 3', 'created_at' => now()],
            ['category_id' => 1, 'name' => 'Area Praktikum Umum', 'capacity' => 30, 'description' => 'Area praktikum untuk kegiatan umum', 'created_at' => now()],

            // Elektronika (Category ID 2)
            ['category_id' => 2, 'name' => 'Ruang Kelas Elektronika', 'capacity' => 35, 'description' => 'Ruang kelas Elektronika', 'created_at' => now()],
            ['category_id' => 2, 'name' => 'Lab Elektronika', 'capacity' => 25, 'description' => 'Laboratorium Elektronika', 'created_at' => now()],
            ['category_id' => 2, 'name' => 'Area Praktikum Elektronika', 'capacity' => 30, 'description' => 'Area praktikum Elektronika', 'created_at' => now()],

            // Mekatronika (Category ID 3)
            ['category_id' => 3, 'name' => 'Ruang Kelas Mekatronika', 'capacity' => 35, 'description' => 'Ruang kelas Mekatronika', 'created_at' => now()],
            ['category_id' => 3, 'name' => 'Lab Mekatronika', 'capacity' => 25, 'description' => 'Laboratorium Mekatronika', 'created_at' => now()],
            ['category_id' => 3, 'name' => 'Area Praktikum Mekatronika', 'capacity' => 30, 'description' => 'Area praktikum Mekatronika', 'created_at' => now()],

            // Mesin/DGM (Category ID 4)
            ['category_id' => 4, 'name' => 'Ruang Kelas Mesin', 'capacity' => 35, 'description' => 'Ruang kelas Mesin/DGM', 'created_at' => now()],
            ['category_id' => 4, 'name' => 'Lab Mesin', 'capacity' => 25, 'description' => 'Laboratorium Mesin', 'created_at' => now()],
            ['category_id' => 4, 'name' => 'Area Praktikum Mesin', 'capacity' => 30, 'description' => 'Area praktikum Mesin', 'created_at' => now()],

            // Otomotif/TKR (Category ID 5)
            ['category_id' => 5, 'name' => 'Ruang Kelas Otomotif', 'capacity' => 35, 'description' => 'Ruang kelas Otomotif/TKR', 'created_at' => now()],
            ['category_id' => 5, 'name' => 'Lab Otomotif', 'capacity' => 25, 'description' => 'Laboratorium Otomotif', 'created_at' => now()],
            ['category_id' => 5, 'name' => 'Area Praktikum Otomotif', 'capacity' => 30, 'description' => 'Area praktikum Otomotif', 'created_at' => now()],

            // Tekstil (Category ID 6)
            ['category_id' => 6, 'name' => 'Ruang Kelas Tekstil', 'capacity' => 35, 'description' => 'Ruang kelas Tekstil', 'created_at' => now()],
            ['category_id' => 6, 'name' => 'Lab Tekstil', 'capacity' => 25, 'description' => 'Laboratorium Tekstil', 'created_at' => now()],
            ['category_id' => 6, 'name' => 'Aula Tekstil', 'capacity' => 50, 'description' => 'Aula Tekstil', 'created_at' => now()],
            ['category_id' => 6, 'name' => 'Area Praktikum Tekstil', 'capacity' => 30, 'description' => 'Area praktikum Tekstil', 'created_at' => now()],

            // TJKT/TKJ (Category ID 7)
            ['category_id' => 7, 'name' => 'Ruang Kelas TJKT', 'capacity' => 35, 'description' => 'Ruang kelas TJKT/TKJ', 'created_at' => now()],
            ['category_id' => 7, 'name' => 'Lab TJKT', 'capacity' => 25, 'description' => 'Laboratorium TJKT/TKJ', 'created_at' => now()],

            // PPLG/RPL (Category ID 8)
            ['category_id' => 8, 'name' => 'Ruang Kelas RPL', 'capacity' => 35, 'description' => 'Ruang kelas PPLG/RPL', 'created_at' => now()],
            ['category_id' => 8, 'name' => 'Lab RPL', 'capacity' => 25, 'description' => 'Laboratorium PPLG/RPL', 'created_at' => now()],

            // BP/PSPT (Category ID 9)
            ['category_id' => 9, 'name' => 'Ruang Kelas BP', 'capacity' => 35, 'description' => 'Ruang kelas BP/PSPT', 'created_at' => now()],
            ['category_id' => 9, 'name' => 'Studio BP', 'capacity' => 20, 'description' => 'Studio BP/PSPT', 'created_at' => now()],
        ]);
    }
}