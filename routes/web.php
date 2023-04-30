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

        // TODO: Rutas de Perfil
        Route::get('/perfil', [App\Http\Controllers\UserController::class, 'profile'])
            ->name('dashboard.profile');
        Route::get('/token/seguro', [App\Http\Controllers\UserController::class, 'token'])
            ->name('dashboard.profile.token');
        Route::post('/token/store', [App\Http\Controllers\UserController::class, 'storeToken'])
            ->name('token.store');
        Route::post('/token/renew', [App\Http\Controllers\UserController::class, 'renewToken'])
            ->name('token.renew');
        Route::post('/apply/coupon', [App\Http\Controllers\HomeController::class, 'applyCoupon'])
            ->name('apply.coupon');

        // TODO: Rutas de Graficos
        Route::get('/graficos/Dolareros', [App\Http\Controllers\GraphController::class, 'indexDolareros'])
            ->name('dashboard.graphs.Dolareros');
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

        // TODO: Rutas BackOffice - Accounts Dolareros
        Route::get('/cuentas/dolareros', [App\Http\Controllers\AccountDolareroController::class, 'index'])
            ->name('accounts.dolareros.index');
        Route::post('/account/store', [App\Http\Controllers\AccountDolareroController::class, 'store'])
            ->name('accounts.store');
        Route::post('/account/update', [App\Http\Controllers\AccountDolareroController::class, 'update'])
            ->name('accounts.update');
        Route::post('/account/update/status', [App\Http\Controllers\AccountDolareroController::class, 'updateStatus'])
            ->name('accounts.update.status');
        Route::post('/account/destroy/{account_id}', [App\Http\Controllers\AccountDolareroController::class, 'destroy'])
            ->name('accounts.destroy');

        // TODO: Rutas BackOffice - Banks
        Route::get('/bancos', [App\Http\Controllers\BankController::class, 'index'])
            ->name('banks.index');
        Route::post('/bank/store', [App\Http\Controllers\BankController::class, 'store'])
            ->name('banks.store');
        Route::post('/bank/update', [App\Http\Controllers\BankController::class, 'update'])
            ->name('banks.update');
        Route::post('/bank/update/status', [App\Http\Controllers\BankController::class, 'updateStatus'])
            ->name('banks.update.status');
        Route::post('/bank/destroy/{bank_id}', [App\Http\Controllers\BankController::class, 'destroy'])
            ->name('banks.destroy');
    });
});
Route::get('/data', [\App\Http\Controllers\DataController::class, 'getData']);