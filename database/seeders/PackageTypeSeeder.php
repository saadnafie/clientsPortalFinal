<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class PackageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('package_types')->insert([
            [
             'package_type' => 'Basic-Mandatory',
             'package_price' => 65,
            ],
            [
             'package_type' => 'Recommended-Mandatory',
             'package_price' => 78,
            ],
        ]);
    }
}
