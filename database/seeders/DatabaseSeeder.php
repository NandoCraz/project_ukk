<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ProvinceSeeder::class,
            CitiesSeeder::class,
            KategoriSeeder::class,
            BarangSeeder::class,
            WargaTetanggaSeeder::class,
        ]);
    }
}
