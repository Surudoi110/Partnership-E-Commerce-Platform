@extends('layouts.app')

@section('content')
<div class="container">

    <h2>{{ $product->title }}</h2>

    <div class="row mt-4">
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $product->images->first()?->image_path ?? 'default.png') }}"
                 class="img-fluid rounded">
        </div>

        <div class="col-md-6">
            <h4>Rp {{ number_format($product->price) }}</h4>
            <p>{{ $product->description }}</p>
            <p><b>Stock:</b> {{ $product->quantity }}</p>

            <form method="POST" action="{{ route('cart.add', $product->id) }}">
                @csrf
                <button class="btn btn-success">Add to Cart</button>
            </form>

            @if (auth()->id() == $product->seller_id)
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning mt-3">Edit</a>

                <form action="{{ route('products.delete', $product->id) }}" method="POST" class="mt-2">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Delete</button>
                </form>
            @endif
        </div>
    </div>

</div>
@endsection
