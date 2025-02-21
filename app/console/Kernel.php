<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Reset unused leave balances every 28th of the month
        $schedule->call(function () {
            \App\Models\LeaveBalance::where('year', now()->year)
                ->increment('vacation_leave', 1)
                ->increment('sick_leave', 1);
        })->monthlyOn(28, '00:00');

        // Reset leave balances to zero every year
        $schedule->call(function () {
            \App\Models\LeaveBalance::query()->update([
                'vacation_leave' => 0,
                'sick_leave' => 0,
            ]);
        })->yearlyOn(1, '00:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
    }
}
