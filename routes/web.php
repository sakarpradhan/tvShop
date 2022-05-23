<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TimerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TvController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [TvController::class, 'index'])->name('home');
Route::get('/create', [TvController::class, 'create'])->middleware('can:admin');
Route::get('/edit/{tv}', [TvController::class, 'edit'])->middleware('can:admin');
Route::post('/store', [TvController::class, 'store'])->middleware('can:admin');
Route::post('/destroy', [TvController::class, 'destroy'])->middleware('can:admin');
Route::patch('/update/{tv}', [TvController::class, 'update'])->middleware('can:admin');

Route::get('/register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('/login', [SessionController::class, 'create'])->middleware('guest');
Route::post('/login', [SessionController::class, 'store'])->middleware('guest');
Route::post('/logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::get('/cart', [CartController::class, 'show'])->middleware('can:customer');
Route::get('/cart/add/{tv}', [CartController::class, 'store'])->middleware('can:customer');
Route::get('/cart/delete/{cart}', [CartController::class, 'destroy'])->middleware('can:customer');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->middleware('can:customer');

Route::get('/timer', [TimerController::class, 'create'])->middleware('can:admin');
Route::post('/timer', [TimerController::class, 'store'])->middleware('can:admin');
