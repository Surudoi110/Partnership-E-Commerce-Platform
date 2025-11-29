<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Public: show all products (paginated)
    public function index()
    {
        $products = Product::with('images')->latest()->paginate(12);
        return view('index', compact('products')); // or 'products.index'
    }

    // Public: show product detail
    public function show($id)
    {
        $product = Product::with('images')->findOrFail($id);

        // If you want only active products visible publicly:
        // if ($product->status !== 'active') abort(404);

        return view('products.show', compact('product'));
    }

    // Auth required: show create form
    public function create()
    {
        $this->authorize('create', Product::class); // optional policy
        return view('products.create');
    }

    // Auth required: store product
    public function store(Request $request)
    {
        $this->authorize('create', Product::class); // optional policy

        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'quantity'    => 'required|integer|min:0',
            'category'    => 'required|string',
            'condition'   => 'required|string',
            'location'    => 'required|string',
            'images'      => 'nullable|array',
            'images.*'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Use transaction to avoid partial data
        DB::beginTransaction();
        try {
            $product = Product::create([
                'seller_id'   => Auth::id(),
                'title'       => $data['title'],
                'description' => $data['description'],
                'price'       => $data['price'],
                'quantity'    => $data['quantity'],
                'category'    => $data['category'],
                'condition'   => $data['condition'],
                'location'    => $data['location'],
                'status'      => 'active',
            ]);

            if (!empty($data['images'])) {
                foreach ($data['images'] as $img) {
                    // store on public disk so it's web accessible
                    $path = $img->store('product_images', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $path
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('products.index')->with('success', 'Product created.');
        } catch (\Throwable $e) {
            DB::rollBack();
            // optionally log the error
            return back()->withInput()->withErrors('Failed to create product. Please try again.');
        }
    }

    // Seller: edit form (only owner)
    public function edit($id)
    {
        $product = Product::where('seller_id', Auth::id())->with('images')->findOrFail($id);
        $this->authorize('update', $product); // optional policy
        return view('products.edit', compact('product'));
    }

    // Seller: update product
    public function update(Request $request, $id)
    {
        $product = Product::where('seller_id', Auth::id())->findOrFail($id);
        $this->authorize('update', $product); // optional policy

        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'quantity'    => 'required|integer|min:0',
            'category'    => 'required|string',
            'condition'   => 'required|string',
            'location'    => 'required|string',
            'status'      => 'required|string',
            'images'      => 'nullable|array',
            'images.*'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        DB::beginTransaction();
        try {
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

            // Add new images if uploaded
            if (!empty($data['images'])) {
                foreach ($data['images'] as $img) {
                    $path = $img->store('product_images', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $path
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('products.show', $id)->with('success', 'Product updated.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withInput()->withErrors('Failed to update product. Please try again.');
        }
    }

    // Seller: destroy product (resourceful name)
    public function destroy($id)
    {
        $product = Product::where('seller_id', Auth::id())->with('images')->findOrFail($id);
        $this->authorize('delete', $product); // optional policy

        DB::beginTransaction();
        try {
            // delete files from public disk
            foreach ($product->images as $img) {
                Storage::disk('public')->delete($img->image_path);
                $img->delete();
            }

            $product->delete();

            DB::commit();
            return redirect()->route('products.index')->with('success', 'Product deleted.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors('Failed to delete product.');
        }
    }
}
