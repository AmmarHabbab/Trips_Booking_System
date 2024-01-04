@extends('pages.master')
 
@section('content')
    

<!-- Posts Section -->
<section class="w-full md:w-2/3 flex flex-col items-center px-3">

       
   <article class="flex flex-col shadow my-4">
       <!-- Article Image -->
       
       <div class="bg-white flex flex-col justify-start p-6">
        <a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4">{{$album->name}}</a>
        
    </div>
       <p href="#" class="text-sm pb-3">
        By <a href="#" class="font-semibold hover:text-gray-800">{{$album->user->name}}</a>, Published on {{$album->created_at}}
      </p>
      @foreach ($photos as $photo)
       <a href="{{$photo->path}}" class="hover:opacity-75">
           <img src="{{$photo->path}}"><br>
       </a>
       @endforeach
       
   </article>

   @if(Auth::check())
   <form method="POST" action="/likealbum/{{$album->id}}">
       @csrf
   <input type="submit" value="Like album {{$like_count}}">
   </form>
   <br>
   <form method="POST" action="/dislikealbum/{{$album->id}}">
       @csrf
   <input type="submit" value="DisLike Album {{$dislike_count}}">
   </form>

   {{-- <form method="POST" action="/comments/store/{{$post->id}}">
       @csrf
   <textarea placeholder="Enter Comment" name="body"></textarea><br>
   <input type="submit">
   </form> --}}
   @else
   <h1>Please Login to Like!</h1>
   @endif


   <!-- Pagination -->
   <div class="flex items-center py-8">
       <a href="#" class="h-10 w-10 bg-blue-800 hover:bg-blue-600 font-semibold text-white text-sm flex items-center justify-center">1</a>
       <a href="#" class="h-10 w-10 font-semibold text-gray-800 hover:bg-blue-600 hover:text-white text-sm flex items-center justify-center">2</a>
       <a href="#" class="h-10 w-10 font-semibold text-gray-800 hover:text-gray-900 text-sm flex items-center justify-center ml-3">Next <i class="fas fa-arrow-right ml-2"></i></a>
   </div>

</section>

@endsection