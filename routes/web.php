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
        Route::get('/graficos/Kambista', [App\Http\Controllers\GraphController::class, 'indexKambista'])
            ->name('dashboard.graphs.Kambista');
        Route::get('/graficos/Bloomberg', [App\Http\Controllers\GraphController::class, 'indexBloomberg'])
            ->name('dashboard.graphs.Bloomberg');
        Route::get('/graficos/Google', [App\Http\Controllers\GraphController::class, 'indexGoogle'])
            ->name('dashboard.graphs.Google');
        Route::get('/graficos/Cocosylucas', [App\Http\Controllers\GraphController::class, 'indexCocosylucas'])
            ->name('dashboard.graphs.Cocosylucas');
        Route::get('/graficos/TKambio', [App\Http\Controllers\GraphController::class, 'indexTKambio'])
            ->name('dashboard.graphs.TKambio');
        Route::get('/graficos/SecuEx', [App\Http\Controllers\GraphController::class, 'indexSecuEx'])
            ->name('dashboard.graphs.SecuEx');

    });
});
Route::get('/data', [\App\Http\Controllers\DataController::class, 'getData']);