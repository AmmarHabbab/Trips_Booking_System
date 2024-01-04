<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Translater;
use Yajra\DataTables\Facades\DataTables;
use Str;
class TranslaterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $translaters = Translater::all();
        return view('pages.translaters',compact('translaters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.translaters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,gif,svg|max:4096',
            'info' => 'required',
            'gender' => 'required',
            'languages_spoken' => 'required'
        ]);

        $img = $request->file('image');
        $imgname = Str::uuid() . $img->getClientOriginalName();
        $img->move(public_path('translaters'),$imgname);
        $path = '/translaters/' .$imgname;

        $translater = new Translater();
        $translater->name = $request->name;
        $translater->image = $path;
        $translater->info = $request->info;
        $translater->gender = $request->gender;
        $translater->languages_spoken = $request->languages_spoken;
        $translater->save();

        return response()->json(['message','saved successfuly']);
    }

    public function search(Request $request)
{
    $search = $request->search;
    $translaters = Translater::query()
      //  ->where('status','=','available')
        ->where('name', 'LIKE', "%{$search}%")
        ->orWhere('languages_spoken', 'LIKE', "%{$search}%")
        ->orWhere('info', 'LIKE', "%{$search}%")
        ->orWhere('status', 'LIKE', "%{$search}%")
        ->get();
        
        return view('pages.translaters', compact('translaters'));
}
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
    public function update(Translater $translater)
    {
        $translater->status = 'unavailable';
        $translater->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Translater $translater)
    {
        $translater->delete();
        return back();
    }

    public function alltranslatersdatatables(Request $request)
    {
        return view('dashboard.translaters.all'); 
    }
    public function gettranslatersdatatables(Request $request)
    {
        $translaters = Translater::all();
        return Datatables::of($translaters)
        ->addIndexColumn()
        ->addColumn('action',function($row)
        {
            return $btn = '
            <form action="'.Route('dashboard.translaters.destroy',$row->id).'" method="POST">
            <button type="submit">Delete User</button>
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="' . csrf_token() .'">
            </form>
            <form action="'.Route('dashboard.translaters.update',$row->id).'" method="POST">
            <button type="submit">Change Status to unavailable</button>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="' . csrf_token() .'">
            </form>
            ';
        })
        ->rawColumns(['name','info','gender','languages_spoken','status','action'])
        ->make(true);
    }
}
