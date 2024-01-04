<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;
use Auth;
use Yajra\DataTables\Facades\DataTables;
class SuggestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suggestions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'sug' => 'required',
        ]);

        Suggestion::create([
            'type' => $request->type,
            'body' => $request->sug,
            'user_id' => Auth::id()
        ]);

        return response()->json(['message','saved successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Suggestion $suggestion)
    {
        return view('dashboard.suggestions.suggestion',compact('suggestion'));
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

    public function allsuggestionsdatatables(Request $request)
    {
        return view('dashboard.suggestions.all'); 
    }
    public function getsuggestionsdatatables(Request $request)
    {
        return Datatables::of(Suggestion::query())->make(true);
    }

    
}
