<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('configurations')->insert([
        [
          'third_party' => "Storage",
          'config_value' =>json_encode([
               "MAX_UPLOAD_SIZE" => 1024,
               "ALLOWED_UPLOADED_FILES" => json_encode([
                  "pdf",
                  "png",
                  "jpg",
                  "jpeg",
               ])
           ])
        ],
        [
          'third_party' => "Email",
          'config_value' =>json_encode([
               "MAIL_MAILER" => "smtp",
               "MAIL_HOST" => "smtp.gmail.com",
               "MAIL_PORT" => "465",
               "MAIL_USERNAME" => "saadnafie@gmail.com",
               "MAIL_PASSWORD" => "fdfzsbvuugkktnha",
               "MAIL_ENCRYPTION" => "ssl",
               "MAIL_FROM_ADDRESS" => "saadnafie@gmail.com",
               "MAIL_FROM_NAME" => "Clients Portal"
           ])
        ],
        [
          'third_party' => "ReCaptcha",
          'config_value' => json_encode([
             "NOCAPTCHA_SECRET" => "google_recaptcha_key",
             "NOCAPTCHA_SITEKEY" => "google_recaptcha_secret"
         ])
        ],
        [
          'third_party' => "Twilio",
          'config_value' => json_encode([
             "TWILIO_SID"  => "ACa4a745af7d719ab37c5fa2c8941ab33a",
             "TWILIO_AUTH_TOKEN" => "a0a460859064cbea5219b112792ff4cf",
             "TWILIO_VERIFY_SID" => "VA3db26b98318dea5046155c6b3a8897f2"
         ])
        ],
        [
          'third_party' => "Pusher",
          'config_value' => json_encode([
             "PUSHER_APP_ID"  => "Pusher_app_id",
             "PUSHER_APP_KEY" => "Pusher_app_key",
             "PUSHER_APP_SECRET" => "Pusher_app_secret",
             "PUSHER_HOST"  => "pusher_host",
             "PUSHER_PORT" => "pusher_port",
             "PUSHER_SCHEME" => "pusher_scheme",
             "PUSHER_APP_CLUSTER" => "Pusher_app_cluster"
         ])
        ],
        [
          'third_party' => "Stripe",
          'config_value' => json_encode([
               "STRIPE_KEY" => "pk_test_51MHqdoBt5ogGDchXMsJdlIsyr3LNjcImULdz7U0wNi7FIgPZq2Qeott0SoDdW5LgWgbuAZ6tNhngfi8Wz6p5Eg1C00m9wgnPsz",
               "STRIPE_SECRET" => "sk_test_51MHqdoBt5ogGDchX61yx5l7NzeDhVshPCvbc7D5DC2lFsRtj4sEXGk2BcjbLX1IxCEsQnJZ2z7KwcewmiCzqWF6a00YAz1ACVB"
           ])
        ],
      ]);

    }
}
