 @extends('pages.master')
 
 @section('content')
     

 <!-- Posts Section -->
 <section class="w-full md:w-2/3 flex flex-col items-center px-3">

    @foreach ($trips as $trip)
        
    <article class="flex flex-col shadow my-4">
        <!-- Article Image -->
        <a href="#" class="hover:opacity-75">
            <img src="{{$trip->image}}">
        </a>
        <div class="bg-white flex flex-col justify-start p-6">
            <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">{{$trip->area}}</a>
            <a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4">{{$trip->name}}</a>
            <a href="#" class="pb-6">{{$trip->info}}</a>
            <a href="/trips/{{$trip->id}}" class="uppercase text-gray-800 hover:text-black">Trip Full Info!<i class="fas fa-arrow-right"></i></a>
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