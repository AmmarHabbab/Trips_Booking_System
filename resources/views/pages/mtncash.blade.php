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
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="/book/payment/mtncash/{{$payment->id}}" enctype="multipart/form-data">
            @csrf

            {{-- <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                    Choose Payment Currency
                </label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="cur" name="currency">
                    <option value="SY">SY</option> 
                    <option value="USD">USD</option>     
                </select>
            </div> --}}
                <div id="additional-inputs2" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                            Send {{$payment->amount}} using mtn cash To this number : 0951905231 Then Enter the phone number you used to send the money
                        </label><br>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="image">Phone number</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" placeholder="Enter your number" name="mtnnumb">
                    </div>
                </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Submit
                </button>
            </div>
        </form>
    </div>
   
</body>
</html>