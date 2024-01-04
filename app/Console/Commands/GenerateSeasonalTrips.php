<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Trip;
use Carbon\Carbon;
class GenerateSeasonalTrips extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:seasonaltrips';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Seasonal Trips Automatically';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $lastseason = Carbon::now()->startOfMonth()->subMonths(2);

        $seasonal=Trip::where('type','seasonal')
        ->where('start_date','>=',$lastseason)
        ->get();

        foreach ($seasonal as $season)
        {
        $trip = new Trip();
        $trip->name = $season->name;
        $trip->info = $season->info;
        $trip->type = $season->type;
        $trip->image = $season->image;
        $trip->area = $season->area;
        $trip->seats = $season->seats;
        $trip->status = 'res_open';
        $trip->priceusd = $season->priceusd;
        $trip->pricesy = $season->pricesy;
        $newstartdate = $season->start_date->addDay(90);
        $newenddate = $season->expiry_date->addDay(90);
        $trip->start_date = $newstartdate;
        $trip->expiry_date = $newenddate;
        $trip->save();
        }
        $this->info('Trips generated successfully');
    }
}
