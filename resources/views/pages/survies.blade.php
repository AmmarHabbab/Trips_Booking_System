@extends('pages.master')
 
@section('content')
    

<!-- Posts Section -->
<section class="w-full md:w-2/3 flex flex-col items-center px-3">

   @foreach ($survies as $survey)
       
   <article class="flex flex-col shadow my-4">
       <!-- Article Image -->
       <div class="bg-white flex flex-col justify-start p-6">
         
           <a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4">{{$survey->name}}</a>
           <a href="#" class="pb-6">{{$survey->desc}}</a>
           <a href="/survies/{{$survey->name}}" class="uppercase text-gray-800 hover:text-black">Participate in Survey<i class="fas fa-arrow-right"></i></a>
       </div>
   </article>

   @endforeach


</section>

@endsection