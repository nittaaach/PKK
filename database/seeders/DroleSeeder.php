<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DroleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('drole')->delete();
        DB::statement('ALTER TABLE drole AUTO_INCREMENT = 1');

        $now = Carbon::now();

        DB::table('drole')->insert([
            ['role' => 'ketua', 'created_at' => $now, 'updated_at' => $now],
            ['role' => 'wakil', 'created_at' => $now, 'updated_at' => $now],
            ['role' => 'bendahara', 'created_at' => $now, 'updated_at' => $now],
            ['role' => 'sekretaris', 'created_at' => $now, 'updated_at' => $now],
            ['role' => 'pokja_1', 'created_at' => $now, 'updated_at' => $now],
            ['role' => 'pokja_2', 'created_at' => $now, 'updated_at' => $now],
            ['role' => 'pokja_3', 'created_at' => $now, 'updated_at' => $now],
            ['role' => 'pokja_4', 'created_at' => $now, 'updated_at' => $now],
            ['role' => 'admin', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
