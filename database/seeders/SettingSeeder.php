<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('settings')->insert([
       'name' => "clients portal",
       'logo' => "logo.png",
       'footer_text' => "Copyright © clientsportal.com 2023",
       'default_language' => "en",
       'default_currency' => "usd",
      ]);
    }
}
