<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DaftarAnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('daftar_anggota')->insert([
            [
                'id_users' => 1,
                'name' => 'Ketua',
                'email' => 'ketua@gmail.com',
                'alamat' => 'Cipinang Melayu',
                'role_pkk' => 'Ketua',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_users' => 2,
                'name' => 'Wakil',
                'email' => 'wakil@gmail.com',
                'alamat' => 'Cipinang Melayu',
                'role_pkk' => 'Wakil',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_users' => 3,
                'name' => 'Bendahara',
                'email' => 'bendahara@gmail.com',
                'alamat' => 'Cipinang Melayu',
                'role_pkk' => 'Bendahara',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_users' => 4,
                'name' => 'Sekretaris',
                'email' => 'sekretaris@gmail.com',
                'alamat' => 'Cipinang Melayu',
                'role_pkk' => 'Sekretaris',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_users' => 5,
                'name' => 'Pokja 1',
                'email' => 'pokja1@gmail.com',
                'alamat' => 'Cipinang Melayu',
                'role_pkk' => 'Pokja 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_users' => 6,
                'name' => 'Pokja 2',
                'email' => 'pokja2@gmail.com',
                'alamat' => 'Cipinang Melayu',
                'role_pkk' => 'Pokja 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_users' => 7,
                'name' => 'Pokja 3',
                'email' => 'pokja3@gmail.com',
                'alamat' => 'Cipinang Melayu',
                'role_pkk' => 'Pokja 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_users' => 8,
                'name' => 'Pokja 4',
                'email' => 'pokja4@gmail.com',
                'alamat' => 'Cipinang Melayu',
                'role_pkk' => 'Pokja 4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
