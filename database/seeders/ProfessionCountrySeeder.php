<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Country;
use App\Models\Profession;
use App\Models\PackageType;


class ProfessionCountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = Country::all();
        $professions = Profession::all();
        $packageTypes = PackageType::all();

        foreach($professions as $profession)
        {
            foreach($countries as $country)
            {
                foreach($packageTypes as $packageType)
                {
                  DB::table('profession_countries')->insert(
                    [
                      'profession_id' => $profession->id,
                      'country_id' => $country->id,
                      'package_type_id' => $packageType->id,
                      'base_cost' => $packageType->package_price,
                    ]);
                }
            }
        }
     
      /*DB::table('profession_countries')->insert([
        [
          'profession_id' => 1,
          'country_id' => 1,
          'package_type_id' => 1,
          'base_cost' =>65,
         ],
         [
           'profession_id' => 1,
           'country_id' => 1,
           'package_type_id' => 2,
           'base_cost' =>78,
         ],
        [
         'profession_id' => 1,
         'country_id' => 2,
         'package_type_id' => 1,
         'base_cost' =>65,
        ],
        [
          'profession_id' => 1,
          'country_id' => 2,
          'package_type_id' => 2,
          'base_cost' =>78,
        ],
        [
         'profession_id' => 1,
         'country_id' => 3,
         'package_type_id' => 1,
         'base_cost' =>65,
        ],
        [
          'profession_id' => 1,
          'country_id' => 3,
          'package_type_id' => 2,
          'base_cost' =>78,
         ],
        [
         'profession_id' => 1,
         'country_id' => 4,
         'package_type_id' => 1,
         'base_cost' =>65,
        ],
        [
          'profession_id' => 1,
          'country_id' => 4,
          'package_type_id' => 2,
          'base_cost' =>78,
         ],
         [
          'profession_id' => 1,
          'country_id' => 5,
          'package_type_id' => 1,
          'base_cost' =>65,
         ],
         [
           'profession_id' => 1,
           'country_id' => 5,
           'package_type_id' => 2,
           'base_cost' =>78,
          ],
  
        ]);*/
    }
}
