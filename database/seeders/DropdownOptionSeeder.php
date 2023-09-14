<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DropdownOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      /*DB::table('dropdown_options')->insert([
        [
          'form_field_id' => 14,
          'option_value' =>json_encode([
            "single",
            "married",
           ])
        ],
        [
          'form_field_id' => 15,
          'option_value' =>json_encode([
            "male",
            "female",

           ])
        ],
      ]);*/
    }
}
