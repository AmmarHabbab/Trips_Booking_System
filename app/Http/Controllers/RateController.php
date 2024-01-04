<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rate;
use App\Models\Trip;
use Auth;
use Yajra\DataTables\Facades\DataTables;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rates = Rate::where('approved',1);
        return response()->json($rates);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       // $rate = Rate::where('')
    //    if(Auth::id() == 1)
       // $trips = Trip::where('user_id',Auth::id())->get();
        return view('pages.createrate'); //,compact('trips')
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // General Rating
        $request->validate([
            'stars' => 'required',
            'body' => 'required',
            'tripname' => 'required'
        ]);

        $rate = new Rate();
        $rate->stars = $request->stars;
        $rate->body = $request->body;
        if($request->tripname != "General Rating")
        {
            $trip = Trip::where('name',$request->tripname)->first();
            $rate->trip_id = $trip->id;
        }
        $rate->user_id = Auth::id();
        $rate->approved = 0;
        $rate->save();

        return response()->json(['message','saved successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show($trip)
    {
        $rate = Rate::where('trip_id',$trip->id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Rate $rate)
    {
        $rate->update([
            'approved' => 1
        ]);
        return back()->with('message','updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rate $rate)
    {
        $rate->delete();
        return back()->with('message','deleted successfully');
    }

    public function allratesdatatables(Request $request)
    {
        return view('dashboard.rates.all'); 
    }
    public function getratesdatatables(Request $request)
    {
        return Datatables::of(Rate::query())->make(true);
    }
}
