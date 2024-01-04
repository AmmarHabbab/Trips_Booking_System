<?php



namespace App\Http\Controllers;

// require 'vendor/autoload.php';

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\Translater;
use App\Models\Coupon;
use App\Models\User;
use Auth;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
// use Slim\Http\Request;
// use Slim\Http\Response;
use Stripe\Stripe;
use Str;

class BookingController extends Controller
{
   
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Trip $trip)
    {
        $translaters = Translater::where('status','available')->get();
        $available_seats = $trip->seats - $trip->seats_taken;
        return view('pages.book',compact('translaters','trip','available_seats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function payment(Request $request,Trip $trip)
    {
        $request->validate([
            // 'seats' => 'required',
             'currency' => 'required',
             'payment' => 'required'
         ]);

        $bookings = Booking::where('trip_id',$trip->id)->get();
        foreach($bookings as $booking)
        {
            if($booking->user_id == Auth::id())
            {
                return response()->json(['message','You Already Booked for this trip!']);
            }
        }

        $user_bookings = Booking::where('user_id',Auth::id())->get();
      
       
        foreach($user_bookings as $user_booking)
        {
            $user_trip = Trip::where('id',$user_booking->trip_id)->first();
            if($user_trip->status != 'over' && $user_trip->status != 'canceled')
            {
                // if($user_trip->expiry_date >= $trip->start_date || $trip->expiry_date >= $user_trip->start_date)
                // {
                    if (($user_trip->expiry_date >= $trip->start_date && $user_trip->start_date <= $trip->start_date) || 
                       ($trip->expiry_date >= $user_trip->start_date && $trip->start_date <= $user_trip->start_date)) 
                {
                    return response()->json(['message','Sorry u cant book another trip at the same time with ur booked trip:'.$user_trip->name]);
                }
            }
        }


        $available_seats = $trip->seats - $trip->seats_taken;

        if($available_seats < 1)
        {
            return response()->json(['message','Sorry no available seats for booking']);
        }
       // if($request->seats > $available_seats)
       // {
       //     return response()->json(['message','Sorry no available seats for booking the only available seats number is:'.$available_seats]);
       // }
        $coupon=null;
        if($request->coupon)
        {
            $coupon = Coupon::where('coupon_code',$request->coupon)->first();
            if(!$coupon || $coupon->user_id != Auth::id() || $coupon->status != 'unused')
            {
                return response()->json(['message','Sorry this coupon in not yours or doesn"t exist or expired or used!']);
            }
        }
       

        if($request->translater != 'Choose a Translater if You Want!')
        {
            $translater = Translater::where('name',$request->translater)->first();
        }
        
        if($request->currency == "SY")
        {
            if($request->translater != 'Choose a Translater if You Want!')
            {
              $totalpayment = ($trip->pricesy) + $translater->pricesy;
              if($coupon)
              {
                $discount_amount = ($totalpayment * $coupon->discount_percentage) / 100;
                $totalpayment = $totalpayment - $discount_amount;
              }
            }
            if($coupon)
              {
                $totalpayment =  $trip->pricesy;
                $discount_amount = ($totalpayment * $coupon->discount_percentage) / 100;
                $totalpayment = $totalpayment - $discount_amount;
              }
              else
              {
                $totalpayment =  $trip->pricesy;
              }
        }
        else
        {
            if($request->translater != 'Choose a Translater if You Want!')
            {
              $totalpayment = ($trip->priceusd) + $translater->priceusd;
              if($coupon)
              {
                $discount_amount = ($totalpayment * $coupon->discount_percentage) / 100;
                $totalpayment = $totalpayment - $discount_amount;
              }
             
            }
            if($coupon)
            {
              $totalpayment = $trip->priceusd;
              $discount_amount = ($totalpayment * $coupon->discount_percentage) / 100;
              $totalpayment = $totalpayment - $discount_amount;
            }
            else
            {
               $totalpayment = $trip->priceusd;
            }
        }

        // if($request->translater != "Choose a Translater if You Want!")
        // {
        //     $translater = Translater->
        // }

        if($request->payment == "Cash")
        {
            $payment = new Payment();
            $payment->payment_type = "cash";
            $payment->amount = $totalpayment;
            $payment->user_id = Auth::id();
            $payment->trip_id = $trip->id;
            if($coupon)
            {
                $payment->coupon_id = $coupon->id;
            }
            $payment->save();

            $book = new Booking();
            $book->payment_id = $payment->id;
            $book->user_id = Auth::id();
            $book->trip_id = $trip->id;
          //  $book->seats = $request->seats;
            if($request->translater != 'Choose a Translater if You Want!')
            {
                $book->translater_id = $translater->id;
                $translater->status = 'taken';
            }
            $book->save();

            $trip->seats_taken += $request->seats;
            $trip->save();
            if($coupon)
            {
            $coupon->status = 'used';
            $coupon->save();
            }
            return response()->json(['message','trip booked successfully please make sure you pay in our office in the next 2 days, amount of payment:'.$totalpayment]);
        }
        if($request->payment == "Syriatel Cash")
        {
            $payment = new Payment();
            $payment->payment_type = "syriatel_cash";
           // $payment->phone = $request->syrnumb;
            $payment->amount = $totalpayment;
            $payment->user_id = Auth::id();
            $payment->trip_id = $trip->id;
            if($coupon)
            {
                $payment->coupon_id = $coupon->id;
            }
            $payment->save();

            $book = new Booking();
            $book->payment_id = $payment->id;
            $book->user_id = Auth::id();
            $book->trip_id = $trip->id;
          //  $book->seats = $request->seats;
            if($request->translater != 'Choose a Translater if You Want!')
            {
                $book->translater_id = $translater->id;
                $translater->status = 'taken';
            }
            $book->save();

            $trip->seats_taken += $request->seats;
            if($trip->seats == $trip->seats_taken)
            {
                $trip->status = 'res_over';
            }
            $trip->save();

            if($coupon)
            {
            $coupon->status = 'used';
            $coupon->save();
            }

           // return response()->json(['message','trip booked successfully the booking will be confirmed as soon as we confirm the payment']);
           return view('pages.syriatelcash',compact('payment'));
        }
        if($request->payment == "MTN Cash")
        {
            $payment = new Payment();
            $payment->payment_type = "mtn_cash";
          //  $payment->phone = $request->mtnnumb;
            $payment->amount = $totalpayment;
            $payment->user_id = Auth::id();
            $payment->trip_id = $trip->id;
            if($coupon)
            {
                $payment->coupon_id = $coupon->id;
            }
            $payment->save();

            $book = new Booking();
            $book->payment_id = $payment->id;
            $book->user_id = Auth::id();
            $book->trip_id = $trip->id;
          //  $book->seats = $request->seats;
            if($request->translater != 'Choose a Translater if You Want!')
            {
                $book->translater_id = $translater->id;
                $translater->status = 'taken';
            }
            $book->save();

            $trip->seats_taken += $request->seats;
            if($trip->seats == $trip->seats_taken)
            {
                $trip->status = 'res_over';
            }
            $trip->save();

            if($coupon)
            {
            $coupon->status = 'used';
            $coupon->save();
            }
            
            //return response()->json(['message','trip booked successfully the booking will be confirmed as soon as we confirm the payment']);
            return view('pages.mtncash',compact('payment'));
        }

        // if($request->payment == "Credit Card")
        // {
        //     $payment = new Payment();
        //     $payment->payment_type = "credit_card";
        //   //  $payment->phone = $request->mtnnumb;
        //     $payment->amount = $totalpayment;
        //     $payment->user_id = Auth::id();
        //     $payment->trip_id = $trip->id;
        //     $payment->save();

        //     $book = new Booking();
        //     $book->payment_id = $payment->id;
        //     $book->user_id = Auth::id();
        //     $book->trip_id = $trip->id;
        //     $book->seats = $request->seats;
        //     if($request->translater != 'Choose a Translater if You Want!')
        //     {
        //         $book->translater_id = $translater->id;
        //         $translater->status = 'taken';
        //     }
        //     $book->save();

        //     $trip->seats_taken += $request->seats;
        //     if($trip->seats == $trip->seats_taken)
        //     {
        //         $trip->status = 'res_over';
        //     }
        //     $trip->save();

        //     // //return response()->json(['message','trip booked successfully the booking will be confirmed as soon as we confirm the payment']);
        //     // return view('pages.mtncash',compact('payment'));
        //     $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));


        //     $checkout_session = $stripe->checkout->sessions->create([
        //       'line_items' => [[
        //         'price_data' => [
        //           'currency' => 'usd',
        //           'product_data' => [
        //             'name' => 'T-shirt',
        //           ],
        //           'unit_amount' => 2000,
        //         ],
        //         'quantity' => 1,
        //       ]],
        //       'mode' => 'payment',
        //       'success_url' => 'http://127.0.0.1:8000/book/creditcard/success',
        //       'cancel_url' => 'http://127.0.0.1:8000/book/creditcard/cancel',
        //     ]);
            
        //     header("HTTP/1.1 303 See Other");
        //     header("Location: " . $checkout_session->url);

        // }

        return view('pages.pay',compact('totalpayment'));
    }
    
    public function mtncash(Request $request,Payment $payment)
    {
        $request->validate([
            'mtnnumb' => 'required'
        ]);

        $payment->phone = $request->mtnnumb;
        $payment->save();
        return response()->json(['message','trip booked successfully the booking will be confirmed as soon as we confirm the payment']);
    }

    public function syriatelcash(Request $request,Payment $payment)
    {
        $request->validate([
            'syrnumb' => 'required'
        ]);

        $payment->phone = $request->syrnumb;
        $payment->save();
        return response()->json(['message','trip booked successfully the booking will be confirmed as soon as we confirm the payment']);
    }

    // public function creditcard(Request $request,Payment $payment)
    // {
    //     $stripe = new \Stripe\StripeClient('sk_test_51O59JML9GmdzDG8x6tzGMrablEXq4TNnIIKJQAIY2GeJT0PRVyzOxve2MUbEQfnjfS7RgYiVoDiUp54VbntX6icb00K3c9eI8E');


    //     $checkout_session = $stripe->checkout->sessions->create([
    //       'line_items' => [[
    //         'price_data' => [
    //           'currency' => 'usd',
    //           'product_data' => [
    //             'name' => 'T-shirt',
    //           ],
    //           'unit_amount' => 2000,
    //         ],
    //         'quantity' => 1,
    //       ]],
    //       'mode' => 'payment',
    //       'success_url' => 'http://127.0.0.1:8000/book/creditcard/success',
    //       'cancel_url' => 'http://127.0.0.1:8000/book/creditcard/cancel',
    //     ]);
        
    //     header("HTTP/1.1 303 See Other");
    //     header("Location: " . $checkout_session->url);
        
    // }

    // public function success()
    // {
    //     return response()->json(['message','success']);
    // }

    // public function cancel()
    // {
    //     return response()->json(['message','cancel']);
    // }


  
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function confirm(Payment $payment)
    {
        $payment->status = 'confirmed';
        // $payment->updated_at = Carbon::now();
        $payment->save();
        return back();
    }

    public function refund(Payment $payment)
    {
        $payment->status = 'refunded';
        $payment->save();
        return back();
    }
    private function createcoupon()
    {
        $code = Str::random(8); 
        $coupon = Coupon::where('coupon_code', $code)->first();
    
        if ($coupon) {
            $this->createcoupon();
        }
    
        return $code;
    }
    public function attend(Booking $booking)
    {
       
        $booking->status = 'attended';
        $booking->save();

        $user = User::where('id',$booking->user_id)->first();
        $user->trips_attended+=1;
        $user->save();

        if($user->trips_attended % 5 == 0)
        {
            $coupon = new Coupon();
            $coupon->user_id = $user->id;
            $coupon->coupon_code = $this->createcoupon();
            $coupon->discount_percentage =  10.0;
            $coupon->expiry_date = Carbon::now()->addWeeks(3);
            $coupon->save();
        }

        return back();
    }
    public function allbooksdatatables(Request $request)
    {
        return view('dashboard.books.all'); 
    }
    public function getbooksdatatables(Request $request)
    {
        $books = Booking::all();
        return Datatables::of($books)
        ->addIndexColumn()
        ->addColumn('action',function($row){
            return $btn = '
            <form action="'.Route('dashboard.payment.confirm',$row->payment_id).'" method="POST">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <button type="submit">Confirm</button>
            </form>
            <form action="'.Route('dashboard.payment.refund',$row->payment_id).'" method="POST">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <button type="submit">Refund</button>
            </form>
            <form action="'.Route('dashboard.booking.attend',$row->id).'" method="POST">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <button type="submit">Attend</button>
            </form>';
        })
        ->addColumn('name',function($row){
            return $row->users->name;  
        })
        ->addColumn('trip_id',function($row){
            return $row->trips->id;  
        })
        ->addColumn('trip_name',function($row){
            return $row->trips->name;  
        })
        ->addColumn('trip_status',function($row){
            return $row->trips->status;  
        })
        ->addColumn('translater',function($row){
            return optional($row->translaters)->name;
        })
        ->addColumn('payment_amount',function($row){
            return $row->payments->amount;
        })
        ->addColumn('payment_status',function($row){
            return $row->payments->status;
        })
        ->rawColumns(['user_name','trip_name','trip_status','payment_id','payment_amount','payment_status','status','translater_name','action'])//,'action'
        ->make(true);
    }

    public function mostbookedtrips()
    {
        $mostBookedTrips = Trip::withCount('books')
            ->orderBy('books_count', 'desc')
            ->take(10)
            ->get();
        return view('dashboard.statistics.trips',compact('mostBookedTrips'));
    }
}
