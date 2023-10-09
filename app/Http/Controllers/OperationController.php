<?php

namespace App\Http\Controllers;

use App\Models\AccountCustomer;
use App\Models\AccountDolarero;
use App\Models\Accounting;
use App\Models\Bank;
use App\Models\Coupon;
use App\Models\DataGeneral;
use App\Models\Department;
use App\Models\Operation;
use App\Models\Rejection;
use App\Models\Schedule;
use App\Models\SourceFund;
use App\Models\StopData;
use App\Models\StopOperation;
use App\Models\User;
use App\Models\UserCoupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class OperationController extends Controller
{
    public function index()
    {
        $operations = Operation::where('user_id', Auth::id())
            ->orderBy('state')
            ->orderBy('created_at', 'DESC')
            ->get();

        /*$arrayOperations = [];

        foreach ( $operations as $operation )
        {
            array_push( $arrayOperations, [
                "id" => $operation->id,
                "numberOperation" => $operation->code_operation,
                "sendAmount" => $operation->send_amount_list,
                "getAmount" => $operation->getAmountList,
                "change" => $operation->type_change,
                "fecha" => $operation->created_at->format('d/m/Y')
            ]);
        }*/

        return view('operation.indexCustomer', compact('operations'));

    }

    public function getOperationsCustomers()
    {
        $operations = Operation::where('user_id', Auth::id())
            ->orderBy('state')
            ->orderBy('created_at', 'DESC')
            ->get();

        $arrayOperations = [];

        foreach ( $operations as $operation )
        {
            array_push( $arrayOperations, [
                "id" => $operation->id,
                "numberOperation" => $operation->code_operation,
                "sendAmount" => $operation->send_amount_list,
                "getAmount" => $operation->getAmountList,
                "change" => $operation->type_change,
                "fecha" => $operation->created_at->format('d/m/Y')
            ]);
        }

        return response()->json([
            "operations" => $arrayOperations
        ], 200);
    }

    public function generate(Request $request)
    {
        $getAmount = $request->get('getAmount');
        $sendAmount = $request->get('sendAmount');
        $type = $request->get('type');
        $ahorro = $request->get('ahorro');

        $user = User::find(Auth::id());

        $buttonTurnOff = DataGeneral::where('name', 'buttonTurnOff')->first();

        if ( $buttonTurnOff->valueNumber == 0 )
        {
            return response()->json([
                'error' => 'Lo sentimos. Estamos experimentando problemas, intentalo mas tarde.',
                'flag' => false,
                'type' => 'schedule'
            ], 200);
        }

        if ( $user->front_image == null && $user->reverse_image==null )
        {
            $ruta = route("dashboard.profile");
            return response()->json([
                'error' => 'Falta completar tus datos, dirígete a tu perfil para continuar.',
                'flag' => false,
                'type' => 'info',
                'url' => $ruta
            ], 200);
        }

        if ( $user->flag_front != 1 && $user->flag_reverse != 1 )
        {
            $ruta = route("dashboard.profile");
            return response()->json([
                'error' => 'Estamos validando tu información personal, éste paso sólo nos tomará unos minutos, Dirígete a tu perfil para dar seguimiento a tu solicitud.',
                'flag' => false,
                'type' => 'info',
                'url' => $ruta
            ], 200);
        }

        $currentDate = Carbon::now('America/Lima');

        $dayOfWeek = $currentDate->dayOfWeek;

        if ($dayOfWeek >= 1 && $dayOfWeek <= 5) {
            // Acción para días de semana (Lunes a Viernes)
            $schedule = Schedule::where('day', 1)->first();
            if ($schedule) {
                // Obtener la hora actual
                $currentTime = Carbon::now('America/Lima')->format('H:i:s');
                $start = Carbon::createFromFormat('H:i:s', $schedule->hourStart)->format('H:i:s');
                $end = Carbon::createFromFormat('H:i:s', $schedule->hourEnd)->format('H:i:s');

                // Verificar si la hora actual está dentro del rango
                if (!($currentTime >= $start && $currentTime <= $end)) {
                    // La hora actual está fuera del horario
                    return response()->json([
                        'error' => 'Lo sentimos en estos momentos no estamos dentro del horario de atención.',
                        'flag' => false,
                        'type' => 'schedule'
                    ], 200);
                }
            }
        } elseif ($dayOfWeek === 6) {
            // Acción para Sábado
            $schedule = Schedule::where('day', 6)->first();
            if ($schedule) {
                // Obtener la hora actual
                $currentTime = Carbon::now('America/Lima')->format('H:i:s');
                $start = Carbon::createFromFormat('H:i:s', $schedule->hourStart)->format('H:i:s');
                $end = Carbon::createFromFormat('H:i:s', $schedule->hourEnd)->format('H:i:s');

                // Verificar si la hora actual está dentro del rango
                if (!($currentTime >= $start && $currentTime <= $end)) {
                    // La hora actual está fuera del horario
                    return response()->json([
                        'error' => 'Lo sentimos en estos momentos no estamos dentro del horario de atención.',
                        'flag' => false,
                        'type' => 'schedule'
                    ], 200);
                }
            }
        } else {
            // Acción para Domingo
            $schedule = Schedule::where('day', 7)->first();
            if ($schedule) {
                // Obtener la hora actual
                $currentTime = Carbon::now('America/Lima')->format('H:i:s');
                $start = Carbon::createFromFormat('H:i:s', $schedule->hourStart)->format('H:i:s');
                $end = Carbon::createFromFormat('H:i:s', $schedule->hourEnd)->format('H:i:s');

                // Verificar si la hora actual está dentro del rango
                if (!($currentTime >= $start && $currentTime <= $end)) {
                    // La hora actual está fuera del horario
                    return response()->json([
                        'error' => 'Lo sentimos en estos momentos no estamos dentro del horario de atención.',
                        'flag' => false,
                        'type' => 'schedule'
                    ], 200);
                }
            }
        }

        DB::beginTransaction();
        try {

            // Actualizar el  StopData si hay
            $stopData = StopData::where('user_id', Auth::id())->first();
            if ( isset($stopData) )
            {
                $stopData->getAmount = (float) $getAmount;
                $stopData->sendAmount = (float) $sendAmount;
                $stopData->type = $type;
                $stopData->ahorro = $ahorro;
                $stopData->save();
            }

            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Redireccionando a la operación.',
            'url' => route('operation.create')
        ], 200);
    }

    public function save( Request $request )
    {
        $bancoOrigen = $request->get('bancoOrigen');
        $cuentaDestinoId = $request->get('cuentaDestinoId');
        $sourceId = $request->get('sourceId');

        // TODO: Buscar el banco mas optimo que tenga el nombre, la moneda

        list($nameBank, $moneda, $departmento) = explode(" - ", $bancoOrigen);

        $department = Department::where('name', trim($departmento))->first();
        $bank = Bank::where('nameBank', 'like', '%'.trim($nameBank).'%')->first();
        $currency = (trim($moneda) == 'Soles') ? 'PEN':'USD';

        $accountsDolarero = AccountDolarero::where('currency', $currency)
            ->where('bank_id', $bank->id)
            ->where('department_id', $department->id)
            ->first();

        $accountsCustomer = AccountCustomer::find($cuentaDestinoId);

        $companyName = DataGeneral::where('name', 'companyName')->first();
        $companyRUC = DataGeneral::where('name', 'companyRUC')->first();
        $currencyAccount = ($accountsDolarero->currency == 'USD') ? 'Dólares':'Soles';
        $typeAccount = 'Cuenta Corriente';
        $bankAccount = $accountsDolarero->bank->name;
        $numberAccount = $accountsDolarero->numberAccount;
        $bankCustomer = $accountsDolarero->bank->name;
        $amountSend = 0;

        $nameBankOperationDeposit = $bankAccount;
        $title = "Número de cuenta";
        if ( $accountsDolarero->apply_interbank == 1 )
        {
            $banco = Bank::find(7);
            $nameBankOperationDeposit = $banco->name;
            $title = "Número de cuenta interbancario";
            $cuentaDeposit = AccountDolarero::where('currency', $currency)
                ->where('bank_id', $banco->id)
                ->first();
            $numberAccount = $cuentaDeposit->number_interbank;
        }

        DB::beginTransaction();
        try {

            // Crear el StopOperation si no hay, Si hay se elimina
            $stopOperation = StopOperation::where('user_id', Auth::id())->first();
            if ( isset($stopOperation) )
            {
                $cuentaDolarero = AccountDolarero::where('currency', $accountsCustomer->currency)
                    ->where('bank_id', $accountsCustomer->bank->id)
                    ->first();
                if ( isset($cuentaDeposit) ) // Osea es BBVA
                {
                    if ( $cuentaDolarero->balance < $stopOperation->getAmount )
                    {
                        return response()->json(['message' => "Lo sentimos, no podemos continuar con esta operación por el momento"], 422);
                    }
                } else {
                    if ( $cuentaDolarero->balance < $stopOperation->getAmount )
                    {
                        return response()->json(['message' => "Lo sentimos, no podemos continuar con esta operación por el momento"], 422);
                    }

                }
                ///$stopOperation->delete();
                $amountSend = number_format($stopOperation->sendAmount, 2, '.', ' ');
                //$stopData = StopData::where('user_id', Auth::id())->first();
                $stopOperation->account_dolarero_id = $accountsDolarero->id;
                $stopOperation->nameBankDolarero = $bancoOrigen;
                $stopOperation->account_customer_id = $cuentaDestinoId;
                $stopOperation->source_fund_id = $sourceId;
                $stopOperation->account_dolarero_real_id = (isset($cuentaDeposit)) ? $cuentaDeposit->id: null;
                $stopOperation->save();

                if ($stopOperation->account_dolarero_id == 15)
                {
                    $isYape = true;
                    $data = DataGeneral::where('name', 'qrYape')->first();
                    $qrYape = $data->valueText;
                } else {
                    $isYape = false;
                    $qrYape = '';
                }

            } else {

                $stopData = StopData::where('user_id', Auth::id())->first();

                $newStopOperation = StopOperation::create([
                    'user_id' => $stopData->user_id,
                    'buyStop' => $stopData->buyStop,
                    'sellStop' => $stopData->sellStop,
                    'buyControl' => $stopData->buyControl,
                    'sellControl' => $stopData->sellControl,
                    'token' => $stopData->token,
                    'coupon_id' => $stopData->coupon_id,
                    'type' => $stopData->type,
                    'ahorro' => $stopData->ahorro,
                    'sendAmount' => $stopData->sendAmount,
                    'getAmount' => $stopData->getAmount,
                    'account_dolarero_id' => $accountsDolarero->id,
                    'nameBankDolarero' => $bancoOrigen,
                    'account_customer_id' => $cuentaDestinoId,
                    'source_fund_id' => $sourceId,
                    'account_dolarero_real_id' => (isset($cuentaDeposit)) ? $cuentaDeposit->id: null,
                ]);

                $amountSend = number_format($newStopOperation->sendAmount, 2, '.', ' ');

                if ($newStopOperation->account_dolarero_id == 15)
                {
                    $isYape = true;
                    $data = DataGeneral::where('name', 'qrYape')->first();
                    $qrYape = $data->valueText;
                } else {
                    $isYape = false;
                    $qrYape = '';
                }
            }

            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Operación guardada.',
            'companyName' => $companyName->valueText,
            'companyRUC' => $companyRUC->valueText,
            'typeAccount' => $typeAccount. ' - ' .$currencyAccount,
            'bankAccount' => $bankAccount,
            'numberAccount' => $numberAccount,
            'currencyAccount' => $currencyAccount,
            'amountSend' => $amountSend,
            'bankCustomer' => $bankCustomer,
            'nameBankOperationDeposit' => $nameBankOperationDeposit,
            'title' => $title,
            'isYape' => $isYape,
            'qrYape' => $qrYape
        ], 200);
    }

    public function create()
    {
        $stopOperation = StopOperation::with(['coupon', 'account_dolarero', 'account_customer', 'source_fund'])
            ->where('user_id', Auth::id())->first();

        $stopData = StopData::with('coupon')
            ->where('user_id', Auth::id())->first();
        if ( $stopOperation == null )
        {
            $banks = Bank::all();
            $sources = SourceFund::all();
            $departments = Department::all();

            if ( $stopData->type == 'buy' )
            {
                // Buy
                // TODO: Traer las cuentas de Dolareros en Dolares
                // TODO: Traer las cuentas del cliente en Soles
                $accountDolareros = AccountDolarero::where('currency', 'USD')
                    ->where('status', 1)
                    ->get();
                $accountCustomers = AccountCustomer::where('currency', 'PEN')
                    ->where('status', 1)
                    ->where('user_id', Auth::id())
                    ->get();

                $arrayAccountDolareros = [];
                foreach ( $accountDolareros as $accountDolarero )
                {
                    array_push($arrayAccountDolareros, [
                        "name" => $accountDolarero->bank->name.'- '.( ($accountDolarero->currency == 'USD') ? 'Dólares':'Soles' ).' - '.$accountDolarero->department->name,
                        "imageBank" => $accountDolarero->bank->imageBank,
                    ]);
                }

                $accountsDolareros = array();
                $clavesUnicas = array();

                foreach ($arrayAccountDolareros as $elemento) {
                    $clave1 = $elemento["name"];

                    if (!isset($clavesUnicas[$clave1])) {
                        $clavesUnicas[$clave1] = true;
                        $accountsDolareros[$clave1] = $elemento;
                    }
                }

                $accountsDolareros = array_values($accountsDolareros);

                $arrayAccountCustomers = [];
                foreach ( $accountCustomers as $accountCustomer )
                {
                    array_push($arrayAccountCustomers, [
                        "id" => $accountCustomer->id,
                        "nameAccount" => $accountCustomer->bank->name.'- '.( ($accountCustomer->currency == 'USD') ? 'Dólares':'Soles' ),
                        "numberAccount" => $accountCustomer->numberAccount,
                        "bankImage" => $accountCustomer->bank->imageBank
                    ]);
                }

            } else {
                // Sell
                // TODO: Traer las cuentas de Dolareros en Soles
                // TODO: Traer las cuentas del cliente en Dolares
                if ( $stopData->sendAmount < 500 ) {
                    $accountDolareros = AccountDolarero::where('currency', 'PEN')
                        ->where('status', 1)
                        ->get();
                } else {
                    $accountDolareros = AccountDolarero::where('currency', 'PEN')
                        ->where('status', 1)
                        ->where('bank_id', '<>',15)
                        ->get();
                }


                $accountCustomers = AccountCustomer::where('currency', 'USD')
                    ->where('status', 1)
                    ->where('user_id', Auth::id())
                    ->get();

                $arrayAccountDolareros = [];
                foreach ( $accountDolareros as $accountDolarero )
                {
                    array_push($arrayAccountDolareros, [
                        "name" => $accountDolarero->bank->name.'- '.( ($accountDolarero->currency == 'USD') ? 'Dólares':'Soles' ).' - '.$accountDolarero->department->name,
                        "imageBank" => $accountDolarero->bank->imageBank,
                    ]);
                }

                $accountsDolareros = array();
                $clavesUnicas = array();

                foreach ($arrayAccountDolareros as $elemento) {
                    $clave1 = $elemento["name"];

                    if (!isset($clavesUnicas[$clave1])) {
                        $clavesUnicas[$clave1] = true;
                        $accountsDolareros[$clave1] = $elemento;
                    }
                }

                $accountsDolareros = array_values($accountsDolareros);

                $arrayAccountCustomers = [];
                foreach ( $accountCustomers as $accountCustomer )
                {
                    array_push($arrayAccountCustomers, [
                        "id" => $accountCustomer->id,
                        "nameAccount" => $accountCustomer->bank->name.'- '.( ($accountCustomer->currency == 'USD') ? 'Dólares':'Soles' ),
                        "numberAccount" => $accountCustomer->numberAccount,
                        "bankImage" => $accountCustomer->bank->imageBank
                    ]);
                }
            }
        } else {
            $banks = Bank::all();
            $sources = SourceFund::all();
            $departments = Department::all();

            if ( $stopOperation->type == 'buy' )
            {
                // Buy
                // TODO: Traer las cuentas de Dolareros en Dolares
                // TODO: Traer las cuentas del cliente en Soles
                $accountDolareros = AccountDolarero::where('currency', 'USD')
                    ->where('status', 1)
                    ->get();
                $accountCustomers = AccountCustomer::where('currency', 'PEN')
                    ->where('status', 1)
                    ->where('user_id', Auth::id())
                    ->get();

                $arrayAccountDolareros = [];
                foreach ( $accountDolareros as $accountDolarero )
                {
                    array_push($arrayAccountDolareros, [
                        "name" => $accountDolarero->bank->name.'- '.( ($accountDolarero->currency == 'USD') ? 'Dólares':'Soles' ).' - '.$accountDolarero->department->name,
                        "imageBank" => $accountDolarero->bank->imageBank,
                    ]);
                }

                $accountsDolareros = array();
                $clavesUnicas = array();

                foreach ($arrayAccountDolareros as $elemento) {
                    $clave1 = $elemento["name"];

                    if (!isset($clavesUnicas[$clave1])) {
                        $clavesUnicas[$clave1] = true;
                        $accountsDolareros[$clave1] = $elemento;
                    }
                }

                $accountsDolareros = array_values($accountsDolareros);

                $arrayAccountCustomers = [];
                foreach ( $accountCustomers as $accountCustomer )
                {
                    array_push($arrayAccountCustomers, [
                        "id" => $accountCustomer->id,
                        "nameAccount" => $accountCustomer->bank->name.'- '.( ($accountCustomer->currency == 'USD') ? 'Dólares':'Soles' ),
                        "numberAccount" => $accountCustomer->numberAccount,
                        "bankImage" => $accountCustomer->bank->imageBank
                    ]);
                }

            } else {
                // Sell
                // TODO: Traer las cuentas de Dolareros en Soles
                // TODO: Traer las cuentas del cliente en Dolares
                if ( $stopOperation->sendAmount < 500 ) {
                    $accountDolareros = AccountDolarero::where('currency', 'PEN')
                        ->where('status', 1)
                        ->get();
                } else {
                    $accountDolareros = AccountDolarero::where('currency', 'PEN')
                        ->where('status', 1)
                        ->where('bank_id', '<>',15)
                        ->get();
                }
                /*$accountDolareros = AccountDolarero::where('currency', 'PEN')
                    ->where('status', 1)
                    ->get();*/
                $accountCustomers = AccountCustomer::where('currency', 'USD')
                    ->where('status', 1)
                    ->where('user_id', Auth::id())
                    ->get();

                $arrayAccountDolareros = [];
                foreach ( $accountDolareros as $accountDolarero )
                {
                    array_push($arrayAccountDolareros, [
                        "name" => $accountDolarero->bank->name.'- '.( ($accountDolarero->currency == 'USD') ? 'Dólares':'Soles' ).' - '.$accountDolarero->department->name,
                        "imageBank" => $accountDolarero->bank->imageBank,
                    ]);
                }

                $accountsDolareros = array();
                $clavesUnicas = array();

                foreach ($arrayAccountDolareros as $elemento) {
                    $clave1 = $elemento["name"];

                    if (!isset($clavesUnicas[$clave1])) {
                        $clavesUnicas[$clave1] = true;
                        $accountsDolareros[$clave1] = $elemento;
                    }
                }

                $accountsDolareros = array_values($accountsDolareros);

                $arrayAccountCustomers = [];
                foreach ( $accountCustomers as $accountCustomer )
                {
                    array_push($arrayAccountCustomers, [
                        "id" => $accountCustomer->id,
                        "nameAccount" => $accountCustomer->bank->name.'- '.( ($accountCustomer->currency == 'USD') ? 'Dólares':'Soles' ),
                        "numberAccount" => $accountCustomer->numberAccount,
                        "bankImage" => $accountCustomer->bank->imageBank
                    ]);
                }
            }
        }

        return view('operation.create', compact('stopData', 'stopOperation', 'banks', 'sources', 'accountsDolareros', 'arrayAccountCustomers', 'departments'));
    }

    public function getOperationPending()
    {
        $stopOperation = StopOperation::where('user_id', Auth::id())->first();

        return response()->json([
            'stopOperation' => $stopOperation,
            'url' => route('operation.create')
        ], 200);
    }

    public function cancelOperationPending(Request $request)
    {
        $operationId = $request->get('operationID');

        DB::beginTransaction();
        try {

            // Actualizar el  StopData si hay
            $stopOperation = StopOperation::find($operationId);
            if ( isset($stopOperation) )
            {
                $stopOperation->delete();
            }

            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Redireccionando a la página principal.',
            'url' => route('home')
        ], 200);

    }

    public function saveOperationReal(Request $request)
    {
        // TODO: Enviar la notificacion al admin por telegram

        $number_operation = $request->get('codigo');

        $code_operation = $this->generateRandomString(10);

        DB::beginTransaction();
        try {

            // Actualizar el  StopData si hay
            $stopOperation = StopOperation::where('user_id', Auth::id())->first();
            if ( isset($stopOperation) )
            {
                $operationRepeat = Operation::where('number_operation_user', $number_operation)->first();
                if ( isset($operationRepeat) )
                {
                    return response()->json(['message' => "Numero de operación repetido."], 422);
                }

                $account_dolarero_send_id = null;

                $cuentaCliente = AccountCustomer::find($stopOperation->account_customer_id);

                $banco_id = $cuentaCliente->bank_id;
                $moneda = $cuentaCliente->currency;

                $cuentaDolareroSend = AccountDolarero::where('currency', $moneda)
                    ->where('bank_id', $banco_id)
                    ->first();

                $account_dolarero_send_id = $cuentaDolareroSend->id;

                $operation = Operation::create([
                    'user_id' => $stopOperation->user_id,
                    'buyStop' => $stopOperation->buyStop,
                    'sellStop' => $stopOperation->sellStop,
                    'buyControl' => $stopOperation->buyControl,
                    'sellControl' => $stopOperation->sellControl,
                    'token' => $stopOperation->token,
                    'coupon_id' => $stopOperation->coupon_id,
                    'type' => $stopOperation->type,
                    'sendAmount' => $stopOperation->sendAmount,
                    'getAmount' => $stopOperation->getAmount,
                    'account_dolarero_id' => $stopOperation->account_dolarero_id,
                    'nameBankDolarero' => $stopOperation->nameBankDolarero,
                    'account_customer_id' => $stopOperation->account_customer_id,
                    'source_fund_id' => $stopOperation->source_fund_id,
                    'ahorro' => $stopOperation->ahorro,
                    'number_operation_user' => $number_operation,
                    'code_operation' => $code_operation,
                    'account_dolarero_real_id' => $stopOperation->account_dolarero_real_id,
                    'account_dolarero_send_id' => $account_dolarero_send_id
                ]);

                // TODO: Asignar el cupon en user_coupons
                $coupon = Coupon::find($stopOperation->coupon_id);
                if ( isset($coupon) )
                {
                    if ( $coupon->special == 0 )
                    {
                        $usercoupon = UserCoupon::create([
                            "user_id" => Auth::id(),
                            "coupon_id" => $coupon->id
                        ]);
                    }
                }

                $data = [
                    'codeUser' => $operation->code_operation,
                    'dateOperation' => $operation->created_at->format('d/m/Y'),
                    'nameUser' => ($operation->user->business_name != null) ? $operation->user->business_name : $operation->user->first_name . " " . $operation->user->last_name,
                    'dateRegister' => $operation->user->created_at->format('d M Y, g:i a')
                ];

                $telegramController = new TelegramController();
                $telegramController->sendNotification('process', $data);

                $stopOperation->delete();
            }

            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Operación registrada con éxito.',
            'code_operation' => $code_operation
        ], 200);
    }

    public function generateRandomString($length = 25) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getInfoOperation($operation_id)
    {
        $operation = Operation::find($operation_id);

        if ( isset($operation) )
        {
            if ( $operation->account_dolarero_real_id == null )
            {
                return response()->json([
                    'fechaOperacion' => $operation->created_at->format('d/m/Y'),
                    'numeroOperacion' => $operation->number_operation_user,
                    'tipoCambio' => $operation->type_change,
                    'montoEnviado' => $operation->send_amount_list,
                    'montoRecibido' => $operation->get_amount_list,
                    'cuentaDolareros' => $operation->account_dolarero->bank->name.' - '.$operation->account_dolarero->numberAccount,
                    'cuentaDestino' => $operation->account_customer->bank->name.' - '.$operation->account_customer->numberAccount,
                    'estadoOperacion' => $operation->estado
                ], 200);
            } else {
                return response()->json([
                    'fechaOperacion' => $operation->created_at->format('d/m/Y'),
                    'numeroOperacion' => $operation->number_operation_user,
                    'tipoCambio' => $operation->type_change,
                    'montoEnviado' => $operation->send_amount_list,
                    'montoRecibido' => $operation->get_amount_list,
                    'cuentaDolareros' => $operation->account_dolarero_real->bank->name.' - '.$operation->account_dolarero_real->number_interbank,
                    'cuentaDestino' => $operation->account_customer->bank->name.' - '.$operation->account_customer->numberAccount,
                    'estadoOperacion' => $operation->estado
                ], 200);
            }

        } else {
            return response()->json(['message' => "No encontramos la operación indicada."], 422);
        }
    }

    public function getReceiptOperation($operation_id)
    {
        $operation = Operation::find($operation_id);
        $companyRUC = DataGeneral::where('name', 'companyRUC')->first();

        if ( isset($operation) )
        {
            return response()->json([
                'rucEmisor' => $companyRUC->valueText,
                'numberOperation' => $operation->number_operation_dolareros,
                'fecha' => $operation->created_at->format('d/m/Y'),
                'montoEnviadoReceipt' => $operation->get_amount_list,
                'imageReceipt' => $operation->image_receipt
            ], 200);
        } else {
            return response()->json(['message' => "No encontramos la operación indicada."], 422);
        }
    }

    public function downloadImageOperation($operation_id)
    {
        $operation = Operation::find($operation_id);

        $rutaImagen = public_path()."/assets/images/operation/receipts/".$operation->image_receipt;
        $nombreArchivo = $operation->image_receipt;

        return response()->download($rutaImagen, $nombreArchivo);
    }

    public function getRefusedOperation($operation_id)
    {
        $operation = Operation::find($operation_id);

        if ( isset($operation) )
        {
            return response()->json([
                'reasonRefused' => $operation->rejection->reason
            ], 200);
        } else {
            return response()->json(['message' => "No encontramos la operación indicada."], 422);
        }
    }

    public function getDataOperations(Request $request, $pageNumber = 1)
    {
        $perPage = 10;

        $documentCliente = $request->input('document_cliente');
        $codigoOperacion = $request->input('codigo_operacion');
        $bancoId = $request->input('banco_id');

        $query = Operation::with('account_dolarero', 'user')->orderBy('state')
        ->orderBy('created_at', 'DESC');

        // Aplicar filtros si se proporcionan
        if ($documentCliente) {
            /*$query->where('document_customer', $documentCliente);*/
            $query->whereHas('user', function ($subquery) use ($documentCliente) {
                $subquery->where('document', $documentCliente);
            });
        }

        if ($codigoOperacion) {
            $query->where('code_operation', $codigoOperacion);
            /*$query->whereHas('operation', function ($subquery) use ($codigoOperacion) {
                $subquery->where('code_operation', $codigoOperacion);
            });*/
        }

        if ($bancoId) {
            $query->whereHas('account_dolarero', function ($subquery) use ($bancoId) {
                $subquery->where('bank_id', $bancoId);
            });
        }

        $totalFilteredRecords = $query->count();
        $totalPages = ceil($totalFilteredRecords / $perPage);

        $startRecord = ($pageNumber - 1) * $perPage + 1;
        $endRecord = min($totalFilteredRecords, $pageNumber * $perPage);

        $operations = $query->skip(($pageNumber - 1) * $perPage)
            ->take($perPage)
            ->get();

        $arrayOperations = [];

        foreach ( $operations as $operation )
        {
            if ( $operation->estado == 'RECHAZADO' )
            {
                $text = '<span class="badge badge-light-danger">'.$operation->estado.'</span>';
            } elseif ( $operation->estado == 'PROCESANDO' )
            {
                $text = '<span class="badge badge-light-warning">'.$operation->estado.'</span>';
            } else {
                $text = '<span class="badge badge-light-primary">'.$operation->estado.'</span>';
            }
            array_push($arrayOperations, [
                "id" => $operation->id,
                "bank" => $operation->account_dolarero->bank->name,
                "numOperation" => $operation->code_operation,
                "numOperationUser" => ($operation->number_operation_user == null) ? 'Pendiente': $operation->number_operation_user,
                "enviado" => $operation->send_amount_list,
                "recibido" => $operation->get_amount_list,
                "tipoCambio" => $operation->type_change,
                "fecha" => $operation->created_at->format('d/m/Y'),
                "estado" => $text,
                "state" => $operation->estado,
                "image_receipt" => $operation->image_receipt,
                "number_operation_dolareros" => $operation->number_operation_dolareros
            ]);
        }

        $pagination = [
            'currentPage' => (int)$pageNumber,
            'totalPages' => (int)$totalPages,
            'startRecord' => $startRecord,
            'endRecord' => $endRecord,
            'totalRecords' => $totalFilteredRecords,
            'totalFilteredRecords' => $totalFilteredRecords
        ];

        return ['data' => $arrayOperations, 'pagination' => $pagination];

    }

    public function indexDolareros()
    {
        /*$operations = Operation::orderBy('state')
            ->orderBy('created_at', 'DESC')
            ->get();*/

        $rejections = Rejection::all();

        $banks = Bank::all();

        return view('operation.indexDolareros', compact('rejections', 'banks'));

    }

    public function saveRefusedOperation( Request $request )
    {
        //dd($request->get('rejection_id'));
        $operation_id = $request->get('operation_id');
        $rejection_id = $request->get('rejection_id');

        if( $rejection_id == "" || $rejection_id == null )
        {
            return response()->json(['message' => "Seleccione un motivo para el rechazo."], 422);
        }

        DB::beginTransaction();
        try {

            $operation = Operation::find($operation_id);
            $operation->rejection_id = $rejection_id;
            $operation->state = 'refused';
            $operation->save();

            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Operación rechazada con éxito.'
        ], 200);
    }

    public function saveRegisterReceipt( Request $request )
    {
        $operation_id = $request->get('operation_id');
        $numberOperation = $request->get('number_operation');

        if( $numberOperation == "" || $numberOperation == null )
        {
            return response()->json(['message' => "Escriba un número de operación."], 422);
        }

        if( !$request->hasFile('image_operation') )
        {
            return response()->json(['message' => "Suba una imagen o PDF."], 422);
        }

        DB::beginTransaction();
        try {
            $operation = Operation::find($operation_id);

            $operationRepeat = Operation::where('number_operation_dolareros', $numberOperation)->first();
            if ( isset($operationRepeat) )
            {
                return response()->json(['message' => "Numero de operación repetido."], 422);
            }

            if ($request->hasFile('image_operation')) {
                $image = $request->file('image_operation');
                $path = public_path().'/assets/images/operation/receipts/';
                $extension = $request->file('image_operation')->getClientOriginalExtension();
                //$filename = $entry->id . '.' . $extension;
                if ( strtoupper($extension) != "PDF" )
                {
                    $filename = $operation->id.'_' . $this->generateRandomString(20).'.jpg';
                    $img = Image::make($image);
                    $img->orientate();
                    $img->save($path.$filename, 80, 'jpg');
                    //$request->file('image')->move($path, $filename);
                    $operation->image_receipt = $filename;
                    $operation->save();
                } else {
                    $filename = 'pdf'.$operation->id . $this->generateRandomString(20) . '.' .$extension;
                    $request->file('image_operation')->move($path, $filename);
                    $operation->image_receipt = $filename;
                    $operation->save();
                }
            }

            $operation->number_operation_dolareros = $numberOperation;
            $operation->rejection_id = null;
            $operation->state = 'finished';
            $operation->save();

            // Actualizar los balances
            if ( $operation->account_dolarero_real_id == null )
            {
                $cuentaDolareroAumentar = AccountDolarero::find($operation->account_dolarero_id);
            } else {
                $cuentaDolareroAumentar = AccountDolarero::find($operation->account_dolarero_real_id);
            }

            $cuentaDolareroDisminuir = AccountDolarero::find($operation->account_dolarero_send_id);

            // Crear la tabla de accountings
            $type_exchange = 0;

            if ( $operation->coupon_id != null )
            {
                $coupon = Coupon::find($operation->coupon_id);
                if ( $operation->type == 'buy' )
                {
                    $type_exchange = $operation->buyStop+$coupon->amountBuy;
                } else {
                    $type_exchange = $operation->sellStop-$coupon->amountSell;
                }
            } else {
                if ( $operation->type == 'buy' )
                {
                    $type_exchange = $operation->buyStop;
                } else {
                    $type_exchange = $operation->sellStop;
                }
            }

            $entry = Accounting::create([
                'operation_id' => $operation->id,
                'bank_id' => $cuentaDolareroAumentar->bank_id,
                'account_dolarero_id' => $cuentaDolareroAumentar->id,
                'document_customer' => $operation->user->document,
                'type_operation' => $operation->type,
                'type_exchange' => $type_exchange,
                'code_operation_customer' => $operation->number_operation_user,
                'code_operation_dolarero' => $operation->number_operation_dolareros,
                'balance_prev' => $cuentaDolareroAumentar->balance,
                'balance_next' => $cuentaDolareroAumentar->balance + $operation->sendAmount,
                'type' => 'entry',
                'date' => Carbon::now('America/Lima'),
                'observation' => ($operation->account_dolarero_real_id != null) ? 'Interbancario BBVA':'',
            ]);

            $output = Accounting::create([
                'operation_id' => $operation->id,
                'bank_id' => $cuentaDolareroDisminuir->bank_id,
                'account_dolarero_id' => $cuentaDolareroDisminuir->id,
                'document_customer' => $operation->user->document,
                'type_operation' => $operation->type,
                'type_exchange' => $type_exchange,
                'code_operation_customer' => $operation->number_operation_user,
                'code_operation_dolarero' => $operation->number_operation_dolareros,
                'balance_prev' => $cuentaDolareroDisminuir->balance,
                'balance_next' => $cuentaDolareroDisminuir->balance - $operation->getAmount,
                'type' => 'output',
                'date' => Carbon::now('America/Lima'),
                'observation' => ($operation->account_dolarero_real_id != null) ? 'Interbancario BBVA':'',
            ]);

            $cuentaDolareroAumentar->balance = $cuentaDolareroAumentar->balance + $operation->sendAmount;
            $cuentaDolareroDisminuir->balance = $cuentaDolareroDisminuir->balance - $operation->getAmount;

            $cuentaDolareroAumentar->save();
            $cuentaDolareroDisminuir->save();

            DB::commit();
        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Operación finalizada con éxito.',
            'numberPhone' => $operation->user->phone,
            'numberOperation' => $operation->code_operation,
        ], 200);
    }

    public function updateRegisterReceipt( Request $request )
    {
        $operation_id = $request->get('operation_id');
        $numberOperation = $request->get('number_operation');

        if( $numberOperation == "" || $numberOperation == null )
        {
            return response()->json(['message' => "Escriba un número de operación."], 422);
        }

        DB::beginTransaction();
        try {
            $operation = Operation::find($operation_id);

            if ($request->hasFile('image_operation')) {
                $image = $request->file('image_operation');
                $path = public_path().'/assets/images/operation/receipts/';
                $extension = $request->file('image_operation')->getClientOriginalExtension();
                //$filename = $entry->id . '.' . $extension;
                if ( strtoupper($extension) != "PDF" )
                {
                    $filename = $operation->id.'_' . $this->generateRandomString(20).'.JPG';
                    $img = Image::make($image);
                    $img->orientate();
                    $img->save($path.$filename, 80, 'JPG');
                    //$request->file('image')->move($path, $filename);
                    $operation->image_receipt = $filename;
                    $operation->save();
                } else {
                    $filename = 'pdf'.$operation->id . $this->generateRandomString(20) . '.' .$extension;
                    $request->file('image_operation')->move($path, $filename);
                    $operation->image_receipt = $filename;
                    $operation->save();
                }
            }

            $operation->number_operation_dolareros = $numberOperation;
            $operation->rejection_id = null;
            $operation->state = 'finished';
            $operation->save();

            DB::commit();
        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Operación finalizada con éxito.'
        ], 200);
    }

    public function getDataContabilidad()
    {
        $accountings = Accounting::with('operation', 'bank', 'account_dolarero')
            ->get();

        $arrayAccounting = [];

        foreach ( $accountings as $accounting )
        {
            array_push($arrayAccounting, [
                "id" => $accounting->operation->code_operation,
                "banco" => $accounting->bank->name,
                "docIndentidadCliente" => $accounting->document_customer,
                "tipoOperacion" => ($accounting->type_operation == 'buy') ? 'COMPRA':'VENTA',
                "codOperacionEntrante" => $accounting->code_operation_customer,
                "codOperacionSaliente" => $accounting->code_operation_dolarero,
                "moneda" => $accounting->account_dolarero->currency,
                "monto_previo" => number_format($accounting->balance_prev, 3),
                "monto_nuevo" => number_format($accounting->balance_next, 3),
                "fecha" => ($accounting->type == 'entry') ? $accounting->operation->created_at->format('d/m/Y'): $accounting->date->format('d/m/Y'),
                "observacion" => $accounting->observation
            ]);
        }

        dump($arrayAccounting);

        // Nueva tabla
        /*
         * id
         * operation_id
         * bank
         * document_customer
         * type_operation
         * type_exchange (buy/sell + coupon/n)
         * code_customer
         * code_dolarero
         * balance_soles_prev
         * balance_soles_next
         * balance_dollar_prev
         * balance_dollar_next
         * date
         * observation
         * */
    }
}
