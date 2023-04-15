<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Faker\Factory as Faker;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for($i=1; $i<=2000; $i++){
            DB::table('pegawai')->insert([
                'nama' => $faker->name,
                'umur' => $faker->numberBetween(25,40),
                'jabatan' => $faker->jobTitle
            ]);
        }
    }
}
