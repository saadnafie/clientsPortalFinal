<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('form_fields')->insert([
        [
          'field_label' => "First Name",
          'type_id' => 1
        ],
        [
          'field_label' => "Middle Name",
          'type_id' => 1
        ],
        [
          'field_label' => "Last Name",
          'type_id' => 1
        ],
        [
          'field_label' => "Profession",
          'type_id' => 9
        ],
        [
          'field_label' => "Nationality",
          'type_id' => 12
        ],
        [
          'field_label' => "Country",
          'type_id' => 11
        ],
        [
          'field_label' => "ID or Residence Number",
          'type_id' => 1
        ],
        [
          'field_label' => "Passport Number",
          'type_id' => 1
        ],
        [
          'field_label' => "Photo with Medical Uniform",
          'type_id' => 8
        ],
        [
          'field_label' => "Upload copy of your passport",
          'type_id' => 8
        ],
        [
          'field_label' => "Upload copy of your ID or Residence",
          'type_id' => 8
        ],
        [
          'field_label' => "Additional Document",
          'type_id' => 8
        ],
        [
          'field_label' => "Issuing Authority Name",
          'type_id' => 1
        ],
        [
          'field_label' => "Country",
          'type_id' => 11
        ],
        [
          'field_label' => "Certificate Name",
          'type_id' => 1
        ],
        [
          'field_label' => "Conferred or Awarded Date",
          'type_id' => 7
        ],
        [
          'field_label' => "Upload Educational Certificate",
          'type_id' => 8
        ],
        [
          'field_label' => "Upload Marksheet",
          'type_id' => 8
        ],
        [
          'field_label' => "License",
          'type_id' => 1
        ],
        [
          'field_label' => "Valid From",
          'type_id' => 7
        ],
        [
          'field_label' => "Valid To",
          'type_id' => 7
        ],
        [
          'field_label' => "Upload Health License or Registration",
          'type_id' => 8
        ],
        [
          'field_label' => "Designation",
          'type_id' => 1
        ],
        [
          'field_label' => "Start Date",
          'type_id' => 7
        ],
        [
          'field_label' => "End Date",
          'type_id' => 7
        ],
        [
          'field_label' => "Address",
          'type_id' => 1
        ],
        [
          'field_label' => "Phone",
          'type_id' => 1
        ],
        [
          'field_label' => "Email",
          'type_id' => 6
        ],
        [
          'field_label' => "Upload Employment Certificate",
          'type_id' => 8
        ],

      ]);
    }
}
