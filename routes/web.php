<?php

use App\Http\Controllers\FooController;
use App\Http\Controllers\BarController;
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
    Route::get('/foo/list', [FooController::class,"list"])->name('foo.list');
    Route::get('/foo', [FooController::class,"create"])->name('foo.create');
    Route::post('/foo', [FooController::class,"store"])->name('foo.store');
    Route::get('/foo/{a}', [FooController::class,"edit"])->name('foo.edit');
    Route::put("/foo/{a}", [FooController::class,"update"])->name('foo.update');
    Route::delete('/foo/{a}', [FooController::class,"destroy"])->name('foo.destroy');


    Route::get('/bar/list', [BarController::class,"list"])->name('bar.list');
    Route::get('/bar', [BarController::class,"create"])->name('bar.create');
    Route::post('/bar', [BarController::class,"store"])->name('bar.store');
    Route::get('/bar/{b}', [BarController::class,"edit"])->name('bar.edit');
    Route::put("/bar/{b}", [BarController::class,"update"])->name('bar.update');
    Route::delete('/bar/{b}', [BarController::class,"destroy"])->name('bar.destroy');
});
