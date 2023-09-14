<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CredentialClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('credential_classifications')->insert([
        [
       'credential_type' => "Basic Information",
       'credential_cost' => 0,
       ],
       [
        'credential_type' => "Educational Credential",
        'credential_cost' => 22,
        ],
        [
         'credential_type' => "Transcript of Records Credential",
         'credential_cost' => 22,
       ],
       [
        'credential_type' => "Health License Credential",
        'credential_cost' => 22,
      ],
      [
       'credential_type' => "Employment Credential",
       'credential_cost' => 22,
     ]
     ]);
    }
}
