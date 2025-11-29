@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <section class="bg-indigo-600 text-white py-20 text-center">
        <h2 class="text-4xl font-bold mb-4">Grow Together, Sell Together</h2>
        <p class="text-lg mb-6">A platform where businesses collaborate and reach more customers.</p>
        <a href="/products" class="px-6 py-3 bg-white text-indigo-600 font-semibold rounded-lg hover:bg-gray-100">Explore Products</a>
        <!-- <a href="/partners" class="ml-3 px-6 py-3 border border-white rounded-lg hover:bg-indigo-500">Become a Partner</a> -->
    </section>

    

    <!-- Featured Products -->
    <section class="container mx-auto py-16 px-6">
    <h3 class="text-3xl font-bold mb-8 text-center">Featured Products</h3>

    <div class="grid md:grid-cols-3 gap-8">
        @foreach ($products as $product)
            <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                @if ($product->images->count() > 0)
                    <img src="{{ asset('images/organicCoffeeBeans.jpg') }}"
                         alt="Organic Coffee Beans"
                         class="mx-auto mb-4 rounded-md">
                @else
                    <img src="https://via.placeholder.com/150"
                         class="mx-auto mb-4 rounded-md">
                @endif

                {{-- Title --}}
                <h4 class="text-xl font-semibold mb-2">{{ $product->title }}</h4>

                {{-- Description --}}
                <p class="text-gray-600 mb-3">{{ Str::limit($product->description, 70) }}</p>

                {{-- Price --}}
                <p class="text-indigo-600 font-bold mb-4">${{ number_format($product->price, 2) }}</p>

                {{-- View Product --}}
                <a href="{{ route('products.show', $product->id) }}"
                   class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-500">
                    View Product
                </a>
            </div>
        @endforeach
    </div>
</section>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Call to Action -->
    <section class="bg-indigo-100 py-16 text-center">
        <h3 class="text-3xl font-bold mb-4">Contact Us</h3>
        <p class="text-lg mb-6">Are you a local business or NGO looking to expand your reach? Join our partnership program and grow together.</p>
        <a href="/partners" class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-500">Become a Partner</a>
    </section>
@endsection
