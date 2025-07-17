<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;
use App\Http\Controllers\Products;
use App\Http\Controllers\Company;
use App\Http\Controllers\Contact;
use App\Http\Controllers\Chat;
use App\Http\Controllers\Privacy;
use App\Http\Controllers\Strategy;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Checkout;
use App\Http\Controllers\Synthesis;

Route::get('/', [Home::class, 'index'])->name('home');

Route::get('/products', [Products::class, 'index'])->name('products.main');
Route::get('/products/category/{id}', [Products::class, 'index'])->name('products.category');
Route::get('/products/load-more', [Products::class, 'loadMore']);

Route::get('/single-product/{id}', [Products::class, 'single'])->name('products.single');
Route::get('/company', [Company::class, 'index'])->name('company');

Route::get('/contact-us', [Contact::class, 'index'])->name('contact');
Route::post('/contact-us', [Contact::class, 'submitForm'])->middleware('throttle:5,1')->name('contact.form.submission');

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/checkout', [Checkout::class, 'index'])->name('checkout');
Route::get('/chat', [Chat::class, 'index'])->name('chat');
Route::get('/privacy', [Privacy::class, 'index'])->name('privacy');
Route::get('/business-strategy', [Strategy::class, 'index'])->name('business.strategy');
Route::get('/custom-synthesis', [Synthesis::class, 'index'])->name('custom-synthesis');
