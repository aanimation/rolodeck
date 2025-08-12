<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Auth\{ForgotPassword, ResetPassword, SignUp, Login};
use App\Http\Livewire\Dashboard\{Board, Billing, Profile, Tables};
use App\Http\Livewire\Market\{Home, Catalogue, Cart, Checkout, Product};


/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/

Route::get('/sign-up', SignUp::class)->name('sign-up');
Route::get('/login', Login::class)->name('login');
Route::get('/login/forgot-password', ForgotPassword::class)->name('forgot-password');
Route::get('/reset-password/{id}',ResetPassword::class)->name('reset-password')->middleware('signed');

Route::prefix('manage')->middleware('auth')->group(function () {
    Route::get('/dashboard', Board::class)->name('dashboard');
    Route::get('/billing', Billing::class)->name('billing');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/tables', Tables::class)->name('tables');
    
});


/*
|--------------------------------------------------------------------------
| Shop Routes
|--------------------------------------------------------------------------
*/
Route::middleware('setlocale')->group(function () {
    Route::get('/', Home::class)->name('homepage');
    Route::get('/products', Catalogue::class)->name('catalogue');
    Route::get('/product/{slug}', Product::class)->name('product');
    Route::get('/cart/{session}', Cart::class)->name('cart');
    Route::get('/checkout/{session}', Checkout::class)->name('checkout');
});