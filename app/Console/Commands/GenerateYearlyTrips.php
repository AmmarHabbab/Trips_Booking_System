<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Trip;
use Carbon\Carbon;
class GenerateYearlyTrips extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:yearlytrips';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Yearly Trips Automatically';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $lastyear = Carbon::now()->startOfYear()->subYear();

        $yearly=Trip::where('type','yearly')
        ->where('start_date','>=',$lastyear)
        ->get();

        foreach ($yearly as $year)
        {
        $trip = new Trip();
        $trip->name = $year->name;
        $trip->info = $year->info;
        $trip->type = $year->type;
        $trip->image = $year->image;
        $trip->area = $year->area;
        $trip->seats = $year->seats;
        $trip->status = 'res_open';
        $trip->priceusd = $year->priceusd;
        $trip->pricesy = $year->pricesy;
        $newstartdate = $year->start_date->addDay(365);
        $newenddate = $year->expiry_date->addDay(365);
        $trip->start_date = $newstartdate;
        $trip->expiry_date = $newenddate;
        $trip->save();
        }
        $this->info('Trips generated successfully');
    }
}
