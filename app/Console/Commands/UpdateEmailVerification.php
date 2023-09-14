<?php

namespace App\Console\Commands;

use App\Models\EmailVerification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateEmailVerification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emailverification:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove all email verifications from the EmailVerification table for the requests of 10 min ago';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $minutes  = Carbon::now()->subMinutes( 10 );
        EmailVerification::where('created_at', '<=', $minutes)->delete();
        return $this->info('Successfully deleted old email verification requests.');
    }
}