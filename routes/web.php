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
    $informations = \App\Models\Information::where('active', 1)->get();
    $count = $informations->count();
    return view('welcome', compact('count'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home')
    ->middleware('permission:access_dashboard');
Route::get('/preguntas/frecuentes', [App\Http\Controllers\LandingController::class, 'faqs'])
    ->name('faqs');
Route::get('/terminos/condiciones/{filename}', [App\Http\Controllers\LandingController::class, 'termsAndConditions'])
    ->name('term.and.conditions');
Route::get('/politicas/privacidad/{filename}', [App\Http\Controllers\LandingController::class, 'privacyPolicy'])
    ->name('privacy.policy');
Route::get('/get/data/informations', [App\Http\Controllers\InformationController::class, 'getDataInformations']);


// TODO: Rutas extras de departamentos/Provincias/Distritos
Route::get('/get/province/of/department/{department_id}', [App\Http\Controllers\UserController::class, 'getProvincesOfDepartment']);
Route::get('/get/district/of/province/{province_id}', [App\Http\Controllers\UserController::class, 'getDistrictsOfProvince']);
// TODO: Rutas extras de actividades y sectores
Route::get('/get/activities/of/sector/{sector_id}', [App\Http\Controllers\UserController::class, 'getActivitiesOfSector']);

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
            ->name('dashboard.graphs.Dolareros')
            ->middleware('permission:dolareros_menuGraphs');
        Route::get('/graficos/Kambista', [App\Http\Controllers\GraphController::class, 'indexKambista'])
            ->name('dashboard.graphs.Kambista')
            ->middleware('permission:dolareros_menuGraphs');
        Route::get('/graficos/Bloomberg', [App\Http\Controllers\GraphController::class, 'indexBloomberg'])
            ->name('dashboard.graphs.Bloomberg')
            ->middleware('permission:bloomberg_menuGraphs');
        Route::get('/graficos/Google', [App\Http\Controllers\GraphController::class, 'indexGoogle'])
            ->name('dashboard.graphs.Google')
            ->middleware('permission:google_menuGraphs');
        Route::get('/graficos/Cocosylucas', [App\Http\Controllers\GraphController::class, 'indexCocosylucas'])
            ->name('dashboard.graphs.Cocosylucas')
            ->middleware('permission:cocosylucas_menuGraphs');
        Route::get('/graficos/TKambio', [App\Http\Controllers\GraphController::class, 'indexTKambio'])
            ->name('dashboard.graphs.TKambio')
            ->middleware('permission:tkambio_menuGraphs');
        Route::get('/graficos/SecuEx', [App\Http\Controllers\GraphController::class, 'indexSecuEx'])
            ->name('dashboard.graphs.SecuEx')
            ->middleware('permission:secuEx_menuGraphs');

        // TODO: Rutas BackOffice - Accounts Dolareros
        Route::get('/cuentas/dolareros', [App\Http\Controllers\AccountDolareroController::class, 'index'])
            ->name('accounts.dolareros.index')
            ->middleware('permission:list_accountDolareros');
        Route::post('/account/store', [App\Http\Controllers\AccountDolareroController::class, 'store'])
            ->name('accounts.store')
            ->middleware('permission:create_accountDolareros');
        Route::post('/account/update', [App\Http\Controllers\AccountDolareroController::class, 'update'])
            ->name('accounts.update')
            ->middleware('permission:update_accountDolareros');
        Route::post('/account/update/status', [App\Http\Controllers\AccountDolareroController::class, 'updateStatus'])
            ->name('accounts.update.status')
            ->middleware('permission:update_accountDolareros');
        Route::post('/account/update/apply/interbank', [App\Http\Controllers\AccountDolareroController::class, 'updateApplyInterbank'])
            ->name('accounts.update.apply.interbank')
            ->middleware('permission:update_accountDolareros');
        Route::post('/account/destroy/{account_id}', [App\Http\Controllers\AccountDolareroController::class, 'destroy'])
            ->name('accounts.destroy')
            ->middleware('permission:destroy_accountDolareros');

        // TODO: Rutas BackOffice - Banks
        Route::get('/bancos', [App\Http\Controllers\BankController::class, 'index'])
            ->name('banks.index')
            ->middleware('permission:list_banks');
        Route::post('/bank/store', [App\Http\Controllers\BankController::class, 'store'])
            ->name('banks.store')
            ->middleware('permission:create_banks');
        Route::post('/bank/update', [App\Http\Controllers\BankController::class, 'update'])
            ->name('banks.update')
            ->middleware('permission:update_banks');
        Route::post('/bank/update/status', [App\Http\Controllers\BankController::class, 'updateStatus'])
            ->name('banks.update.status')
            ->middleware('permission:update_banks');
        Route::post('/bank/destroy/{bank_id}', [App\Http\Controllers\BankController::class, 'destroy'])
            ->name('banks.destroy')
            ->middleware('permission:destroy_banks');

        // TODO: Rutas BackOffice - SourceFunds
        Route::get('/fuente/fondos', [App\Http\Controllers\SourceFundController::class, 'index'])
            ->name('sourceFunds.index')
            ->middleware('permission:list_sourceFunds');
        Route::post('/sourceFund/store', [App\Http\Controllers\SourceFundController::class, 'store'])
            ->name('sourceFunds.store')
            ->middleware('permission:create_sourceFunds');
        Route::post('/sourceFund/update', [App\Http\Controllers\SourceFundController::class, 'update'])
            ->name('sourceFunds.update')
            ->middleware('permission:update_sourceFunds');
        Route::post('/sourceFund/destroy/{source_id}', [App\Http\Controllers\SourceFundController::class, 'destroy'])
            ->name('sourceFunds.destroy')
            ->middleware('permission:destroy_sourceFunds');

        // TODO: Rutas de cuentas para clientes
        Route::get('/verificar/codigo/{id}', [App\Http\Controllers\CodeController::class, 'index'])
            ->name('code.index');

        Route::post('/verification/code/{url}', [App\Http\Controllers\CodeController::class, 'verification'])
            ->name('code.verification');

        Route::middleware(['code'])->group(function () {
            Route::get('/mis/cuentas', [App\Http\Controllers\AccountCustomerController::class, 'index'])
                ->name('accountCustomer.index')
                ->middleware('permission:list_myAccounts');
            Route::post('/account/customer/store', [App\Http\Controllers\AccountCustomerController::class, 'store'])
                ->name('accounts.customer.store')
                ->middleware('permission:create_myAccounts');
            Route::post('/account/customer/update', [App\Http\Controllers\AccountCustomerController::class, 'update'])
                ->name('accounts.customer.update')
                ->middleware('permission:update_myAccounts');
            Route::post('/account/customer/update/status', [App\Http\Controllers\AccountCustomerController::class, 'updateStatus'])
                ->name('accounts.customer.update.status')
                ->middleware('permission:update_myAccounts');
            Route::post('/account/customer/destroy/{account_id}', [App\Http\Controllers\AccountCustomerController::class, 'destroy'])
                ->name('accounts.customer.destroy')
                ->middleware('permission:destroy_myAccounts');


            Route::get('/mis/operaciones', [App\Http\Controllers\OperationController::class, 'index'])
                ->name('operationCustomer.index')
                ->middleware('permission:list_myOperations');
        });

        Route::post('/generate/operation', [App\Http\Controllers\OperationController::class, 'generate'])
            ->name('operation.generate')
            ->middleware('permission:list_myOperations');

        Route::get('/crear/operacion', [App\Http\Controllers\OperationController::class, 'create'])
            ->name('operation.create')
            ->middleware('permission:create_myOperations');

        Route::post('/save/operation/stop', [App\Http\Controllers\OperationController::class, 'save'])
            ->name('save.operation.stop')
            ->middleware('permission:create_myOperations');

        Route::post('/account/customer/operation/store', [App\Http\Controllers\AccountCustomerController::class, 'store'])
            ->name('accounts.customer.operation.store')
            ->middleware('permission:create_myOperations');

        Route::get('/get/operation/pending', [App\Http\Controllers\OperationController::class, 'getOperationPending'])
            ->name('get.operation.pending')
            ->middleware('permission:list_myOperations');

        Route::post('/cancel/operation/pending', [App\Http\Controllers\OperationController::class, 'cancelOperationPending'])
            ->name('cancel.operation.pending')
            ->middleware('permission:list_myOperations');

        Route::post('/save/operation/real', [App\Http\Controllers\OperationController::class, 'saveOperationReal'])
            ->name('save.operation.real')
            ->middleware('permission:create_myOperations');

        Route::get('/get/info/operation/{operation_id}', [App\Http\Controllers\OperationController::class, 'getInfoOperation'])
            ->name('get.info.operation')
            ->middleware('permission:details_myOperations');

        Route::get('/download/image/operation/{operation_id}', [App\Http\Controllers\OperationController::class, 'downloadImageOperation'])
            ->name('download.image.operation')
            ->middleware('permission:create_myOperations');

        Route::get('/get/receipt/operation/{operation_id}', [App\Http\Controllers\OperationController::class, 'getReceiptOperation'])
            ->name('get.receipt.operation')
            ->middleware('permission:receipt_myOperations');

        Route::get('/get/refused/operation/{operation_id}', [App\Http\Controllers\OperationController::class, 'getRefusedOperation'])
            ->name('get.refused.operation')
            ->middleware('permission:refusedOperation_manageOperations');

        Route::get('/listado/operaciones', [App\Http\Controllers\OperationController::class, 'indexDolareros'])
            ->name('operation.dolareros.index')
            ->middleware('permission:list_manageOperations');

        Route::post('/save/refused/operation', [App\Http\Controllers\OperationController::class, 'saveRefusedOperation'])
            ->name('save.refused.operation')
            ->middleware('permission:refusedOperation_manageOperations');

        Route::post('/save/receipt/operation', [App\Http\Controllers\OperationController::class, 'saveRegisterReceipt'])
            ->name('save.receipt.operation')
            ->middleware('permission:receiptOperation_manageOperations');

        Route::post('/update/receipt/operation', [App\Http\Controllers\OperationController::class, 'updateRegisterReceipt'])
            ->name('update.receipt.operation')
            ->middleware('permission:changeReceiptOperation_manageOperations');

        // TODO: Rutas BackOffice - Permissions
        Route::get('/permisos', [App\Http\Controllers\PermissionController::class, 'index'])
            ->name('permissions.index')
            ->middleware('permission:list_permission');
        Route::post('/permission/store', [App\Http\Controllers\PermissionController::class, 'store'])
            ->name('permissions.store')
            ->middleware('permission:create_permission');
        Route::post('/permission/update', [App\Http\Controllers\PermissionController::class, 'update'])
            ->name('permissions.update')
            ->middleware('permission:update_permission');
        Route::post('/permission/destroy/{permission_id}', [App\Http\Controllers\PermissionController::class, 'destroy'])
            ->name('permission.destroy')
            ->middleware('permission:destroy_permission');

        // TODO: Rutas BackOffice - Roles
        Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])
            ->name('roles.index')
            ->middleware('permission:list_role');
        Route::get('/crear/rol', [App\Http\Controllers\RoleController::class, 'create'])
            ->name('roles.create')
            ->middleware('permission:create_role');
        Route::get('/modificar/rol/{role_id}', [App\Http\Controllers\RoleController::class, 'edit'])
            ->name('roles.edit')
            ->middleware('permission:update_role');
        Route::post('/role/store', [App\Http\Controllers\RoleController::class, 'store'])
            ->name('roles.store')
            ->middleware('permission:create_role');
        Route::post('/role/update', [App\Http\Controllers\RoleController::class, 'update'])
            ->name('roles.update')
            ->middleware('permission:update_role');
        Route::post('/role/destroy/{role_id}', [App\Http\Controllers\RoleController::class, 'destroy'])
            ->name('roles.destroy')
            ->middleware('permission:destroy_role');

        // TODO: Rutas BackOffice - Users
        Route::get('/get/data/users/{numberPage}', [App\Http\Controllers\UserController::class, 'getDataUser'])
            ->middleware('permission:list_user');
        Route::get('/lista/usuarios', [App\Http\Controllers\UserController::class, 'listUsers'])
            ->name('users.list')
            ->middleware('permission:list_user');
        Route::get('/usuarios/activos', [App\Http\Controllers\UserController::class, 'listUsers'])
            ->name('users.index')
            ->middleware('permission:list_user');
        Route::post('/user/store', [App\Http\Controllers\UserController::class, 'store'])
            ->name('users.store')
            ->middleware('permission:create_user');
        Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update'])
            ->name('users.update')
            ->middleware('permission:update_user');
        Route::post('/user/destroy/{user_id}', [App\Http\Controllers\UserController::class, 'destroy'])
            ->name('users.destroy')
            ->middleware('permission:destroy_user');
        Route::get('/usuario/detalles/{user_id}', [App\Http\Controllers\UserController::class, 'show'])
            ->name('users.show')
            ->middleware('permission:list_user');
        Route::post('/user/reset/token/secret/{user_id}', [App\Http\Controllers\UserController::class, 'resetTokenSecret'])
            ->name('users.reset.token.secret')
            ->middleware('permission:update_user');
        Route::get('/get/data/account/{user_id}/{numberPage}', [App\Http\Controllers\UserController::class, 'getDataAccountUsers'])
            ->middleware('permission:update_user');
        Route::get('/get/data/operation/{user_id}/{numberPage}', [App\Http\Controllers\UserController::class, 'getDataOperationUsers'])
            ->middleware('permission:update_user');


        // TODO: Rutas de Imagenes de documentos de Usuarios
        Route::post('/submit/image/front/', [App\Http\Controllers\UserController::class, 'submitImageFront'])
            ->name('submit.image.front');
        Route::post('/submit/image/reverse/', [App\Http\Controllers\UserController::class, 'submitImageReverse'])
            ->name('submit.image.reverse');

        // TODO: Rutas BackOffice - Verification Images
        Route::get('/usuarios/no/verificados', [App\Http\Controllers\UserController::class, 'indexUserVerificationImages'])
            ->name('verification.images.users');
        Route::get('/verificar/usuarios/imagenes/{user_id}', [App\Http\Controllers\UserController::class, 'userVerificationImages'])
            ->name('users.showImages');
        Route::post('/verify/image/front/{user_id}', [App\Http\Controllers\UserController::class, 'verifyImageFront'])
            ->name('verify.image.front');
        Route::post('/verify/image/reverse/{user_id}', [App\Http\Controllers\UserController::class, 'verifyImageReverse'])
            ->name('verify.image.reverse');
        Route::post('/refuse/image/front/{user_id}', [App\Http\Controllers\UserController::class, 'refuseImageFront'])
            ->name('refuse.image.front');
        Route::post('/refuse/image/reverse/{user_id}', [App\Http\Controllers\UserController::class, 'refuseImageReverse'])
            ->name('refuse.image.reverse');

        // TODO: Ruta de verificacion de usuario al ingresar
        Route::get('/get/user/alert', [App\Http\Controllers\UserController::class, 'getUserAlert'])
            ->name('get.user.alert');

        // TODO: Rutas BackOffice - Coupons
        Route::get('/cupones', [App\Http\Controllers\CouponController::class, 'index'])
            ->name('coupon.index')
            ->middleware('permission:list_coupons');
        Route::post('/coupon/store', [App\Http\Controllers\CouponController::class, 'store'])
            ->name('coupon.store')
            ->middleware('permission:create_coupons');
        Route::post('/coupon/update', [App\Http\Controllers\CouponController::class, 'update'])
            ->name('coupon.update')
            ->middleware('permission:update_coupons');
        Route::post('/coupon/destroy/{coupon_id}', [App\Http\Controllers\CouponController::class, 'destroy'])
            ->name('coupon.destroy')
            ->middleware('permission:destroy_coupons');
        Route::post('/assign/coupon/user', [App\Http\Controllers\CouponController::class, 'assign'])
            ->name('coupon.assign')
            ->middleware('permission:assign_coupons');
        Route::post('/coupon/update/status', [App\Http\Controllers\CouponController::class, 'updateStatus'])
            ->name('coupon.update.status')
            ->middleware('permission:update_coupons');
        Route::post('/coupon/update/special', [App\Http\Controllers\CouponController::class, 'updateSpecial'])
            ->name('coupon.update.special')
            ->middleware('permission:update_coupons');
        Route::get('/get/user/coupon/{idCoupon}', [App\Http\Controllers\CouponController::class, 'getUserCoupon'])
            ->name('get.user.coupon');
        Route::get('/get/user/document', [App\Http\Controllers\CouponController::class, 'getUserDocument'])
            ->name('get.user.document');
        Route::get('/get/data/coupon', [App\Http\Controllers\CouponController::class, 'getDataCoupon'])
            ->name('get.data.coupon');
        Route::get('/get/user/assign/coupon', [App\Http\Controllers\CouponController::class, 'getUserCouponAssign'])
            ->name('get.user.coupon.assign');

        // TODO: Schedule
        Route::get('/horario/atencion', [App\Http\Controllers\ScheduleController::class, 'index'])
            ->name('schedule.index')
            ->middleware('permission:list_schedule');
        Route::post('/schedule/store', [App\Http\Controllers\ScheduleController::class, 'store'])
            ->name('schedule.store')
            ->middleware('permission:create_schedule');
        Route::post('/schedule/update/active', [App\Http\Controllers\ScheduleController::class, 'updateStatus'])
            ->name('schedule.update.active')
            ->middleware('permission:update_schedule');
        Route::post('/schedule/destroy/{schedule_id}', [App\Http\Controllers\ScheduleController::class, 'destroy'])
            ->name('schedule.destroy')
            ->middleware('permission:destroy_schedule');
        Route::post('/schedule/update', [App\Http\Controllers\ScheduleController::class, 'update'])
            ->name('schedule.update')
            ->middleware('permission:update_schedule');
        Route::post('/button/turn/off/update', [App\Http\Controllers\ScheduleController::class, 'buttonTurnOffUpdate'])
            ->name('button.turn.off.update')
            ->middleware('permission:update_schedule');

        // TODO: TypeExchange
        Route::get('/configurar/tipo/cambio', [App\Http\Controllers\TypeExchangeController::class, 'index'])
            ->name('typeExchange.index')
            ->middleware('permission:enable_typeExchange');
        Route::post('/typeExchange/store', [App\Http\Controllers\TypeExchangeController::class, 'store'])
            ->name('typeExchange.store')
            ->middleware('permission:save_typeExchange');
        Route::post('/typeExchange/tcManual/update', [App\Http\Controllers\TypeExchangeController::class, 'updateTcManual'])
            ->name('typeExchange.tcManual.update')
            ->middleware('permission:change_typeExchange');

        // TODO: Rutas Contabilidad
        Route::get('/get/data/accounting/{numberPage}', [App\Http\Controllers\AccountingController::class, 'getDataContabilidad']);
        Route::get('/modulo/contabilidad', [App\Http\Controllers\AccountingController::class, 'index'])
            ->name('accounting.index')
            ->middleware('permission:enable_typeExchange');

        // TODO: Rutas BackOffice - Informations
        Route::get('/noticias', [App\Http\Controllers\InformationController::class, 'index'])
            ->name('information.index')
            ->middleware('permission:list_informations');
        Route::post('/information/store', [App\Http\Controllers\InformationController::class, 'store'])
            ->name('information.store')
            ->middleware('permission:create_informations');
        Route::post('/information/destroy/{information_id}', [App\Http\Controllers\InformationController::class, 'destroy'])
            ->name('information.destroy')
            ->middleware('permission:destroy_informations');
        Route::post('/information/update/status', [App\Http\Controllers\InformationController::class, 'updateStatus'])
            ->name('information.update.status')
            ->middleware('permission:update_informations');
    });
});
Route::get('/data', [\App\Http\Controllers\DataController::class, 'getData']);
Route::get('/get/hash', [\App\Http\Controllers\DataController::class, 'getHash']);
Route::get('/telegram/send', [\App\Http\Controllers\TelegramController::class, 'sendMessage']);