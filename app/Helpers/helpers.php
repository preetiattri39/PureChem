<?php
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

if (!function_exists('replace_shortcodes')) {
    function replace_shortcodes($content) 
    {
        $shortcodes = [
            '[admin-ph-1]'         => '+358 46 5534360',
            '[admin-email-1]'      => 'sales@swizchem.com',
            '[email-form-submission]'      => 'tahirzoptal@gmail.com',
            '[admin-address-1]'    => 'A326, A.I. Virtasen Aukio 1, 00560 Helsinki, Finland.',

            '[admin-ph-1-html]'    => '<a href="tel:+358 46 5534360">+358 46 5534360</a>',
            '[admin-email-1-html]' => '<a href="mailto:sales@swizchem.com">sales@swizchem.com</a>',

            '[working-days-open]'       => 'Monday',
            '[working-days-close]'       => 'Thursday',
            '[working-hours-open]'      => '9:00 AM',
            '[working-hours-close]'      => '3:30 PM',

            '[exception-day-1]' => 'Friday',
            '[exception-day-1-working-hours-open]'      => '9:00 AM',
            '[exception-day-1-working-hours-close]'      => '1:00 PM',

            '[customer-support-email]' => 'manvatt@swizchem.com',
            '[customer-support-email-html]' => '<a href="mailto:manvatt@swizchem.com">manvatt@swizchem.com</a>',
            
        ];

        return str_replace(array_keys($shortcodes), array_values($shortcodes), $content);
    }
}

if (!function_exists('cart_counter')) {
    function cart_counter(): int
    {
        if (Auth::check()) {
            $userId = Auth::id();

            return CartItem::whereHas('cart', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })->count();
        }

        return count(session('cart', []));
    }
}