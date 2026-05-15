<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
            'name' => 'ketua',
            'email' => 'ketua@gmail.com',
            'password' => bcrypt('ketua_123'),
            'role' => 'Ketua',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'wakil',
            'email' => 'wakil@gmail.com',
            'password' => bcrypt('wakil_123'),
            'role' => 'Wakil',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'bendahara',
            'email' => 'bendahara@gmail.com',
            'password' => bcrypt('bendahara_123'),
            'role' => 'Bendahara',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'sekretaris',
            'email' => 'sekretaris@gmail.com',
            'password' => bcrypt('sekretaris_123'),
            'role' => 'Sekretaris',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'pokja 1',
            'email' => 'pokja1@gmail.com',
            'password' => bcrypt('pokja1_123'),
            'role' => 'Pokja_1',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'pokja 2',
            'email' => 'pokja2@gmail.com',
            'password' => bcrypt('pokja2_123'),
            'role' => 'Pokja_2',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'pokja 3',
            'email' => 'pokja3@gmail.com',
            'password' => bcrypt('pokja3_123'),
            'role' => 'Pokja_3',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'pokja 4',
            'email' => 'pokja4@gmail.com',
            'password' => bcrypt('pokja4_123'),
            'role' => 'Pokja_4',
            'created_at' => now(),
            'updated_at' => now(),
            ],
        ]);
    }
}
