@extends('pages.master')
 
@section('content')
    

<!-- Posts Section -->
<div class="bg-white flex flex-col justify-start p-6">
         
    <label class="text-3xl font-bold hover:text-gray-700 pb-4">Survey Name:{{$survey->name}}</label>
    <label class="text-3xl font-bold hover:text-gray-700 pb-4">Survey Description:{{$survey->desc}}</label>
</div>

<section class="w-full md:w-2/3 flex flex-col items-center px-3">

   @foreach ($surveydata as $surveydat)
       
   <article class="flex flex-col shadow my-4">
       <!-- Article Image -->
       <div class="bg-white flex flex-col justify-start p-6">
           <a href="#" class="pb-6">User:{{$surveydat->users->name}}</a>
           <a href="#" class="pb-6">Opinion:{{$surveydat->opinion}}</a>
       </div>
   </article>

   @endforeach


</section>

@endsection