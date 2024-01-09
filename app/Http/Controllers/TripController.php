<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Str;
use App\Models\Trip;
use App\Models\Payment;
use App\Models\Translater;
use App\Models\Coupon;
use App\Models\Booking;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // $trips = Trip::where('status','res_open')->get();
       $trips = Trip::all();
        return view('pages.trips',compact('trips'));
    }

    public function show(Trip $trip)
    {
        $available_seats = $trip->seats - $trip->seats_taken;
        return view('pages.trip',compact('trip','available_seats'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $translaters = Translater::where('status','available')->get();
        return view('dashboard.trips.create',compact('translaters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'info' => 'required',
            'image' => 'required|mimes:jpeg,jpg,gif,svg,png|max:4096',
            'area' => 'required',
            'seats' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $img = $request->file('image');
        $imgname = Str::uuid() . $img->getClientOriginalName();
        $img->move(public_path('images'),$imgname);
        $path = '/images/' .$imgname;

        $trip = new Trip();
        $trip->name = $request->name;
        $trip->info = $request->info;
        if($request->type != 'Choose a Trip Type if there is:')
        {
            $trip->type = $request->type;
        }
        $trip->image = $path;
        $trip->area = $request->area;
        $trip->seats = $request->seats;
        $trip->price = $request->price;
        // if($request->translatername != "Select A translater if Need one!")
        // {
            
        // }
        $trip->start_date = $request->start_date;
        $trip->expiry_date = $request->expiry_date;
        $trip->save();

        return response()->json(['message','trip created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function createagain(Trip $trip)
    {
        return view('dashboard.trips.createagain',compact('trip'));
    }

    public function storeagain(Request $request,Trip $trip)
    {
        $request->validate([
            'name' => 'required',
            'info' => 'required',
            'image' => 'mimes:jpeg,jpg,gif,svg,jfif,png|max:4096',
            'area' => 'required',
            'seats' => 'required|numeric',
            'priceusd' => 'required|numeric',
            'pricesy' => 'required|numeric',
        ]);

        $newtrip = new Trip();

        if($request->file('image')){
        $img = $request->file('image');
        $imgname = Str::uuid() . $img->getClientOriginalName();
        $img->move(public_path('images'),$imgname);
        $path = '/images/' .$imgname;
        $newtrip->image = $path;
        }

        $newtrip->name = $request->name;
        $newtrip->info = $request->info;
        if($request->type != 'Choose a Trip Type if there is:')
        {
            $trip->type = $request->type;
        }
        $newtrip->area = $request->area;
        $newtrip->seats = $request->seats;
        $newtrip->priceusd = $request->priceusd;
        $newtrip->pricesy = $request->pricesy;
        // if($request->translatername != "Select A translater if Need one!")
        // {
            
        // }
        $newtrip->start_date = $request->start_date;
        $newtrip->expiry_date = $request->expiry_date;
        $newtrip->image = $trip->image;
        $newtrip->save();

        return response()->json(['message','trip created successfully']);
    }

    public function cancel(Trip $trip)
    {
        $trip->status = 'canceled';
        $trip->save();
        $bookings = Booking::where('trip_id',$trip->id)->get();
        $payment = Payment::where('trip_id',$trip->id)->get();
        foreach($payment as $pay)
        {
            if($pay->coupon_id != null)
            {
                $coupon = Coupon::where('id',$pay->coupon_id)->first();
                $coupon->status = 'unused';
                $coupon->save();
            }
            if($pay->status == 'confirmed')
            {
            $pay->status = 'refund';
            $pay->save();
            }
            
        }
        foreach($bookings as $booking)
        {
            if($booking->translater_id)
            {
                $translater = Translater::where('id',$booking->translater_id)->first();
                $translater->status = 'available';
                $translater->save();
            }
            
            $booking->status = 'canceled';
            $booking->save();
        }
        return response()->json(['message','trip canceled successfully']);
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

    public function alltripsdatatables(Request $request)
    {
        return view('dashboard.trips.all'); 
    }
    public function gettripsdatatables(Request $request)
    {
        $trips = Trip::all();
        return Datatables::of($trips)
        ->addIndexColumn()
        ->addColumn('action',function($row){
            return $btn = '
            <form action="'.Route('dashboard.trips.cancel',$row->id).'" method="POST">
            <button><a href="'.Route('dashboard.trips.createagain',$row->id).'">Create Again</a></button>
            <button type="submit">Cancel Trip</button>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            </form>';
        })
        ->rawColumns(['name','info','area','seats','seats_taken','status','price','start_date','expiry_date','action']) //,'action'
        ->make(true);
    }

    public function openedalltripsdatatables()
    {
        return view('dashboard.trips.trip'); 
    }
    public function openedgettripsdatatables()
    {
        $trips = Trip::where('status','res_open')
        ->orWhere('status','res_over')
        ->get();

        return Datatables::of($trips)
        ->addIndexColumn()
        ->addColumn('action',function($row){
            return $btn = '
            <button><a href="'.route('dashboard.books.trip',$row->id).'">Show Bookings</a></button>';
        })
        ->rawColumns(['name','info','area','seats','seats_taken','status','price','start_date','expiry_date','action']) //,'action'
        ->make(true);
    }

    
}
