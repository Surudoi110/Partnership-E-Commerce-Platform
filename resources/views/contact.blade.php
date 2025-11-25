@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto px-4 py-12">

    <h1 class="text-4xl font-bold mb-4">Contact Us</h1>

    <p class="text-gray-700 mb-6">
        Have a question, suggestion, or problem?  
        We're here to help!
    </p>

    <form action="#" method="POST" class="space-y-5">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1">Your Name</label>
            <input type="text" class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Message</label>
            <textarea rows="5" class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200"></textarea>
        </div>

        <button class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            Send Message
        </button>
    </form>

    <div class="mt-10 text-gray-600">
        <p><strong>Email:</strong> support@marketplace.com</p>
        <p><strong>Phone:</strong> +62 812-3456-7890</p>
    </div>

</div>
@endsection
