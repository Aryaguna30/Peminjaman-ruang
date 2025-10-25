<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Ruangan Umum', 'description' => 'Kategori ruangan umum yang dikelola oleh Sarpras', 'type' => 'umum', 'created_at' => now()],
            ['name' => 'Elektronika', 'description' => 'Jurusan Elektronika', 'type' => 'jurusan', 'created_at' => now()],
            ['name' => 'Mekatronika', 'description' => 'Jurusan Mekatronika', 'type' => 'jurusan', 'created_at' => now()],
            ['name' => 'Mesin/DGM', 'description' => 'Jurusan Mesin/DGM', 'type' => 'jurusan', 'created_at' => now()],
            ['name' => 'Otomotif/TKR', 'description' => 'Jurusan Otomotif/TKR', 'type' => 'jurusan', 'created_at' => now()],
            ['name' => 'Tekstil', 'description' => 'Jurusan Tekstil', 'type' => 'jurusan', 'created_at' => now()],
            ['name' => 'TJKT/TKJ', 'description' => 'Jurusan TJKT/TKJ', 'type' => 'jurusan', 'created_at' => now()],
            ['name' => 'PPLG/RPL', 'description' => 'Jurusan PPLG/RPL', 'type' => 'jurusan', 'created_at' => now()],
            ['name' => 'BP/PSPT', 'description' => 'Jurusan BP/PSPT', 'type' => 'jurusan', 'created_at' => now()],
        ]);
    }
}