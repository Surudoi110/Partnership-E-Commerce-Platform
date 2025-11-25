@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="container mx-auto p-6">

    <h1 class="text-3xl font-bold mb-4">Products</h1>

    <div class="grid md:grid-cols-3 gap-6">
        @foreach($products as $product)
            <a href="{{ route('products.show', $product->id) }}" 
               class="block bg-white p-4 rounded-lg shadow hover:shadow-lg transition">
               
                <h2 class="text-xl font-bold">{{ $product->name }}</h2>
                <p class="text-gray-600">{{ Str::limit($product->description, 60) }}</p>
                <p class="mt-2 text-indigo-600 font-bold">${{ $product->price }}</p>
            </a>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>

</div>
@endsection
