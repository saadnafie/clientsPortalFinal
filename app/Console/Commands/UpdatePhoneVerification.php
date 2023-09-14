<?php

namespace App\Console\Commands;

use App\Models\PhoneVerificationAuth;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\PhoneVerification;

class UpdatePhoneVerification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'phoneverification:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove all phone verifications from the PhoneVerification table for the requests of 3 min ago';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $minutes  = Carbon::now()->subMinutes( 3 );
        PhoneVerification::where('created_at', '<=', $minutes)->delete();
        PhoneVerificationAuth::where('created_at', '<=', $minutes)->delete();
        return $this->info('Successfully deleted old phone verification requests.');
    }
}
