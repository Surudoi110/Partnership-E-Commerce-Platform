<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('images')->latest()->get();
        return view('products.index', compact('products'));
    }

    // Show product detail
    public function show($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    // Seller: form to create product
    public function create()
    {
        return view('products.create');
    }

    // Store new product
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'images.*' => 'image|max:2048'
        ]);

        $product = Product::create([
            'seller_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'status' => 'active'
        ]);

        // Handle images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('product_images');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Product created.');
    }

    // Show edit form
    public function edit($id)
    {
        $product = Product::where('seller_id', Auth::id())->findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // Update product
    public function update(Request $request, $id)
    {
        $product = Product::where('seller_id', Auth::id())->findOrFail($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        $product->update($request->only('title', 'description', 'price', 'quantity'));

        return redirect()->route('products.show', $id)->with('success', 'Product updated.');
    }

    // Delete product
    public function delete($id)
    {
        $product = Product::where('seller_id', Auth::id())->findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted.');
    }
}
