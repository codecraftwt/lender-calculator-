<?php

namespace App\Console\Commands;

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class DeleteExpiredOtps extends Command
{
    protected $signature = 'otps:delete-expired';
    protected $description = 'Delete OTPs that are older than 60 seconds';

    public function handle()
    {
        // Delete OTPs older than 60 seconds
        User::where('otp_time', '<', Carbon::now()->subSeconds(60))->update(['otp' => "", 'otp_time' => ""]);

        $this->info('Expired OTPs have been deleted successfully.');
    }
}
