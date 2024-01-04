<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Trip;
use Carbon\Carbon;
class GenerateMonthlyTrips extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:monthlytrips';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Monthly Trips Automatically';

    /**
     * Execute the console command.
     */
    public function handle()
    { 
        $lastmonth = Carbon::now()->startOfMonth()->subMonths();
       
        $monthly=Trip::where('type','monthly')
        ->where('start_date','>=',$lastmonth)
        ->get();

        foreach ($monthly as $month)
        {
        $trip = new Trip();
        $trip->name = $month->name;
        $trip->info = $month->info;
        $trip->type = $month->type;
        $trip->image = $month->image;
        $trip->area = $month->area;
        $trip->seats = $month->seats;
        $trip->status = 'res_open';
        $trip->priceusd = $month->priceusd;
        $trip->pricesy = $month->pricesy;
        $newstartdate = $month->start_date->addDay(30);
        $newenddate = $month->expiry_date->addDay(30);
        $trip->start_date = $newstartdate;
        $trip->expiry_date = $newenddate;
        $trip->save();
        }
        $this->info('Trips generated successfully');
    }
}
