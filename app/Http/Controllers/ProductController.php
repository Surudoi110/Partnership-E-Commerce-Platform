<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // PUBLIC — homepage product listing
    public function index()
    {
        $products = Product::with('images')->latest()->take(8)->get();
        return view('index', compact('products'));
    }

    // PUBLIC — all products page
    public function list()
    {
        $products = Product::with('images')->latest()->paginate(15);
        return view('products.list', compact('products'));
    }

    // PUBLIC — show product detail
    public function show(Product $product)
    {
        $product->load('images');
        return view('products.show', compact('product'));
    }

    // AUTH — my products dashboard
    public function myProducts()
    {
        $products = Product::where('user_id', Auth::id())
            ->with('images')
            ->latest()
            ->get();

        return view('products.my', compact('products'));
    }

    // AUTH — create form
    public function create()
    {
        return view('products.create');
    }

    // AUTH — store new product
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'price'       => 'required|numeric|min:0',
            'quantity'    => 'required|integer|min:1',
            'category'    => 'required',
            'condition'   => 'required',
            'location'    => 'required',
            'images.*'    => 'image|max:2048'
        ]);

        DB::transaction(function () use ($request) {

            $product = Product::create([
                // 'user_id'   => Auth::id(),
                'user_id'    => 1, // TEMPORARY FIX FOR DEMO PURPOSES
                'title'       => $request->title,
                'description' => $request->description,
                'price'       => $request->price,
                'quantity'    => $request->quantity,
                'category'    => $request->category,
                'condition'   => $request->condition,
                'location'    => $request->location,
                'status'      => 'active',
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->images as $image) {
                    $path = $image->store('product_images', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $path
                    ]);
                }
            }
        });

        return redirect()->route('me.products.index')
            ->with('success', 'Product created successfully.');
    }

    // AUTH — edit form
    public function edit(Product $product)
    {
        // Ownership check
        if ($product->user_id !== Auth::id()) abort(403);

        $product->load('images');
        return view('products.edit', compact('product'));
    }

    // AUTH — update product
    public function update(Request $request, Product $product)
    {
        if ($product->user_id !== Auth::id()) abort(403);

        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'price'       => 'required|numeric|min:0',
            'quantity'    => 'required|integer|min:1',
            'category'    => 'required',
            'condition'   => 'required',
            'location'    => 'required',
            'status'      => 'required',
            'images.*'    => 'image|max:2048'
        ]);

        DB::transaction(function () use ($request, $product) {

            $product->update($request->only([
                'title', 'description', 'price', 'quantity',
                'category', 'condition', 'location', 'status'
            ]));

            if ($request->hasFile('images')) {
                foreach ($request->images as $image) {
                    $path = $image->store('product_images', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $path
                    ]);
                }
            }
        });

        return redirect()->route('me.products.index')
            ->with('success', 'Product updated successfully.');
    }

    // AUTH — delete product
    public function destroy(Product $product)
    {
        if ($product->user_id !== Auth::id()) abort(403);

        DB::transaction(function () use ($product) {

            // delete images from storage
            foreach ($product->images as $img) {
                Storage::disk('public')->delete($img->image_path);
                $img->delete();
            }

            $product->delete();
        });

        return redirect()->route('me.products.index')
            ->with('success', 'Product deleted.');
    }
}