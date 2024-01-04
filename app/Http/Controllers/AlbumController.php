<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Trip;
use App\Models\Photo;
use Auth;
use Str;
use Illuminate\Support\Facades\File;
class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = Album::all();
        return view('pages.albums',compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.albums.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,svg,gif|max:4096'
        ]);

        $img = $request->file('image');
        $imgname = Str::uuid() . $img->getClientOriginalName();
        $img->move(public_path('images'),$imgname);
        $path = '/images/' .$imgname;

        $album = new Album();
        $album->name = $request->name;
        $album->desc = $request->desc;
        $album->image = $path;
        $album->user_id = Auth::id();

        if($request->tripname != "Select A trip")
        {
            $trip = Trip::where('name',$request->tripname)->first();
            $album->trip_id = $trip->id;
        }
        
        $album->save();
        
        File::makeDirectory(public_path('albums/'.$request->name));
        return response()->json(['message'=>'saved successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        $like_count = 0;
        $dislike_count = 0;
        foreach($album->likes as $like){
            if($like->like_status == 1)
                $like_count++;
            if($like->like_status == 0)
                $dislike_count++;
        }
        $photos = Photo::where('album_id',$album->id)->get();
        return view('pages.album',compact('photos','album','like_count','dislike_count'));
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

    public function likeschart()
    {
        $mostLikedAlbums = Album::withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->take(2)
            ->get();
        return view('dashboard.statistics.albums',compact('mostLikedAlbums'));
    }
}
