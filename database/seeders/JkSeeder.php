<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class JkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_kelamin')->insert([
            'nama' => 'Laki-Laki'
        ]);

        DB::table('jenis_kelamin')->insert([
            'nama' => 'Perempuan'
        ]);
    }
}
