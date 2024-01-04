@extends('pages.master')

@section('content')

@if ((Auth::check() && Auth::id() == $post->user_id) || (Auth::check() && auth()->user->role == 'admin'))
<button><a href="/dashboard/posts/edit/{{$post->slug}}">Edit Post</a></button>
<form method="POST" action="/dashboard/posts/delete/{{$post->slug}}">
    @csrf
    @method('DELETE')
    <input type="submit" value="Delete Post"/>
</form>
@endif

        <!-- Post Section -->
        <section class="w-full md:w-2/3 flex flex-col items-center px-3">

            <article class="flex flex-col shadow my-4">
                <!-- Article Image -->
                <a href="#" class="hover:opacity-75">
                    <img src="{{$post->image}}">
                </a>
                <div class="bg-white flex flex-col justify-start p-6">
                    <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">{{$post->category->name}}</a>
                    <a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4">{{$post->title}}</a>
                    <p href="#" class="text-sm pb-8">
                        By <a href="#" class="font-semibold hover:text-gray-800">{{$post->user->name}}</a>, Published on {{$post->created_at}}
                    </p>
                    <p class="pb-3">{{$post->content}}</p>
                </div>
            </article>

            @if(Auth::check())
            <form method="POST" action="/like/{{$post->id}}">
                @csrf
            <input type="submit" value="Like Post {{$like_count}}">
            </form>
            <br>
            <form method="POST" action="/dislike/{{$post->id}}">
                @csrf
            <input type="submit" value="DisLike Post {{$dislike_count}}">
            </form>

            <form method="POST" action="/comments/store/{{$post->id}}">
                @csrf
            <textarea placeholder="Enter Comment" name="body"></textarea><br>
            <input type="submit">
            </form>
            @else
            <h1>Please Login to Comment or Like!</h1>
            @endif

@foreach ($comments as $comment)
    <h1>by {{$comment->users->name}}</h1>
    <p>{{$comment->body}}</p>
@endforeach
        </section>

@endsection