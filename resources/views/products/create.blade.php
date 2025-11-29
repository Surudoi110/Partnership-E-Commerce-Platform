@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10 px-6 max-w-3xl">

    <h1 class="text-3xl font-bold mb-8">Create New Product</h1>

    {{-- Error Messages --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('me.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label class="block font-semibold mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">Description</label>
            <textarea name="description" rows="4" class="w-full border rounded p-2">{{ old('description') }}</textarea>
        </div>

        <div>
            <label class="block font-semibold mb-1">Price ($)</label>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">Quantity</label>
            <input type="number" name="quantity" min="1" value="{{ old('quantity') }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">Category</label>
            <input type="text" name="category" value="{{ old('category') }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">Condition</label>
            <select name="condition" class="w-full border rounded p-2">
                <option value="new">New</option>
                <option value="used">Used</option>
            </select>
        </div>

        <div>
            <label class="block font-semibold mb-1">Location</label>
            <input type="text" name="location" value="{{ old('location') }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">Product Images (you can choose multiple)</label>
            <input type="file" name="images[]" multiple class="w-full">
        </div>

        <button type="submit" class="w-full py-3 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-500">
            Publish Product
        </button>
    </form>
</div>
@endsection