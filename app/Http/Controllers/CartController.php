<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Category;
use Throwable;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = []; 

        if (Auth::check()) {
            $cart = Cart::with('items')->where('user_id', Auth::id())->first();
            $cartItems = $cart ? $cart->items->toArray() : [];
        } else {
            $cartItems = session('cart', []);
        }
        $allCategories = Category::all();

        return view('pages.cart', compact('cartItems','allCategories'));
    }

    public function addToCart(Request $request)
    {
        try {
            $request->validate([
                'product_id'         => 'required|exists:products,id',
                'product_variant_id' => 'nullable|exists:product_variants,id',
            ]);

            $productId = $request->input('product_id');
            $variantId = $request->input('product_variant_id') ?? null;

            $quantityValue = '';
            $unit = '';
            if ($variantId) {
                $variant = ProductVariant::find($variantId);
                $quantityValue = $variant->quantity ?? '';
                $unit = $variant->unit ?? '';
            }

            $product = Product::findOrFail($productId);

            $productName   = $product->name ?? '';
            $productCas    = $product->cas_number ?? '';
            $productQtyStr = $quantityValue . $unit;

            if (!auth()->check()) {
                $cart = session()->get('cart', []);
                $key = $variantId ? $productId . '-' . $variantId : $productId;

                $cart[$key] = [
                    'id'                 => $key,
                    'product_id'         => $productId,
                    'product_name'       => $productName,
                    'cas_number'         => $productCas,
                    'quantity'           => $productQtyStr,
                    'product_variant_id' => $variantId,
                ];

                $cartCounter = count($cart) ?? 0;
                session()->put(['cart' => $cart]);
                
                return response()->json([
                    'status'  => 'success',
                    'message' => 'Product added to your cart!',
                    'cart_counter' => $cartCounter
                ]);
            }

            $userId = auth()->id();

            DB::beginTransaction();

            $cart = Cart::firstOrCreate(['user_id' => $userId]);

            $query = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $productId);

            if (!is_null($variantId) || $variantId !== '') {
                $query->where('product_variant_id', $variantId);
            }

            $cartItem = $query->first();

            if (!$cartItem) {
                CartItem::create([
                    'id'           => $cart->id,
                    'product_id'        => $productId,
                    'product_name'      => $productName,
                    'cas_number'        => $productCas,
                    'quantity'          => $productQtyStr,
                    'product_variant_id'=> $variantId,
                ]);
            }

            DB::commit();

            $cartCounter = CartItem::where('cart_id', $cartItem->cart_id)->count() ?? 0;

            return response()->json([
                'status'  => 'success',
                'message' => 'Product added to your cart!',
                'cart-counter' => $cartCounter
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validation failed',
                'errors'  => $e->errors()
            ], 422);

        } catch (Throwable $e) {
            if (DB::transactionLevel() > 0) {
                DB::rollBack();
            }

            Log::error('Add to cart failed: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong while adding to cart. Please try again.'
            ], 500);
        }
    }

    public function deleteFromCart($cart_item_id)
    {
        try {
            Validator::make(['cart_item_id' => $cart_item_id], [
                'cart_item_id' => 'required|string',
            ])->validate();

            if (!auth()->check()) {
                $cart = session()->get('cart', []);

                if (isset($cart[$cart_item_id])) unset($cart[$cart_item_id]);

                $cartCounter = count($cart) ?? 0;
                session()->put(['cart' => $cart]);
                
                return response()->json([
                    'status'  => 'success',
                    'message' => 'Product removed from your cart!',
                    'cart_counter' => $cartCounter
                ]);
            }

            $userId = auth()->id();

            $cartItem = CartItem::where('id', $cart_item_id)
                ->whereHas('cart', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                })
                ->first();

            if (!$cartItem) {
               throw new Exception("Something went wrong!");
            }

            $cartItem->delete();

            $cartCounter = CartItem::where('cart_id', $cartItem->cart_id)->count() ?? 0;

            return response()->json([
                'status'       => 'success',
                'message'      => 'Item removed from your cart!',
                'cart_counter' => $cartCounter,
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validation failed',
                'errors'  => $e->errors()
            ], 422);

        } catch (Throwable $e) {
            Log::error('Delete from cart failed: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong while removing from cart. Please try again.'
            ], 500);
        }
    }

}
