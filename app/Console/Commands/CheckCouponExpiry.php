<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Coupon;
use Carbon\Carbon;

class CheckCouponExpiry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:couponexpiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check the command expiry date and update the status of it';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date = Carbon::now();
        $coupons = Coupon::where('status','unused')->get();
        foreach($coupons as $coupon)
        {
            if($coupon->expiry_date <= $date)
            {
                $coupon->status = 'expired';
                $coupon->save();
            }
        }
        $this->info('Coupon status updated successfully');
    }
}
