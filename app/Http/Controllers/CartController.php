<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Category;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = [];

        if (Auth::check()) {
            $cartItems = Cart::with('items')->where('user_id', Auth::id())->first();
        } else {
            $cartItems = session('cart', []);
        }
        $allCategories = Category::all();

        return view('pages.cart', compact('cartItems','allCategories'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        if (!Auth::check()) {
            $sessionCart = session()->get('cart', []);

            if (isset($sessionCart[$request->product_id])) {
                $sessionCart[$request->product_id]['quantity'] += $request->quantity;
            } else {
                $sessionCart[$request->product_id] = [
                    'product_id' => $request->product_id,
                    'quantity'   => $request->quantity,
                ];
            }
            session()->put('cart', $sessionCart);

            return back()->with('success', 'Item added to cart (saved in session until you log in).');
        }

        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id()],
            ['user_id' => Auth::id()]
        );

        $existingItem = $cart->items()->where('product_id', $request->product_id)->first();
        if ($existingItem) {
            $existingItem->increment('quantity', $request->quantity);
        } else {
            $cart->items()->create([
                'product_id' => $request->product_id,
                'quantity'   => $request->quantity,
            ]);
        }

        return back()->with('success', 'Item added to cart!');
    }

}
