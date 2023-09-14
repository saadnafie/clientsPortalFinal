<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicationProcessStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('application_process_statuses')->insert([
            ['application_process_status' => "Draft"],
            ['application_process_status' => "In Progress"],
            ['application_process_status' => "Pending"],
            ['application_process_status' => "Completed"],
          ]);
    }
}
