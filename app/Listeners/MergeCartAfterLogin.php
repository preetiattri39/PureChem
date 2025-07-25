<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\CartItem;


class MergeCartAfterLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;
        $sessionCart = session()->get('cart', []);

        if (!empty($sessionCart)) {
            DB::transaction(function () use ($user, $sessionCart) {

                $cart = Cart::firstOrCreate(['user_id' => $user->id]);

                $existingItems = CartItem::where('cart_id', $cart->id)
                    ->get(['product_id', 'product_variant_id'])
                    ->map(function ($item) {
                        return $item['product_variant_id'] ? $item['product_id'].'-'.$item['product_variant_id'] : $item['product_id'];
                    })
                    ->toArray();

                $existingKeys = array_flip($existingItems);

                $newItems = [];
                foreach ($sessionCart as $key => $item) {
                    if (!isset($existingKeys[$item['id']])) {
                        $newItems[] = [
                            'cart_id'            => $cart->id,
                            'product_id'         => $item['product_id'],
                            'product_variant_id' => $item['product_variant_id'],
                            'product_name'       => $item['product_name'],
                            'cas_number'         => $item['cas_number'],
                            'quantity'           => $item['quantity'],
                        ];
                    }
                }

                if (!empty($newItems)) {
                    CartItem::insert($newItems);
                }
            });

            session()->forget('cart');
            session()->forget('cart-counter');

            $dbCount = CartItem::whereHas('cart', fn($q) => $q->where('user_id', $user->id))->count();
            session()->put('cart-counter', $dbCount);
        }

    }
}
