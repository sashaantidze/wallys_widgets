<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packages')->insert([
            ['name' => 'Small', 'size' => 250],
            ['name' => 'Medium', 'size' => 500],
            ['name' => 'Medium Plus', 'size' => 1000],
            ['name' => 'Big', 'size' => 2000],
            ['name' => 'Huge', 'size' => 5000],
            ['name' => 'Giant', 'size' => 10000]
        ]);
    }
}
