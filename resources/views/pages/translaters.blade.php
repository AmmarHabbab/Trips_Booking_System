@extends('pages.master')
 
@section('content')
    

<!-- Posts Section -->
<section class="w-full md:w-2/3 flex flex-col items-center px-3">

  
   <div class="row">
    <div class="col-md-6">
        <h4>Translaters</h4>
    </div>
    <div class="col-md-6 text-right">
        <form action="/translater/search" method="get">
            <div class="input-group">
                <input type="search" name="search" class="form-control" placeholder="Search Translaters...">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary">Search</button>
                </span>
            </div>
        </form>
    </div>
</div>
@foreach ($translaters as $translater)
   <article class="flex flex-col shadow my-4">
       <!-- Article Image -->
       <a href="#" class="hover:opacity-75">
           <img src="{{$translater->image}}">
       </a>
       <div class="bg-white flex flex-col justify-start p-6">
           <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">{{$translater->name}}</a>
           <a href="#" class="pb-6">{{$translater->gender}}</a>
           <a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4">{{$translater->languages_spoken}}</a>
           <a href="#" class="pb-6">{{$translater->info}}</a>
       </div>
   </article>

   @endforeach
   <!-- Pagination -->
   <div class="flex items-center py-8">
       <a href="#" class="h-10 w-10 bg-blue-800 hover:bg-blue-600 font-semibold text-white text-sm flex items-center justify-center">1</a>
       <a href="#" class="h-10 w-10 font-semibold text-gray-800 hover:bg-blue-600 hover:text-white text-sm flex items-center justify-center">2</a>
       <a href="#" class="h-10 w-10 font-semibold text-gray-800 hover:text-gray-900 text-sm flex items-center justify-center ml-3">Next <i class="fas fa-arrow-right ml-2"></i></a>
   </div>

</section>

@endsection