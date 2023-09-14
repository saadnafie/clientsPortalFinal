<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FieldRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('field_rules')->insert([
            [
                'rule_name' => "required",
                'rule_description' => "a field should be filled obligatory (true or false)"
            ],
            [
                'rule_name' => "alphanumeric",
                'rule_description' => "accept only digits, characters and underscore"
            ],
            [
                'rule_name' => "maxlength",
                'rule_description' => "maximum number of characters (a number)"
            ],
            [
                'rule_name' => "minlength",
                'rule_description' => "minimum number of characters (a number)"
            ],
            [
                'rule_name' => "email",
                'rule_description' => "verifying of the email address correctness (true or false)"
            ],
            [
                'rule_name' => "url",
                'rule_description' => "verifying of the url address correctness (true or false)"
            ],
            [
                'rule_name' => "remote",
                'rule_description' => "specifying a file for checking the field (for example: check.php)"
            ],
            [
                'rule_name' => "date",
                'rule_description' => "verifying of the date correctness (true or false)"
            ],
            [
                'rule_name' => "dateISO",
                'rule_description' => "verifying of the ISO date correctness (true or false)"
            ],
            [
                'rule_name' => "number",
                'rule_description' => "the number verifying (true or false)"
            ],
            [
                'rule_name' => "digits",
                'rule_description' => "only numbers (true or false)"
            ],
            [
                'rule_name' => "creditcard",
                'rule_description' => "a credit card number correctness (true or false)"
            ],
            [
                'rule_name' => "equalTo",
                'rule_description' => "equal to something (for example, to another field equalTo:»#pswd»)"
            ],
            [
                'rule_name' => "accept",
                'rule_description' => "verifying of correct extension (accept: «xls|csv»)"
            ],
            [
                'rule_name' => "rangelength",
                'rule_description' => "range of character lengths, minimum and maximum (rangelength: [2, 6])"
            ],
            [
                'rule_name' => "range",
                'rule_description' => "a number should be within the range from to (range: [13, 23])"
            ],
            [
                'rule_name' => "max",
                'rule_description' => "maximum number (22)"
            ],
            [
                'rule_name' => "min",
                'rule_description' => "minimum number (11)"
            ],

          ]);
    }
}
