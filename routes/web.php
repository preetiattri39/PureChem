<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;
use App\Http\Controllers\Products;
use App\Http\Controllers\Company;
use App\Http\Controllers\Contact;
use App\Http\Controllers\Privacy;
use App\Http\Controllers\Confidentiality;
use App\Http\Controllers\Strategy;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Checkout;
use App\Http\Controllers\Synthesis;
use App\Http\Controllers\PublicEmailVerificationController;
use App\Http\Controllers\CustomVerifyEmailController;

Route::get('/', [Home::class, 'index'])->name('home'); 
Route::get('/products', [Products::class, 'index'])->name('products.main');
Route::get('/products/category/{id}', [Products::class, 'index'])->name('products.category');
Route::get('/products/load-more', [Products::class, 'loadMore']);
Route::get('/single-product/{id}', [Products::class, 'single'])->name('products.single');
Route::get('/company', [Company::class, 'index'])->name('company');

Route::get('/contact-us', [Contact::class, 'index'])->name('contact');
Route::post('/contact-us', [Contact::class, 'submitForm'])->middleware('throttle:5,1')->name('contact.form.submission');

Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'addToCart'])->name('add');
    Route::delete('/delete/{cart_item_id}', [CartController::class, 'deleteFromCart'])->name('delete');
});

Route::get('/confidentiality', [Confidentiality::class, 'index'])->name('confidentiality');
Route::get('/privacy', [Privacy::class, 'index'])->name('privacy');
Route::get('/business-strategy', [Strategy::class, 'index'])->name('business.strategy');

Route::get('/custom-synthesis', [Synthesis::class, 'index'])->name('custom-synthesis');
Route::post('/custom-synthesis/submit', [Synthesis::class, 'submitForm'])->name('synthesis.submit');

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/checkout', [Checkout::class, 'index'])->name('checkout'); 
});

Route::get('/email/verify', [PublicEmailVerificationController::class, 'show'])
    ->name('verification.notice.public');

Route::post('/email/verify/resend', [PublicEmailVerificationController::class, 'resend'])
    ->name('verification.resend.public');

Route::get('/email/verify/{id}/{hash}', [CustomVerifyEmailController::class, '__invoke'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');