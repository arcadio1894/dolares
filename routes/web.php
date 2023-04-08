<?php

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

Route::middleware('auth')->group(function (){
    Route::prefix('dashboard')->group(function (){
        Route::get('/perfil', [App\Http\Controllers\UserController::class, 'profile'])
            ->name('dashboard.profile');
        Route::get('/graficos', [App\Http\Controllers\GraphController::class, 'index'])
            ->name('dashboard.graphs');

    });
});
Route::get('/data', [\App\Http\Controllers\DataController::class, 'getData']);