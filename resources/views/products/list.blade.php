@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10 px-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">All Products</h1>

        {{-- Create Product Button --}}
        <a href="{{ route('me.products.create') }}"
           class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-500 transition">
            + Create Product
        </a>
    </div>

    <div class="grid md:grid-cols-3 gap-8">

        @foreach($products as $product)
        <div class="bg-white shadow rounded-lg p-5 text-center">
            <img src="{{ $product->images->first()->image_path ?? '/placeholder.jpg' }}" 
                 class="mx-auto mb-3 h-40 object-cover rounded">
            <h2 class="text-lg font-semibold mb-2">{{ $product->title }}</h2>
            <p class="text-indigo-600 font-bold">${{ $product->price }}</p>
        </div>
        @endforeach

    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
</div>
@endsection
