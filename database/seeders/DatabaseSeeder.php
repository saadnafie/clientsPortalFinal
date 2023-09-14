<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
          ApplicationProcessStatusSeeder::Class,
          ApplicationStatusSeeder::class,
          ConfigurationSeeder::class,
          CredentialClassificationSeeder::class,
          CountrySeeder::class,
          FieldTypeSeeder::class,
          FormFieldSeeder::class,
          DropdownOptionSeeder::class,
          CredentialFormFieldSeeder::class,
          CurrencySeeder::class,
          ProfessionSeeder::class,
          SettingSeeder::class,
          SubProfessionSeeder::class,
          PackageTypeSeeder::class,
          ProfessionCountrySeeder::class,
          ProfessionRuleSeeder::class,
          UserRoleSeeder::class,
          UserSeeder::class,
          FieldRuleSeeder::class,
        ]);
    }
}
