<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
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
use Symfony\Component\HttpKernel\Exception\HttpException;

class CheckoutController extends Controller
{

    public function index(Request $request)
    {
        $userId = Auth::id();

        $user = User::find($userId);

        if (!$user) {
            Auth::logout();
            return redirect()->route('login')->withErrors(['error' => 'User not found! Please login again.']);
        }

        if($user->role === 'admin'){
            abort(400,'Admins are not allowed to submit RFQ');
        }

        $validated = [
            'name'        => $user->name ?? '',
            'email'       => $user->email ?? '',
            'phone'       => $user->phone ?? '',
            'address'     => $user->address ?? '',
            'country'     => $user->country ?? '',
            'city'        => $user->city ?? '',
            'province'    => $user->province ?? '',
            'postal_code' => $user->postal_code ?? '',
        ];

        DB::beginTransaction();

        try {
            $cart = Cart::where('user_id', $userId)->with('items')->first();

            if (!$cart) {
                throw new HttpException(500,'Something went wrong! Please try again later.');
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

            RfqItem::insert($rfqItemsForDb);
            $cart->items()->delete();
            $cart->delete();

            Mail::to(replace_shortcodes('[email-form-submission]'))->send(new FormSubmissionMail($mailData, 'mails.rfq', 'RFQ from Catalogue'));

            DB::commit();

            return redirect()->route('filament.user.pages.thread',['rfqId'=> $rfq->id])->with('checkout_success', 'Checkout completed successfully. You can chat here with the admin, if you have any query.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout Error : '.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->withErrors(['error' => $e->getMessage()]); 
        }
    }

}
