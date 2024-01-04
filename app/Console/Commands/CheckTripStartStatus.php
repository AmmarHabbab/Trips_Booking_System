<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Trip;

class CheckTripStartStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:startstatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and Update the trip start status';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date = Carbon::now();
        $trips = Trip::query()
        ->where('start_date', '<=', $date)
        ->where('expiry_date', '>', $date)
        ->get();
    
        foreach ($trips as $trip)
        {
            $trip->status = 'ongoing';
            $trip->save();
        }
    
        $this->info('Trip status updated successfully');
    }
}
