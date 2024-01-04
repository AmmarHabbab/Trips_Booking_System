<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Trip;
use Carbon\Carbon;
class GenerateWeeklyTrips extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:weeklytrips';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Weekly Trips Automatically';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $lastweek = Carbon::now()->startOfWeek()->subWeeks();
        
        $weekly=Trip::where('type','weekly')
        ->where('start_date','>=',$lastweek)
        ->get();
        
        foreach ($weekly as $week)
        {
        $trip = new Trip();
        $trip->name = $week->name;
        $trip->info = $week->info;
        $trip->type = $week->type;
        $trip->image = $week->image;
        $trip->area = $week->area;
        $trip->seats = $week->seats;
        $trip->status = 'res_open';
        $trip->priceusd = $week->priceusd;
        $trip->pricesy = $week->pricesy;
        $newstartdate = $week->start_date->addDay(7);
        $newenddate = $week->expiry_date->addDay(7);
        $trip->start_date = $newstartdate;
        $trip->expiry_date = $newenddate;
        $trip->save();
        }
        $this->info('Trips generated successfully');
    }
}
