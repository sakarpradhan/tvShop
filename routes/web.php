<?php

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
Route::get('/create', [TvController::class, 'create']);
Route::get('/edit/{tv}', [TvController::class, 'edit']);

Route::post('/store', [TvController::class, 'store']);
Route::post('/destroy', [TvController::class, 'destroy']);
Route::patch('/update/{tv}', [TvController::class, 'update']);
