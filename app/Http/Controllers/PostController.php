<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Str;
use Auth;
use Yajra\DataTables\Facades\DataTables;
use ConsoleTVs\Charts\Facades\Charts;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
       // $posts = Post::all()->orderBy('created_at','desc');
        $posts = Post::query()
        ->orderBy('created_at','desc')
        ->paginate(5);
        //dd($posts);
        return view('pages.posts',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'categoryname' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png|max:4096',
        ]);

        $img = $request->file('image');
        $imgname = Str::uuid() . $img->getClientOriginalName();
        $img->move(public_path('images'),$imgname);
        $path = '/images/' .$imgname;

        $category = Category::where('name',$request->categoryname)->get();
        $category_id = $category[0]->id;

        $slug = Str::slug($request->title);
        $post = new Post();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->content = $request->content;
        $post->image = $path;
        $post->user_id = Auth::id();
        $post->category_id = $category_id;
        $post->slug = $slug;
        $post->save();
        

        return response()->json(['message','Saved Successfuly']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $like_count = 0;
        $dislike_count = 0;
        foreach($post->likes as $like){
            if($like->like_status == 1)
                $like_count++;
            if($like->like_status == 0)
                $dislike_count++;
        }
        
        $comments = Comment::where('post_id',$post->id)->get();
        return view('pages.post',compact('post','comments','like_count','dislike_count'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('dashboard.posts.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Post $post)
    {
        
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'categoryname' => 'required',
            'image' => 'mimes:jpg,jpeg,png|max:4096',
        ]);
        
        $category = Category::where('name',$request->categoryname)->get();
        $category_id = $category[0]->id;


        $slug = Str::slug($request->title);
        
        if($request->file('image'))
        {
        $img = $request->file('image');
        $imgname = Str::uuid() . $img->getClientOriginalName();
        $img->move(public_path('images'),$imgname);
        $path = '/images/' .$imgname;

        Post::where('slug',$post->slug)->update([
            'title' => $request->title,
            'slug' => $slug,
            'content'=> $request->content,
            'category_id' => $category_id,
            'image' => $path,
        ]);

        return redirect('/dashboard/posts/all');
        }
        else{
        
        
        Post::where('slug',$post->slug)->update([
            'title' => $request->title,
            'slug' => $slug,
            'content'=> $request->content,
            'category_id' => $category_id,
        ]);

        // $slug = Str::slug($request->title);
        // $post->title = $request->title;
        // $post->slug = $slug;
        // $post->content = $request->content;
        // $post->category_id = $category_id;
        // $post->slug = $slug;
        // $post->update();
        
        return redirect('/dashboard/posts/all');
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(['message','Post is Deleted Successfuly']);
    }
    
    public function allpostdatatables(Request $request)
    {
        return view('dashboard.posts.all'); 
    }
    public function getpostsdatatables(Request $request)
    {
        $posts = Post::all();
        return Datatables::of($posts)
        ->addIndexColumn()
        ->addColumn('action',function($row){
            return $btn = '
            <form action="'.Route('dashboard.posts.delete',$row->slug).'" method="POST">
            <button><a href="'.Route('dashboard.posts.edit',$row->slug).'">Edit</a></.button>
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <button type="submit">Delete</button>
            </form>';
        })
        ->addColumn('category',function($row){
            return $row->category->name;
        })
        ->rawColumns(['title','category','created_at','updated_at','action'])
        ->make(true);
    }

    public function likeschart()
    {
        $mostLikedPosts = Post::withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->take(2)
            ->get();
        return view('dashboard.statistics.likes',compact('mostLikedPosts'));
    }

    public function commentschart()
    {
        $mostCommentedPosts = Post::withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->take(2)
            ->get();
        return view('dashboard.statistics.comments',compact('mostCommentedPosts'));
    }
}
