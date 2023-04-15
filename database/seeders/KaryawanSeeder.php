<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Faker\Factory as Faker;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for($i=1; $i<=2000; $i++){
            DB::table('karyawan')->insert([
                'nama' => $faker->name,
                'id_jk' => $faker->numberBetween(1,2)
            ]);
        }
    }
}
