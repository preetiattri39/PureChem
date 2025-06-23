<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;
use App\Http\Controllers\Products;
use App\Http\Controllers\Company;
use App\Http\Controllers\Contact;
use App\Http\Controllers\Chat;
use App\Http\Controllers\Cart;
use App\Http\Controllers\Checkout;
use App\Http\Controllers\Synthesis;

Route::get('/', [Home::class, 'index'])->name('home');
Route::get('/products', [Products::class, 'index'])->name('products.main');
Route::get('/single-product', [Products::class, 'single'])->name('products.single');
Route::get('/company', [Company::class, 'index'])->name('company');
Route::get('/contact-us', [Contact::class, 'index'])->name('contact');
Route::get('/cart', [Cart::class, 'index'])->name('cart');
Route::get('/checkout', [Checkout::class, 'index'])->name('checkout');
Route::get('/chat', [Chat::class, 'index'])->name('chat');
Route::get('/custom-synthesis', [Synthesis::class, 'index'])->name('custom-synthesis');
