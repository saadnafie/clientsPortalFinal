<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FieldTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('field_types')->insert([
          ['field_type' => "text"],
          ['field_type' => "textarea"],
          ['field_type' => "checkbox"],
          ['field_type' => "radio"],
          ['field_type' => "select"],
          ['field_type' => "email"],
          ['field_type' => "date"],
          ['field_type' => "file"],
          ['field_type' => "select-profession"],
          ['field_type' => "select-subprofession"],
          ['field_type' => "select-country"],
          ['field_type' => "select-nationality"],
        ]);
    }
}
