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
        // $schedule->command('inspire')->hourly();
        $schedule->command('generate:dailytrips')->daily();
        $schedule->command('generate:weeklytrips')->weekly();
        $schedule->command('generate:monthlytrips')->monthly();
        $schedule->command('generate:seasonaltrips')
         ->monthly()
         ->when(function () {
             return in_array(date('m'), [1, 4, 7, 10]);
         });
         $schedule->command('generate:yearlytrips')->yearly();
         $schedule->command('check:status')->daily();
         $schedule->command('check:startstatus')->daily();
         $schedule->command('check:couponexpiry')->everyMinute();
        }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
