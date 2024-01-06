<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Str;
use App\Models\CategoryTranslation;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    //    $categories = Category::all();
    //    return response()->json($categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate = [
            'name' => 'required',
            'desc' => 'requiree',
            'image' => 'required|mimes:jpg,jpeg,png|max:4096'
        ];

        $img = $request->file('image');
        $imgname = Str::uuid() . $img->getClientOriginalName();
        $img->move(public_path('images'),$imgname);
        $path = '/images/' .$imgname;

        $category=new Category();
        $category->image = $path;
        $category->name = $request->name;
        $category->desc = $request->desc;
        $category->user_id = Auth::id();
        $category->save();


        return response()->json(['message','Saved Successfuly']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $posts = Post::where('category_id',$category->id)->get();
        return view('pages.postscategories',compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $name)
    {
        $request->validate = [
            'name' => 'required',
            'desc' => 'requiree',
            'image' => 'mimes:jpg,jpeg,png|max:4096'
        ];

         
        if($request->file('image'))
        {
            $img = $request->file('image');
           $imgname = Str::uuid() . $img->getClientOriginalName();
            $img->move(public_path('images'),$imgname);
           $path = '/images/' .$imgname;

        Category::where('name',$name)
        ->update([
            'name' => $request->name,
            'desc' => $request->desc,
            'image' => $path
        ]);
        return redirect('/dashboard');

        }
        else
        {
            Category::where('name',$name)
            ->update([
            'name' => $request->name,
            'desc' => $request->desc,
        ]);
        return redirect('/dashboard');
        }
        
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['message' => 'Category Deleted Successfully']);
    }

    public function allcategoriesdatatables(Request $request)
    {
        return view('dashboard.categories.all'); 
    }
    public function getcategoriesdatatables(Request $request)
    {
       // return Datatables::of(Category::query())->make(true);
       $categories = Category::all();
        return Datatables::of($categories)
        ->addIndexColumn()
        ->addColumn('action',function($row){
            return $btn = '
            <form action="'.Route('dashboard.categories.delete',$row->name).'" method="POST">
            <button><a href="'.Route('dashboard.categories.edit',$row->name).'">Edit</a></.button>
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <button type="submit">Delete</button>
            </form>';
        })
        ->addColumn('user_name',function($row){
            return $row->users->name;
        })
        ->rawColumns(['name','desc','user_name','created_at','updated_at','action'])
        ->make(true);
    }
}
