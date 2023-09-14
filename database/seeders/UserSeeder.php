<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
       [
         'name' => "Admin",
         'email' => "admin@clients-portal.com",
         'password' => \Hash::make('12345678'),
         'phone' => "1234567891",
         'role_id' => 1,
         'details' => 'No',
         'email_verified_at' => now(),
         'phone_verified_at' => now(),
       ],
       [
        'name' => "Agent",
        'email' => "agent@clients-portal.com",
        'password' => \Hash::make('12345678'),
        'phone' => "1234567819",
        'role_id' => 4,
        'details' => 'No',
        'email_verified_at' => now(),
        'phone_verified_at' => now(),
       ],
       [
         'name' => "Saad Nafie",
         'email' => "saadnafie@gmail.com",
         'password' => \Hash::make('12345678'),
         'phone' => "+201157124949",
         'role_id' => 2,
         'details' => 'No',
         'email_verified_at' => now(),
         'phone_verified_at' => now(),
       ],
       [
        'name' => "Mohamed Saad",
        'email' => "msaad@gmail.com",
        'password' => \Hash::make('12345678'),
        'phone' => "+222157124948",
        'role_id' => 3,
        'details' => 'No',
        'email_verified_at' => now(),
        'phone_verified_at' => now(),
      ],

      ]);
    }
}