<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Post Entry Form</title>
</head>
<body class="bg-gray-100">
    <div class="w-full max-w-md mx-auto mt-10">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="/book/{{$trip->id}}/payment" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                    {{__('words.trip-price')}}
                </label>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image" id="tpps">
                    Trip Price:{{$trip->price}}
                </label>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image" id="tpps">
                    Trip Available Seats:{{$available_seats}}
                </label>
            </div>
            {{-- <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image"> --}}
                    {{-- Number of Wanted: {{__('words.seats entry')}}
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="sea" type="text" placeholder="Enter The amount of seats u want to book" name="seats" required>
            </div> --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                    Choose if you want a translater with you:
                </label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="category" name="translater">
                    <option>Choose a Translater if You Want!</option> 
                    @foreach($translaters as $translater)
                    <option>{{$translater->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                    Choose How To Pay
                </label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="type" name="payment">
                    <option>Cash</option>
                    <option>Syriatel Cash</option>
                    <option>MTN Cash</option>
                    <!-- <option>Credit Card</option> -->
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                    Enter a Coupon you have If You Want!
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="sea" type="text" placeholder="Enter The amount of seats u want to book" name="coupon">
            </div>
            {{-- <div id="additional-inputs" style="display: none;" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="image" id="syn">
                        Send {{$trip->pricesy}}SY To this Number 0934558864 Then Enter the phone number used to send the money
                    </label><br>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="image">Phone number</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" placeholder="Enter your number" name="syrnumb">
                </div>
            </div>
                <div id="additional-inputs2" style="display: none;" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                            Send {{$trip->pricesy}}SY To this Number 0951905231 Then Enter the phone number used to send the money
                        </label><br>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="image">Phone number</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" placeholder="Enter your number" name="mtnnumb">
                    </div>
                </div> --}}
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Submit
                </button>
            </div>
        </form>
    </div>
   
    <script type="text/javascript">
        
        // document.getElementById('sea').addEventListener('change',function(){
        //   var x =  document.getElementById('cur').value; // value cuz its a dropdown :)
    //     if(x === 'SY')
    //     {
    //         var tpps = document.getElementById('tpps').innerHTML;
    //         var price = this.value*tpps;
    //         document.getElementById('syn').innerHTML= 'Send '+price+'SY To this Number 0934558864 Then Enter the phone number used to send the money';
    //     }
    //    else
    //    {
    //         var tppss = document.getElementById('tppss').innerHTML;
    //         var price = this.value*tppss;
    //         document.getElementById('syn').innerHTML= 'Send '+price+'USD To this Number 0934558864 Then Enter the phone number used to send the money';
    //    }
    //     });
        
    //     document.getElementById('type').addEventListener('change', function() {
    // // var additionalInputs = document.getElementById('additional-inputs');
    // // var additionalInputs2 = document.getElementById('additional-inputs2');

    // if (this.value === 'Syriatel Cash') 
    // {   
    //     additionalInputs.style.display = 'block';
    //     additionalInputs2.style.display = 'none';
    // }
    // else if (this.value === 'MTN Cash')
    // {
    //     additionalInputs2.style.display = 'block';
    //     additionalInputs.style.display = 'none';    
    // }
    // else
    // {
    //     additionalInputs.style.display = 'none';
    //     additionalInputs2.style.display = 'none';
    // }
    //     });
    </script>
</body>
</html>