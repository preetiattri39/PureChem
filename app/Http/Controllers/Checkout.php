<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Rfq;
use App\Models\RfqItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormSubmissionMail;

class Checkout extends Controller
{
   public function index()
    {
        if (Auth::check()) {
            $cart = Cart::with('items')->where('user_id', Auth::id())->first();
            $cartItems = $cart ? $cart->items->toArray() : [];
        } else {
            $cartItems = session('cart', []);
        } 

        if (empty($cartItems)) {
            return redirect()->route('home');
        }

        $allCategories = Category::all();

        return view('pages.checkout',compact('cartItems', 'allCategories'));
    }

    public function checkout(Request $request)
    {
        $userId = Auth::id();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'country' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
        ]);

        DB::beginTransaction();

        try {

            $cart = Cart::where('user_id', $userId)->with('items')->first();

            if (!$cart) {
                throw new Exception('Something went wrong! Please try again later.');
            }
            
            $cartItems = $cart->items;

            if ($cartItems->isEmpty()) {
                return redirect()->route('home')->with('error', 'Cart is empty.');
            }

            $rfq = Rfq::create([
                'user_id' => $userId,
                'status' => 'open',
            ]);

            $rfqItems = $cartItems->map(function ($item) use ($rfq) {
                return [
                    'rfq_id' => $rfq->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'product_name' => $item->product->name,
                    'cas_number' => $item->product->cas_number,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            });

            $rfqItemsForDb = $rfqItems->map(function ($item) {
                return [
                    'rfq_id' => $item['rfq_id'],
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            })->toArray();

            $mailData = [
                'info' => $validated,
                'orderDetail' => $rfqItems->toArray(),
            ];

            $cart->items()->delete();
            $cart->delete();

            $mailData = [
                'info' => $validated,
                'orderDetail' => $rfqItems
            ];

            Mail::to(replace_shortcodes('[email-form-submission]'))->send(new FormSubmissionMail($mailData, 'mails.rfq'));

            DB::commit();

            return redirect()->route('filament.user.pages.thread',['rfqId'=> $rfq->id])->with('checkout_success', 'Checkout completed successfully. You can chat here with the admin, if you have any query.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout Error : '.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]); 
        }
    }

}
