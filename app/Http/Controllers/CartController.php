<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show cart
    public function index()
    {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $items = $cart->items()->with('product')->get();

        return view('cart.index', compact('cart', 'items'));
    }

    // Add product to cart (optionally accept quantity via request)
    public function add(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1'
        ]);

        $quantity = $request->input('quantity', 1);

        $product = Product::findOrFail($productId);

        // Check stock
        if ($product->quantity < $quantity) {
            return back()->withErrors('Not enough stock available.');
        }

        DB::transaction(function () use ($product, $quantity) {
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

            // Use updateOrCreate to merge existing item and set quantity
            $item = CartItem::where('cart_id', $cart->id)
                            ->where('product_id', $product->id)
                            ->first();

            if ($item) {
                $newQty = $item->quantity + $quantity;

                // Ensure new quantity doesn't exceed stock
                if ($newQty > $product->quantity) {
                    throw new \Exception('Quantity exceeds available stock.');
                }

                $item->increment('quantity', $quantity);
            } else {
                CartItem::create([
                    'cart_id'    => $cart->id,
                    'product_id' => $product->id,
                    'quantity'   => $quantity
                ]);
            }
        });

        return back()->with('success', 'Added to cart!');
    }

    // Update quantity
    public function update(Request $request, $itemId)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $item = CartItem::whereHas('cart', function ($q) {
                $q->where('user_id', Auth::id());
            })->with('product')->findOrFail($itemId);

        // Check stock
        if ($request->quantity > $item->product->quantity) {
            return back()->withErrors('Requested quantity exceeds product stock.');
        }

        $item->quantity = $request->quantity;
        $item->save();

        return back()->with('success', 'Cart updated!');
    }

    // Remove an item
    public function remove($itemId)
    {
        $item = CartItem::whereHas('cart', function ($q) {
                $q->where('user_id', Auth::id());
            })->findOrFail($itemId);

        $item->delete();

        return back()->with('success', 'Item removed.');
    }
}