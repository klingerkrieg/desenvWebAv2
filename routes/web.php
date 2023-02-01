<?php

use App\Http\Controllers\AController;
use App\Http\Controllers\BController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/a/list', [AController::class,"list"])->name('a.list');
    Route::get('/a', [AController::class,"create"])->name('a.create');
    Route::post('/a', [AController::class,"store"])->name('a.store');
    Route::get('/a/{a}', [AController::class,"edit"])->name('a.edit');
    Route::put("/a/{a}", [AController::class,"update"])->name('a.update');
    Route::delete('/a/{a}', [AController::class,"destroy"])->name('a.destroy');

    Route::get('/b/list', [BController::class,"list"])->name('b.list');
    Route::get('/b', [BController::class,"create"])->name('b.create');
    Route::post('/b', [BController::class,"store"])->name('b.store');
    Route::get('/b/{b}', [BController::class,"edit"])->name('b.edit');
    Route::put("/b/{b}", [BController::class,"update"])->name('b.update');
    Route::delete('/b/{b}', [BController::class,"destroy"])->name('b.destroy');
});
