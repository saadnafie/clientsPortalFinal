<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('countries')->insert([
        [
          'country_name' => 'Afghanistan',
          'nationality' => 'Afghan',
        ],
        [
          'country_name' => 'Åland Islands',
          'nationality' => 'Åland Island',
        ],
        [
          'country_name' => 'Albania',
          'nationality' => 'Albanian',
        ],
        [
          'country_name' => 'Algeria',
          'nationality' => 'Algerian',
        ],
        [
          'country_name' => 'American Samoa',
          'nationality' => 'American Samoan',
        ],
        [
          'country_name' => 'Andorra',
          'nationality' => 'Andorran',
        ],
        [
          'country_name' => 'Angola',
          'nationality' => 'Angolan',
        ],
        [
          'country_name' => 'Anguilla',
          'nationality' => 'Anguillan',
        ],
        [
          'country_name' => 'Antarctica',
          'nationality' => 'Antarctic',
        ],
        [
          'country_name' => 'Antigua and Barbuda',
          'nationality' => 'Antiguan or Barbudan',
        ],

        [
          'country_name' => 'Argentina',
          'nationality' => 'Argentine',
        ],
        [
          'country_name' => 'Armenia',
          'nationality' => 'Armenian',
        ],
        [
          'country_name' => 'Aruba',
          'nationality' => 'Aruban',
        ],
        [
          'country_name' => 'Australia',
          'nationality' => 'Australian',
        ],
        [
          'country_name' => 'Austria',
          'nationality' => 'Austrian',
        ],
        [
          'country_name' => 'Azerbaijan',
          'nationality' => 'Azerbaijani',
        ],
        [
          'country_name' => 'Bahamas',
          'nationality' => 'Bahamian',
        ],
        [
          'country_name' => 'Bahrain',
          'nationality' => 'Bahraini',
        ],
        [
          'country_name' => 'Bangladesh',
          'nationality' => 'Bangladeshi',
        ],
        [
          'country_name' => 'Barbados',
          'nationality' => 'Barbadian',
        ],

        [
          'country_name' => 'Belarus',
          'nationality' => 'Belarusian',
        ],
        [
          'country_name' => 'Belgium',
          'nationality' => 'Belgian',
        ],
        [
          'country_name' => 'Belize',
          'nationality' => 'Belizean',
        ],
        [
          'country_name' => 'Benin',
          'nationality' => 'Beninese, Beninois',
        ],
        [
          'country_name' => 'Bermuda',
          'nationality' => 'Bermudian, Bermudan',
        ],
        [
          'country_name' => 'Bhutan',
          'nationality' => 'Bhutanese',
        ],
        [
          'country_name' => 'Bolivia (Plurinational State of)',
          'nationality' => 'Bolivian',
        ],
        [
          'country_name' => 'Bonaire, Sint Eustatius and Saba',
          'nationality' => 'Bonaire',
        ],
        [
          'country_name' => 'Bosnia and Herzegovina',
          'nationality' => 'Bosnian or Herzegovinian',
        ],
        [
          'country_name' => 'Botswana',
          'nationality' => 'Motswana',
        ],

        [
          'country_name' => 'Bouvet Island',
          'nationality' => 'Bouvet Island',
        ],
        [
          'country_name' => 'Brazil',
          'nationality' => 'Brazilian',
        ],
        [
          'country_name' => 'British Indian Ocean Territory',
          'nationality' => 'BIOT',
        ],
        [
          'country_name' => 'Brunei Darussalam',
          'nationality' => 'Bruneian',
        ],
        [
          'country_name' => 'Bulgaria',
          'nationality' => 'Bulgarian',
        ],
        [
          'country_name' => 'Burkina Faso',
          'nationality' => 'Burkinabé',
        ],
        [
          'country_name' => 'Burundi',
          'nationality' => 'Burundian',
        ],
        [
          'country_name' => 'Cabo Verde',
          'nationality' => 'Cabo Verdean',
        ],
        [
          'country_name' => 'Cambodia',
          'nationality' => 'Cambodian',
        ],
        [
          'country_name' => 'Cameroon',
          'nationality' => 'Cameroonian',
        ],

        [
          'country_name' => 'Canada',
          'nationality' => 'Canadian',
        ],
        [
          'country_name' => 'Cayman Islands',
          'nationality' => 'Caymanian',
        ],
        [
          'country_name' => 'Central African Republic',
          'nationality' => 'Central African',
        ],
        [
          'country_name' => 'Chad',
          'nationality' => 'Chadian',
        ],
        [
          'country_name' => 'Chile',
          'nationality' => 'Chilean',
        ],
        [
          'country_name' => 'China',
          'nationality' => 'Chinese',
        ],
        [
          'country_name' => 'Christmas Island',
          'nationality' => 'Christmas Island',
        ],
        [
          'country_name' => 'Cocos (Keeling) Islands',
          'nationality' => 'Cocos Island',
        ],
        [
          'country_name' => 'Colombia',
          'nationality' => 'Colombian',
        ],
        [
          'country_name' => 'Comoros',
          'nationality' => 'Comoran, Comorian',
        ],

        [
          'country_name' => 'Congo (Republic of the)',
          'nationality' => 'Congolese',
        ],
        [
          'country_name' => 'Congo (Democratic Republic of the)',
          'nationality' => 'Congolese',
        ],
        [
          'country_name' => 'Cook Islands',
          'nationality' => 'Cook Island',
        ],
        [
          'country_name' => 'Costa Rica',
          'nationality' => 'Costa Rican',
        ],
        [
          'country_name' => 'Côte d Ivoire',
          'nationality' => 'Ivorian',
        ],
        [
          'country_name' => 'Croatia',
          'nationality' => 'Croatian',
        ],
        [
          'country_name' => 'Cuba',
          'nationality' => 'Cuban',
        ],
        [
          'country_name' => 'Curaçao',
          'nationality' => 'Curaçaoan',
        ],
        [
          'country_name' => 'Cyprus',
          'nationality' => 'Cypriot',
        ],
        [
          'country_name' => 'Czech Republic',
          'nationality' => 'Czech',
        ],

        [
          'country_name' => 'Denmark',
          'nationality' => 'Danish',
        ],
        [
          'country_name' => 'Djibouti',
          'nationality' => 'Djiboutian',
        ],
        [
          'country_name' => 'Dominica',
          'nationality' => 'Dominican',
        ],
        [
          'country_name' => 'Dominican Republic',
          'nationality' => 'Dominican',
        ],
        [
          'country_name' => 'Ecuador',
          'nationality' => 'Ecuadorian',
        ],
        [
          'country_name' => 'Egypt',
          'nationality' => 'Egyptian',
        ],
        [
          'country_name' => 'El Salvador',
          'nationality' => 'Salvadoran',
        ],
        [
          'country_name' => 'Equatorial Guinea',
          'nationality' => 'Equatorial Guinean, Equatoguinean',
        ],
        [
          'country_name' => 'Eritrea',
          'nationality' => 'Bangladeshi',
        ],
        [
          'country_name' => 'Estonia',
          'nationality' => 'Estonian',
        ],

        [
          'country_name' => 'Ethiopia',
          'nationality' => 'Ethiopian',
        ],
        [
          'country_name' => 'Falkland Islands (Malvinas)',
          'nationality' => 'Falkland Island',
        ],
        [
          'country_name' => 'Faroe Islands',
          'nationality' => 'Faroese',
        ],
        [
          'country_name' => 'Fiji',
          'nationality' => 'Fijian',
        ],
        [
          'country_name' => 'Finland',
          'nationality' => 'Finnish',
        ],
        [
          'country_name' => 'France',
          'nationality' => 'French',
        ],
        [
          'country_name' => 'French Guiana',
          'nationality' => 'French Guianese',
        ],
        [
          'country_name' => 'French Polynesia',
          'nationality' => 'French Polynesian',
        ],
        [
          'country_name' => 'French Southern Territories',
          'nationality' => 'French Southern Territories',
        ],
        [
          'country_name' => 'Gabon',
          'nationality' => 'Gabonese',
        ],

        [
          'country_name' => 'Gambia',
          'nationality' => 'Gambian',
        ],
        [
          'country_name' => 'Georgia',
          'nationality' => 'Georgian',
        ],
        [
          'country_name' => 'Germany',
          'nationality' => 'German',
        ],
        [
          'country_name' => 'Ghana',
          'nationality' => 'Ghanaian',
        ],
        [
          'country_name' => 'Gibraltar',
          'nationality' => 'Gibraltar',
        ],
        [
          'country_name' => 'Greece',
          'nationality' => 'Greek, Hellenic',
        ],
        [
          'country_name' => 'Greenland',
          'nationality' => 'Greenlandic',
        ],
        [
          'country_name' => 'Grenada',
          'nationality' => 'Grenadian',
        ],
        [
          'country_name' => 'Guadeloupe',
          'nationality' => 'Guadeloupe',
        ],
        [
          'country_name' => 'Guam',
          'nationality' => 'Guamanian, Guambat',
        ],

        [
          'country_name' => 'Guatemala',
          'nationality' => 'Guatemalan',
        ],
        [
          'country_name' => 'Guernsey',
          'nationality' => 'Channel Island',
        ],
        [
          'country_name' => 'Guinea',
          'nationality' => 'Guinean',
        ],
        [
          'country_name' => 'Guinea-Bissau',
          'nationality' => 'Bissau-Guinean',
        ],
        [
          'country_name' => 'Guyana',
          'nationality' => 'Guyanese',
        ],
        [
          'country_name' => 'Haiti',
          'nationality' => 'Haitian',
        ],
        [
          'country_name' => 'Heard Island and McDonald Islands',
          'nationality' => 'Heard Island or McDonald Islands',
        ],
        [
          'country_name' => 'Vatican City State',
          'nationality' => 'Vatican',
        ],
        [
          'country_name' => 'Honduras',
          'nationality' => 'Honduran',
        ],
        [
          'country_name' => 'Hong Kong',
          'nationality' => 'Hong Kong, Hong Kongese',
        ],

        [
          'country_name' => 'Hungary',
          'nationality' => 'Hungarian, Magyar',
        ],
        [
          'country_name' => 'Iceland',
          'nationality' => 'Icelandic',
        ],
        [
          'country_name' => 'India',
          'nationality' => 'Indian',
        ],
        [
          'country_name' => 'Indonesia',
          'nationality' => 'Indonesian',
        ],
        [
          'country_name' => 'Iran',
          'nationality' => 'Iranian, Persian',
        ],
        [
          'country_name' => 'Iraq',
          'nationality' => 'Iraqi',
        ],
        [
          'country_name' => 'Ireland',
          'nationality' => 'Irish',
        ],
        [
          'country_name' => 'Isle of Man',
          'nationality' => 'Manx',
        ],
        [
          'country_name' => 'Italy',
          'nationality' => 'Italian',
        ],

        [
          'country_name' => 'Jamaica',
          'nationality' => 'Jamaican',
        ],
        [
          'country_name' => 'Japan',
          'nationality' => 'Japanese',
        ],
        [
          'country_name' => 'Jersey',
          'nationality' => 'Channel Island',
        ],
        [
          'country_name' => 'Jordan',
          'nationality' => 'Jordanian',
        ],
        [
          'country_name' => 'Kazakhstan',
          'nationality' => 'Kazakhstani, Kazakh',
        ],
        [
          'country_name' => 'Kenya',
          'nationality' => 'Kenyan',
        ],
        [
          'country_name' => 'Kiribati',
          'nationality' => 'I-Kiribati',
        ],
        [
          'country_name' => 'Korea (Democratic Peoples Republic of)',
          'nationality' => 'North Korean',
        ],
        [
          'country_name' => 'Korea (Republic of)',
          'nationality' => 'South Korean',
        ],
        [
          'country_name' => 'Kuwait',
          'nationality' => 'Kuwaiti',
        ],

        [
          'country_name' => 'Kyrgyzstan',
          'nationality' => 'Kyrgyzstani, Kyrgyz, Kirgiz, Kirghiz',
        ],
        [
          'country_name' => 'Lao Peoples Democratic Republic',
          'nationality' => 'Lao, Laotian',
        ],
        [
          'country_name' => 'Latvia',
          'nationality' => 'Latvian',
        ],
        [
          'country_name' => 'Lebanon',
          'nationality' => 'Lebanese',
        ],
        [
          'country_name' => 'Lesotho',
          'nationality' => 'Basotho',
        ],
        [
          'country_name' => 'Liberia',
          'nationality' => 'Liberian',
        ],
        [
          'country_name' => 'Libya',
          'nationality' => 'Libyan',
        ],
        [
          'country_name' => 'Liechtenstein',
          'nationality' => 'Liechtenstein',
        ],
        [
          'country_name' => 'Lithuania',
          'nationality' => 'Lithuanian',
        ],
        [
          'country_name' => 'Luxembourg',
          'nationality' => 'Luxembourg, Luxembourgish',
        ],

        [
          'country_name' => 'Macao',
          'nationality' => 'Macanese, Chinese',
        ],
        [
          'country_name' => 'Macedonia (the former Yugoslav Republic of)',
          'nationality' => 'Macedonian',
        ],
        [
          'country_name' => 'Madagascar',
          'nationality' => 'Malagasy',
        ],
        [
          'country_name' => 'Malawi',
          'nationality' => 'Malawian',
        ],
        [
          'country_name' => 'Malaysia',
          'nationality' => 'Malaysian',
        ],
        [
          'country_name' => 'Maldives',
          'nationality' => 'Maldivian',
        ],
        [
          'country_name' => 'Mali',
          'nationality' => 'Malian, Malinese',
        ],
        [
          'country_name' => 'Malta',
          'nationality' => 'Maltese',
        ],
        [
          'country_name' => 'Marshall Islands',
          'nationality' => 'Marshallese',
        ],
        [
          'country_name' => 'Martinique',
          'nationality' => 'Martiniquais, Martinican',
        ],

        [
          'country_name' => 'Mauritania',
          'nationality' => 'Mauritanian',
        ],
        [
          'country_name' => 'Mauritius',
          'nationality' => 'Mauritian',
        ],
        [
          'country_name' => 'Mayotte',
          'nationality' => 'Mahoran',
        ],
        [
          'country_name' => 'Mexico',
          'nationality' => 'Mexican',
        ],
        [
          'country_name' => 'Micronesia (Federated States of)',
          'nationality' => 'Micronesian',
        ],
        [
          'country_name' => 'Moldova (Republic of)',
          'nationality' => 'Moldovan',
        ],
        [
          'country_name' => 'Monaco',
          'nationality' => 'Monégasque, Monacan',
        ],
        [
          'country_name' => 'Mongolia',
          'nationality' => 'Mongolian',
        ],
        [
          'country_name' => 'Montenegro',
          'nationality' => 'Montenegrin',
        ],
        [
          'country_name' => 'Montserrat',
          'nationality' => 'Montserratian',
        ],

        [
          'country_name' => 'Morocco',
          'nationality' => 'Moroccan',
        ],
        [
          'country_name' => 'Mozambique',
          'nationality' => 'Mozambican',
        ],
        [
          'country_name' => 'Myanmar',
          'nationality' => 'Burmese',
        ],
        [
          'country_name' => 'Namibia',
          'nationality' => 'Namibian',
        ],
        [
          'country_name' => 'Nauru',
          'nationality' => 'Nauruan',
        ],
        [
          'country_name' => 'Nepal',
          'nationality' => 'Nepali, Nepalese',
        ],
        [
          'country_name' => 'Netherlands',
          'nationality' => 'Dutch, Netherlandic',
        ],
        [
          'country_name' => 'New Caledonia',
          'nationality' => 'New Caledonian',
        ],
        [
          'country_name' => 'New Zealand',
          'nationality' => 'New Zealand, NZ',
        ],
        [
          'country_name' => 'Nicaragua',
          'nationality' => 'Nicaraguan',
        ],

        [
          'country_name' => 'Niger',
          'nationality' => 'Nigerien',
        ],
        [
          'country_name' => 'Nigeria',
          'nationality' => 'Nigerian',
        ],
        [
          'country_name' => 'Niue',
          'nationality' => 'Niuean',
        ],
        [
          'country_name' => 'Norfolk Island',
          'nationality' => 'Norfolk Island',
        ],
        [
          'country_name' => 'Northern Mariana Islands',
          'nationality' => 'Northern Marianan',
        ],
        [
          'country_name' => 'Norway',
          'nationality' => 'Norwegian',
        ],
        [
          'country_name' => 'Oman',
          'nationality' => 'Omani',
        ],
        [
          'country_name' => 'Pakistan',
          'nationality' => 'Pakistani',
        ],
        [
          'country_name' => 'Palau',
          'nationality' => 'Palauan',
        ],
        [
          'country_name' => 'Palestine, State of',
          'nationality' => 'Palestinian',
        ],

        [
          'country_name' => 'Panama',
          'nationality' => 'Panamanian',
        ],
        [
          'country_name' => 'Papua New Guinea',
          'nationality' => 'Papua New Guinean, Papuan',
        ],
        [
          'country_name' => 'Paraguay',
          'nationality' => 'Paraguay',
        ],
        [
          'country_name' => 'Peru',
          'nationality' => 'Peruvian',
        ],
        [
          'country_name' => 'Philippines',
          'nationality' => 'Philippine, Filipino',
        ],
        [
          'country_name' => 'Pitcairn',
          'nationality' => 'Pitcairn Island',
        ],
        [
          'country_name' => 'Poland',
          'nationality' => 'Polish',
        ],
        [
          'country_name' => 'Portugal',
          'nationality' => 'Portuguese',
        ],
        [
          'country_name' => 'Puerto Rico',
          'nationality' => 'Puerto Rican',
        ],
        [
          'country_name' => 'Qatar',
          'nationality' => 'Qatari',
        ],

        [
          'country_name' => 'Réunion',
          'nationality' => 'Réunionese, Réunionnais',
        ],
        [
          'country_name' => 'Romania',
          'nationality' => 'Romanian',
        ],
        [
          'country_name' => 'Russian Federation',
          'nationality' => 'Russian',
        ],
        [
          'country_name' => 'Rwanda',
          'nationality' => 'Rwandan',
        ],
        [
          'country_name' => 'Saint Barthélemy',
          'nationality' => 'Barthélemois',
        ],
        [
          'country_name' => 'Saint Helena, Ascension and Tristan da Cunha',
          'nationality' => 'Saint Helenian',
        ],
        [
          'country_name' => 'Saint Kitts and Nevis',
          'nationality' => 'Kittitian or Nevisian',
        ],
        [
          'country_name' => 'Saint Lucia',
          'nationality' => 'Saint Lucian',
        ],
        [
          'country_name' => 'Saint Martin (French part)',
          'nationality' => 'Saint-Martinoise',
        ],
        [
          'country_name' => 'Saint Pierre and Miquelon',
          'nationality' => 'Saint-Pierrais or Miquelonnais',
        ],

        [
          'country_name' => 'Saint Vincent and the Grenadines',
          'nationality' => 'Saint Vincentian, Vincentian',
        ],
        [
          'country_name' => 'Samoa',
          'nationality' => 'Samoan',
        ],
        [
          'country_name' => 'San Marino',
          'nationality' => 'Sammarinese',
        ],
        [
          'country_name' => 'Sao Tome and Principe',
          'nationality' => 'São Toméan',
        ],
        [
          'country_name' => 'Saudi Arabia',
          'nationality' => 'Saudi, Saudi Arabian',
        ],
        [
          'country_name' => 'Senegal',
          'nationality' => 'Senegalese',
        ],
        [
          'country_name' => 'Serbia',
          'nationality' => 'Serbian',
        ],
        [
          'country_name' => 'Seychelles',
          'nationality' => 'Seychellois',
        ],
        [
          'country_name' => 'Sierra Leone',
          'nationality' => 'Sierra Leonean',
        ],
        [
          'country_name' => 'Singapore',
          'nationality' => 'Singaporean',
        ],

        [
          'country_name' => 'Sint Maarten (Dutch part)',
          'nationality' => 'Sint Maarten',
        ],
        [
          'country_name' => 'Slovakia',
          'nationality' => 'Slovak',
        ],
        [
          'country_name' => 'Slovenia',
          'nationality' => 'Slovenian, Slovene',
        ],
        [
          'country_name' => 'AustraliSolomon Islandsa',
          'nationality' => 'Solomon Island',
        ],
        [
          'country_name' => 'Somalia',
          'nationality' => 'Somali, Somalian',
        ],
        [
          'country_name' => 'South Africa',
          'nationality' => 'South African',
        ],
        [
          'country_name' => 'South Georgia and the South Sandwich Islands',
          'nationality' => 'South Georgia or South Sandwich Islands',
        ],
        [
          'country_name' => 'South Sudan',
          'nationality' => 'South Sudanese',
        ],
        [
          'country_name' => 'Spain',
          'nationality' => 'Spanish',
        ],
        [
          'country_name' => 'Sri Lanka',
          'nationality' => 'Sri Lankan',
        ],

        [
          'country_name' => 'Sudan',
          'nationality' => 'Sudanese',
        ],
        [
          'country_name' => 'Suriname',
          'nationality' => 'Surinamese',
        ],
        [
          'country_name' => 'Svalbard and Jan Mayen',
          'nationality' => 'Svalbard',
        ],
        [
          'country_name' => 'Swaziland',
          'nationality' => 'Swazi',
        ],
        [
          'country_name' => 'Sweden',
          'nationality' => 'Swedish',
        ],
        [
          'country_name' => 'Switzerland',
          'nationality' => 'Swiss',
        ],
        [
          'country_name' => 'Syrian Arab Republic',
          'nationality' => 'Syrian',
        ],
        [
          'country_name' => 'Taiwan, Province of China',
          'nationality' => 'Chinese, Taiwanese',
        ],
        [
          'country_name' => 'Tajikistan',
          'nationality' => 'Tajikistani',
        ],
        [
          'country_name' => 'Tanzania, United Republic of',
          'nationality' => 'Tanzanian',
        ],

        [
          'country_name' => 'Thailand',
          'nationality' => 'Thai',
        ],
        [
          'country_name' => 'Timor-Leste',
          'nationality' => 'Timorese',
        ],
        [
          'country_name' => 'Togo',
          'nationality' => 'Togolese',
        ],
        [
          'country_name' => 'Tokelau',
          'nationality' => 'Tokelauan',
        ],
        [
          'country_name' => 'Tonga',
          'nationality' => 'Tongan',
        ],
        [
          'country_name' => 'Tongan',
          'nationality' => 'Trinidadian or Tobagonian',
        ],
        [
          'country_name' => 'Tunisia',
          'nationality' => 'Tunisian',
        ],
        [
          'country_name' => 'Turkey',
          'nationality' => 'Turkish',
        ],
        [
          'country_name' => 'Turkmenistan',
          'nationality' => 'Turkmen',
        ],
        [
          'country_name' => 'Turks and Caicos Islands',
          'nationality' => 'Turks and Caicos Island',
        ],

        [
          'country_name' => 'Tuvalu',
          'nationality' => 'Tuvaluan',
        ],
        [
          'country_name' => 'Uganda',
          'nationality' => 'Ugandan',
        ],
        [
          'country_name' => 'Ukraine',
          'nationality' => 'Ukrainian',
        ],
        [
          'country_name' => 'United Arab Emirates',
          'nationality' => 'Emirati, Emirian, Emiri',
        ],
        [
          'country_name' => 'United Kingdom of Great Britain and Northern Ireland',
          'nationality' => 'British, UK',
        ],
        [
          'country_name' => 'United States Minor Outlying Islands',
          'nationality' => 'American',
        ],
        [
          'country_name' => 'United States of America',
          'nationality' => 'American',
        ],
        [
          'country_name' => 'Uruguay',
          'nationality' => 'Uruguayan',
        ],
        [
          'country_name' => 'Uzbekistan',
          'nationality' => 'Uzbekistani, Uzbek',
        ],
        [
          'country_name' => 'Vanuatu',
          'nationality' => 'Ni-Vanuatu, Vanuatuan',
        ],

        [
          'country_name' => 'Venezuela (Bolivarian Republic of)',
          'nationality' => 'Venezuelan',
        ],
        [
          'country_name' => 'Vietnam',
          'nationality' => 'Vietnamese',
        ],
        [
          'country_name' => 'Virgin Islands (British)',
          'nationality' => 'British Virgin Island',
        ],
        [
          'country_name' => 'Virgin Islands (U.S.)',
          'nationality' => 'U.S. Virgin Island',
        ],
        [
          'country_name' => 'Wallis and Futuna',
          'nationality' => 'Wallis and Futuna, Wallisian or Futunan',
        ],
        [
          'country_name' => 'Western Sahara',
          'nationality' => 'Sahrawi, Sahrawian, Sahraouian',
        ],
        [
          'country_name' => 'Yemen',
          'nationality' => 'Yemeni',
        ],
        [
          'country_name' => 'Zambia',
          'nationality' => 'Zambian',
        ],
        [
          'country_name' => 'Zimbabwe',
          'nationality' => 'Zimbabwean',
        ],


      ]);


         
    }
}
