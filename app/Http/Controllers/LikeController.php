<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Post;
use App\Models\Like;
use App\Models\Album;
class LikeController extends Controller
{
    public function likestore(Post $post)
    {
        $like = Like::where('post_id',$post->id)->where('user_id',Auth::id())->first();
        if(!$like)
        {
            Like::create([
                'user_id' => Auth::id(),
                'post_id'=>$post->id,
                'like_status' => 1
            ]);
        }
        elseif($like->like_status == 1)
        {
            $like->delete();
        }
        else
        {
            $like->update([
                'like_status' => '1'
            ]);
        }
        return back();
    }
    public function dislikestore(Post $post)
    {
        $like = Like::where('post_id',$post->id)->where('user_id',Auth::id())->first();
        if(!$like)
        {
            Like::create([
                'user_id' => Auth::id(),
                'post_id'=>$post->id,
                'like_status' => 0
            ]);
        }
        elseif($like->like_status == 0)
        {
            $like->delete();
        }
        else
        {
            $like->update([
                'like_status' => '0'
            ]);
        }
        return back();
    }

    public function likealbumstore(Album $album)
    {
        $like = Like::where('album_id',$album->id)->where('user_id',Auth::id())->first();
        if(!$like)
        {
            Like::create([
                'user_id' => Auth::id(),
                'album_id'=>$album->id,
                'like_status' => 1
            ]);
        }
        elseif($like->like_status == 1)
        {
            $like->delete();
        }
        else
        {
            $like->update([
                'like_status' => '1'
            ]);
        }
        return back();
    }
    public function dislikealbumstore(Album $album)
    {
        $like = Like::where('album_id',$album->id)->where('user_id',Auth::id())->first();
        if(!$like)
        {
            Like::create([
                'user_id' => Auth::id(),
                'album_id'=>$album->id,
                'like_status' => 0
            ]);
        }
        elseif($like->like_status == 0)
        {
            $like->delete();
        }
        else
        {
            $like->update([
                'like_status' => '0'
            ]);
        }
        return back();
    }
}
