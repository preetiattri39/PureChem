<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\ConfidentialityController;
use App\Http\Controllers\StrategyController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SynthesisController;
use App\Http\Controllers\PublicEmailVerificationController;
use App\Http\Controllers\CustomVerifyEmailController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductsController::class, 'index'])->name('main');
    Route::get('/category/{id}', [ProductsController::class, 'index'])->name('category');
    Route::get('/load-more', [ProductsController::class, 'loadMore']);
    Route::get('/single/{id}', [ProductsController::class, 'single'])->name('single');
});

Route::get('/company', [CompanyController::class, 'index'])->name('company');

Route::get('/contact-us', [ContactController::class, 'index'])->name('contact');
Route::post('/contact-us', [ContactController::class, 'submitForm'])
    ->middleware('throttle:5,1')
    ->name('contact.form.submission');

Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'addToCart'])->name('add');
    Route::delete('/delete/{cart_item_id}', [CartController::class, 'deleteFromCart'])->name('delete');
});

Route::get('/confidentiality', [ConfidentialityController::class, 'index'])->name('confidentiality');
Route::get('/privacy', [PrivacyController::class, 'index'])->name('privacy');
Route::get('/business-strategy', [StrategyController::class, 'index'])->name('business.strategy');

Route::get('/custom-synthesis', [SynthesisController::class, 'index'])->name('custom-synthesis');
Route::post('/custom-synthesis/submit', [SynthesisController::class, 'submitForm'])->name('synthesis.submit');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout'); 
});

Route::get('/email/verify', [PublicEmailVerificationController::class, 'show'])
    ->name('verification.notice.public');

Route::post('/email/verify/resend', [PublicEmailVerificationController::class, 'resend'])
    ->name('verification.resend.public');

Route::get('/email/verify/{id}/{hash}', [CustomVerifyEmailController::class, '__invoke'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');