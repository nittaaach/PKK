<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role')->insert([
            [
                'id_drole' => 1,
                'id_daftar_anggota' => 1,
                'id_users' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_drole' => 2,
                'id_daftar_anggota' => 2,
                'id_users' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_drole' => 3,
                'id_daftar_anggota' => 3,
                'id_users' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_drole' => 4,
                'id_daftar_anggota' => 4,
                'id_users' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_drole' => 5,
                'id_daftar_anggota' => 5,
                'id_users' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_drole' => 6,
                'id_daftar_anggota' => 6,
                'id_users' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_drole' => 7,
                'id_daftar_anggota' => 7,
                'id_users' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_drole' => 8,
                'id_daftar_anggota' => 8,
                'id_users' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_drole' => 9,
                'id_daftar_anggota' => 9,
                'id_users' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
