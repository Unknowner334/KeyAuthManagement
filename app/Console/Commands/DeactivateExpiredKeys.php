<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\License;
use Carbon\Carbon;

class DeactivateExpiredKeys extends Command
{
    protected $signature = 'licenses:deactivate-expired';
    protected $description = 'Deactivate all active licenses whose expire_date has passed';

    public function handle()
    {
        $now = Carbon::now();

        $expiredCount = License::where('status', 'Active')
                          ->where('expire_date', '<', $now)
                          ->update(['status' => 'Inactive']);

        $this->info($expiredCount . ' license(s) set to Inactive.');
    }
}
