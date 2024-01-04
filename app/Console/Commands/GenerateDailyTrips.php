<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Trip;
use Carbon\Carbon;
class GenerateDailyTrips extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:dailytrips';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Daily Trips Automatically';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date = Carbon::yesterday();

        $daily=Trip::where('type','daily')
        ->where('start_date','>=',$date)
        ->get();
        
        foreach ($daily as $day)
        {
        $trip = new Trip();
        $trip->name = $day->name;
        $trip->info = $day->info;
        $trip->type = $day->type;
        $trip->image = $day->image;
        $trip->area = $day->area;
        $trip->seats = $day->seats;
        $trip->status = 'res_open';
        $trip->priceusd = $day->priceusd;
        $trip->pricesy = $day->pricesy;
        $newstartdate = $day->start_date->addDay();
        $newenddate = $day->expiry_date->addDay();
        $trip->start_date = $newstartdate;
        $trip->expiry_date = $newenddate;
        $trip->save();
        }
        $this->info('Trips generated successfully');
    }
}
