<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CredentialFormFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('credential_form_fields')->insert([
        [
         'credential_id' => 1,
         'form_field_id' => 1,
         'mandatory' => 1,
        ],
        [
         'credential_id' => 1,
         'form_field_id' => 2,
         'mandatory' => 1,
        ],
        [
         'credential_id' => 1,
         'form_field_id' => 3,
         'mandatory' => 1,
        ],
        [
         'credential_id' => 1,
         'form_field_id' => 4,
         'mandatory' => 1,
        ],
        [
         'credential_id' => 1,
         'form_field_id' => 5,
         'mandatory' => 1,
        ],
        [
         'credential_id' => 1,
         'form_field_id' => 6,
         'mandatory' => 1,
        ],
        [
         'credential_id' => 1,
         'form_field_id' => 7,
         'mandatory' => 1,
        ],
        [
         'credential_id' => 1,
         'form_field_id' => 8,
         'mandatory' => 1,
        ],
        [
         'credential_id' => 1,
         'form_field_id' => 9,
         'mandatory' => 1,
        ],
        [
         'credential_id' => 1,
         'form_field_id' => 10,
         'mandatory' => 1,
        ],
        [
         'credential_id' => 1,
         'form_field_id' => 11,
         'mandatory' => 1,
        ],
        [
         'credential_id' => 1,
         'form_field_id' => 12,
         'mandatory' => 1,
        ],
        [
         'credential_id' => 2,
         'form_field_id' => 13,
         'mandatory' => 1,
        ],
        [
         'credential_id' => 2,
         'form_field_id' => 14,
         'mandatory' => 1,
        ],
        [
         'credential_id' => 2,
         'form_field_id' => 15,
         'mandatory' => 1,
        ],
        [
         'credential_id' => 2,
         'form_field_id' => 16,
         'mandatory' => 1,
        ],
        [
         'credential_id' => 2,
         'form_field_id' => 17,
         'mandatory' => 1,
        ],
        [
         'credential_id' => 3,
         'form_field_id' => 13,
         'mandatory' => 1,
        ],
        [
         'credential_id' => 3,
         'form_field_id' => 14,
         'mandatory' => 1,
        ],
        [
         'credential_id' => 3,
         'form_field_id' => 15,
         'mandatory' => 1,
        ],
        [
         'credential_id' => 3,
         'form_field_id' => 16,
         'mandatory' => 1,
        ],
        [
         'credential_id' => 3,
         'form_field_id' => 18,
         'mandatory' => 1,
        ],
        [
         'credential_id' => 4,
         'form_field_id' => 13,
         'mandatory' => 1,
        ],
        [
         'credential_id' => 4,
         'form_field_id' => 14,
         'mandatory' => 1,
        ],
        [
         'credential_id' => 4,
         'form_field_id' => 19,
         'mandatory' => 1,
        ],
        [
         'credential_id' => 4,
         'form_field_id' => 20,
         'mandatory' => 1,
        ],
        [
         'credential_id' => 4,
         'form_field_id' => 21,
         'mandatory' => 1,
        ],
        [
         'credential_id' => 4,
         'form_field_id' => 22,
         'mandatory' => 1,
        ],
        [
          'credential_id' => 5,
          'form_field_id' => 13,
          'mandatory' => 1,
        ],
        [
          'credential_id' => 5,
          'form_field_id' => 14,
          'mandatory' => 1,
        ],
        [
          'credential_id' => 5,
          'form_field_id' => 23,
          'mandatory' => 1,
        ],
        [
          'credential_id' => 5,
          'form_field_id' => 24,
          'mandatory' => 1,
        ],
        [
          'credential_id' => 5,
          'form_field_id' => 25,
          'mandatory' => 1,
        ],
        [
          'credential_id' => 5,
          'form_field_id' => 26,
          'mandatory' => 1,
        ],
        [
          'credential_id' => 5,
          'form_field_id' => 27,
          'mandatory' => 1,
        ],
        [
          'credential_id' => 5,
          'form_field_id' => 28,
          'mandatory' => 1,
        ],
        [
          'credential_id' => 5,
          'form_field_id' => 29,
          'mandatory' => 1,
        ],

     ]);
    }
}
