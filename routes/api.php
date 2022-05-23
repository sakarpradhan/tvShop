<?php

use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TvController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/tv', [TvController::class, 'index']);
Route::get('/tv/{tv}', [TvController::class, 'show']);

Route::post('/store', [TvController::class, 'store'])->middleware(['auth:sanctum', 'can:admin']);
Route::put('/update/{tv}', [TvController::class, 'update'])->middleware(['auth:sanctum', 'can:admin']);
Route::delete('/destroy/{tv}', [TvController::class, 'destroy'])->middleware(['auth:sanctum', 'can:admin']);

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [RegisterController::class, 'login']);
Route::post('/logout', [RegisterController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/cart', [CartController::class, 'show'])->middleware(['auth:sanctum', 'can:customer']);
Route::get('/cart/add/{tv}', [CartController::class, 'store'])->middleware(['auth:sanctum', 'can:customer']);
Route::get('/cart/delete/{cart}', [CartController::class, 'destroy'])->middleware(['auth:sanctum', 'can:customer']);
