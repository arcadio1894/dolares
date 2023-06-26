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

        // TODO: Rutas BackOffice - SourceFunds
        Route::get('/fuente/fondos', [App\Http\Controllers\SourceFundController::class, 'index'])
            ->name('sourceFunds.index');
        Route::post('/sourceFund/store', [App\Http\Controllers\SourceFundController::class, 'store'])
            ->name('sourceFunds.store');
        Route::post('/sourceFund/update', [App\Http\Controllers\SourceFundController::class, 'update'])
            ->name('sourceFunds.update');
        Route::post('/sourceFund/destroy/{source_id}', [App\Http\Controllers\SourceFundController::class, 'destroy'])
            ->name('sourceFunds.destroy');

        // TODO: Rutas de cuentas para clientes
        Route::get('/verificar/codigo/{id}', [App\Http\Controllers\CodeController::class, 'index'])
            ->name('code.index');

        Route::post('/verification/code/{url}', [App\Http\Controllers\CodeController::class, 'verification'])
            ->name('code.verification');

        Route::middleware(['code'])->group(function () {
            Route::get('/mis/cuentas', [App\Http\Controllers\AccountCustomerController::class, 'index'])
                ->name('accountCustomer.index');
            Route::post('/account/customer/store', [App\Http\Controllers\AccountCustomerController::class, 'store'])
                ->name('accounts.customer.store');
            Route::post('/account/customer/update', [App\Http\Controllers\AccountCustomerController::class, 'update'])
                ->name('accounts.customer.update');
            Route::post('/account/customer/update/status', [App\Http\Controllers\AccountCustomerController::class, 'updateStatus'])
                ->name('accounts.customer.update.status');
            Route::post('/account/customer/destroy/{account_id}', [App\Http\Controllers\AccountCustomerController::class, 'destroy'])
                ->name('accounts.customer.destroy');


            Route::get('/mis/operaciones', [App\Http\Controllers\OperationController::class, 'index'])
                ->name('operationCustomer.index');
        });

        Route::post('/generate/operation', [App\Http\Controllers\OperationController::class, 'generate'])
            ->name('operation.generate');

        Route::get('/crear/operacion', [App\Http\Controllers\OperationController::class, 'create'])
            ->name('operation.create');

        Route::post('/save/operation/stop', [App\Http\Controllers\OperationController::class, 'save'])
            ->name('save.operation.stop');

        Route::post('/account/customer/operation/store', [App\Http\Controllers\AccountCustomerController::class, 'store'])
            ->name('accounts.customer.operation.store');

        Route::get('/get/operation/pending', [App\Http\Controllers\OperationController::class, 'getOperationPending'])
            ->name('get.operation.pending');

        Route::post('/cancel/operation/pending', [App\Http\Controllers\OperationController::class, 'cancelOperationPending'])
            ->name('cancel.operation.pending');

        Route::post('/save/operation/real', [App\Http\Controllers\OperationController::class, 'saveOperationReal'])
            ->name('save.operation.real');

        Route::get('/get/info/operation/{operation_id}', [App\Http\Controllers\OperationController::class, 'getInfoOperation'])
            ->name('get.info.operation');

        Route::get('/download/image/operation/{operation_id}', [App\Http\Controllers\OperationController::class, 'downloadImageOperation'])
            ->name('download.image.operation');

        Route::get('/get/receipt/operation/{operation_id}', [App\Http\Controllers\OperationController::class, 'getReceiptOperation'])
            ->name('get.receipt.operation');

        Route::get('/get/refused/operation/{operation_id}', [App\Http\Controllers\OperationController::class, 'getRefusedOperation'])
            ->name('get.refused.operation');

        Route::get('/listado/operaciones', [App\Http\Controllers\OperationController::class, 'indexDolareros'])
            ->name('operation.dolareros.index');

        Route::post('/save/refused/operation', [App\Http\Controllers\OperationController::class, 'saveRefusedOperation'])
            ->name('save.refused.operation');

        Route::post('/save/receipt/operation', [App\Http\Controllers\OperationController::class, 'saveRegisterReceipt'])
            ->name('save.receipt.operation');

        Route::post('/update/receipt/operation', [App\Http\Controllers\OperationController::class, 'updateRegisterReceipt'])
            ->name('update.receipt.operation');

        // TODO: Rutas BackOffice - Permissions
        Route::get('/permisos', [App\Http\Controllers\PermissionController::class, 'index'])
            ->name('permissions.index');
        Route::post('/permission/store', [App\Http\Controllers\PermissionController::class, 'store'])
            ->name('permissions.store');
        Route::post('/permission/update', [App\Http\Controllers\PermissionController::class, 'update'])
            ->name('permissions.update');
        Route::post('/permission/destroy/{permission_id}', [App\Http\Controllers\PermissionController::class, 'destroy'])
            ->name('permission.destroy');

        // TODO: Rutas BackOffice - Roles
        Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])
            ->name('roles.index');
        Route::get('/crear/rol', [App\Http\Controllers\RoleController::class, 'create'])
            ->name('roles.create');
        Route::get('/modificar/rol/{role_id}', [App\Http\Controllers\RoleController::class, 'edit'])
            ->name('roles.edit');
        Route::post('/role/store', [App\Http\Controllers\RoleController::class, 'store'])
            ->name('roles.store');
        Route::post('/role/update', [App\Http\Controllers\RoleController::class, 'update'])
            ->name('roles.update');
        Route::post('/role/destroy/{role_id}', [App\Http\Controllers\RoleController::class, 'destroy'])
            ->name('roles.destroy');

        // TODO: Rutas BackOffice - Users
        Route::get('/usuarios/activos', [App\Http\Controllers\UserController::class, 'index'])
            ->name('users.index');
        Route::post('/user/store', [App\Http\Controllers\UserController::class, 'store'])
            ->name('users.store');
        Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update'])
            ->name('users.update');
        Route::post('/user/destroy/{user_id}', [App\Http\Controllers\UserController::class, 'destroy'])
            ->name('users.destroy');
        Route::get('/usuario/detalles/{user_id}', [App\Http\Controllers\UserController::class, 'show'])
            ->name('users.show');
    });
});
Route::get('/data', [\App\Http\Controllers\DataController::class, 'getData']);
Route::get('/get/hash', [\App\Http\Controllers\DataController::class, 'getHash']);