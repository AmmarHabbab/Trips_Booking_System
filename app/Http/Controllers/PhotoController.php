<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Photo;
use Auth;
use Str;
class PhotoController extends Controller
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
        $albums = Album::all();
        return view('dashboard.photos.create',compact('albums'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg', //max:4096 or 2048
            'albumname' => 'required'
        ]);

        $album = Album::where('name',$request->albumname)->first();
       // dd($request->images);
       // 
       //if($request->hasFile('images'))
       if($request->file('images'))
        {
           $images = $request->file('images');
            foreach($images as $image)
            {
                $imgname = Str::uuid() . $image->getClientOriginalName();
                $image->move(public_path('albums/'.$request->albumname),$imgname);
                $path = '/albums/'.$request->albumname.'/'.$imgname;
                $photo = New Photo();
                $photo->path = $path;
                $photo->album_id = $album->id;
                $photo->user_id = Auth::id();
                $photo->save();
            }
        }
       // return back()->with('success','Images have been stored successfully');
        return response()->json(['message','Saved Successfuly']);
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
}
