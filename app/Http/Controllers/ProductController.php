<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Public: show all products
    public function index()
    {
        $products = Product::with('images')->latest()->get();
        // return view('products.index', compact('products'));
        return view('index', compact('products'));

    }

    // Public: show product detail
    public function show($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    // Seller: create form
    public function create()
    {
        return view('products.create');
    }

    // Seller: store product
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'price'       => 'required|numeric',
            'quantity'    => 'required|integer',
            'category'    => 'required',
            'condition'   => 'required',
            'location'    => 'required',
            'images.*'    => 'image|max:2048'
        ]);

        $product = Product::create([
            'user_id' => Auth::id(),
            'title'       => $request->title,
            'description' => $request->description,
            'price'       => $request->price,
            'quantity'    => $request->quantity,
            'category'    => $request->category,
            'condition'   => $request->condition,
            'location'    => $request->location,
            'status'      => 'active'
        ]);

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

    // edit form
    public function edit($id)
    {
        $product = Product::where('user_id', Auth::id())->with('images')->findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // update product
    public function update(Request $request, $id)
    {
        $product = Product::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'price'       => 'required|numeric',
            'quantity'    => 'required|integer',
            'category'    => 'required',
            'condition'   => 'required',
            'location'    => 'required',
            'status'      => 'required',
        ]);

        $product->update($request->only(
            'title',
            'description',
            'price',
            'quantity',
            'category',
            'condition',
            'location',
            'status'
        ));

        // Add new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('product_images');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path
                ]);
            }
        }

        return redirect()->route('products.show', $id)->with('success', 'Product updated.');
    }

    // delete product
    public function delete($id)
    {
        $product = Product::where('user_id', Auth::id())->with('images')->findOrFail($id);

        foreach ($product->images as $img) {
            Storage::delete($img->image_path);
            $img->delete();
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted.');
    }
}
