<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Trip;
class CheckTripStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and Update the trip status';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date = Carbon::now();
        $trips = Trip::where('expiry_date', '<=', $date)->get();
    
        foreach ($trips as $trip) {
            $trip->status = 'over';
            $trip->save();
        }
    
        $this->info('Trip status updated successfully');
    }
}
