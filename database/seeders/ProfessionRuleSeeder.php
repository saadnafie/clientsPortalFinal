<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ProfessionCountry;
use App\Models\CredentialClassification;

class ProfessionRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $professionCountries = ProfessionCountry::where('package_type_id', 1)->get();
        $credentialClassifications = CredentialClassification::where('id','!=', 1)->get();

        foreach($professionCountries as $professionCountry)
        {
            foreach($credentialClassifications as $credentialClassification)
            {
                DB::table('profession_rules')->insert(
                    [
                       'profession_country_id' => $professionCountry->id,
                       'credential_id' => $credentialClassification->id,
                       'certificates_number' => ($credentialClassification->id == 5) ? 0 : 1,
                    ]);
            }
        }

      /*DB::table('profession_rules')->insert([
        [
           'profession_country_id' => 1,
           'credential_id' => 2,
           'certificates_number' => 1,
        ],
        [
           'profession_country_id' => 1,
           'credential_id' => 3,
           'certificates_number' => 1,
        ],
        [
           'profession_country_id' => 1,
           'credential_id' => 4,
           'certificates_number' => 1,
        ],
        [
            'profession_country_id' => 1,
            'credential_id' => 5,
            'certificates_number' => 0,
        ],
        [
            'profession_country_id' => 3,
            'credential_id' => 2,
            'certificates_number' => 1,
        ],
        [
            'profession_country_id' => 3,
            'credential_id' => 3,
            'certificates_number' => 1,
        ],
        [
            'profession_country_id' => 3,
            'credential_id' => 4,
            'certificates_number' => 1,
        ],
        [
            'profession_country_id' => 3,
            'credential_id' => 5,
            'certificates_number' => 0,
        ],
        [
            'profession_country_id' => 5,
            'credential_id' => 2,
            'certificates_number' => 1,
        ],
        [
            'profession_country_id' => 5,
            'credential_id' => 3,
            'certificates_number' => 1,
        ],
        [
            'profession_country_id' => 5,
            'credential_id' => 4,
            'certificates_number' => 1,
        ],
        [
            'profession_country_id' => 5,
            'credential_id' => 5,
            'certificates_number' => 0,
        ],
        [
            'profession_country_id' => 7,
            'credential_id' => 2,
            'certificates_number' => 1,
        ],
        [
            'profession_country_id' => 7,
            'credential_id' => 3,
            'certificates_number' => 1,
        ],
        [
            'profession_country_id' => 7,
            'credential_id' => 4,
            'certificates_number' => 1,
        ],
        [
            'profession_country_id' => 7,
            'credential_id' => 5,
            'certificates_number' => 0,
        ],
        [
            'profession_country_id' => 9,
            'credential_id' => 2,
            'certificates_number' => 1,
        ],
        [
            'profession_country_id' => 9,
            'credential_id' => 3,
            'certificates_number' => 1,
        ],
        [
            'profession_country_id' => 9,
            'credential_id' => 4,
            'certificates_number' => 1,
        ],
        [
            'profession_country_id' => 9,
            'credential_id' => 5,
            'certificates_number' => 0,
        ],



     ]);*/

    }
}
