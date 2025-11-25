<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //
    public function index()
    {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $items = $cart->items()->with('product')->get();

        return view('cart.index', compact('cart', 'items'));
    }

    // Add product to cart
    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $existingItem = CartItem::where('cart_id', $cart->id)
                                ->where('product_id', $productId)
                                ->first();

        if ($existingItem) {
            $existingItem->quantity += 1;
            $existingItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => 1
            ]);
        }

        return back()->with('success', 'Added to cart!');
    }

    // Update quantity
    public function update(Request $request, $itemId)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $item = CartItem::whereHas('cart', function ($q) {
            $q->where('user_id', Auth::id());
        })->findOrFail($itemId);

        $item->update(['quantity' => $request->quantity]);

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
