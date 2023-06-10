<?php

namespace App\Http\Controllers;

use App\Models\AccountCustomer;
use App\Models\AccountDolarero;
use App\Models\Bank;
use App\Models\DataGeneral;
use App\Models\Department;
use App\Models\Operation;
use App\Models\SourceFund;
use App\Models\StopData;
use App\Models\StopOperation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OperationController extends Controller
{
    public function index()
    {
        $operations = Operation::where('user_id', Auth::id())
            ->orderBy('state')
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

        DB::beginTransaction();
        try {

            // Crear el StopOperation si no hay, Si hay se elimina
            $stopOperation = StopOperation::where('user_id', Auth::id())->first();
            if ( isset($stopOperation) )
            {
                ///$stopOperation->delete();
                $amountSend = number_format($stopOperation->sendAmount, 2, '.', ' ');
                //$stopData = StopData::where('user_id', Auth::id())->first();
                $stopOperation->account_dolarero_id = $accountsDolarero->id;
                $stopOperation->nameBankDolarero = $bancoOrigen;
                $stopOperation->account_customer_id = $cuentaDestinoId;
                $stopOperation->source_fund_id = $sourceId;
                $stopOperation->save();

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
                ]);

                $amountSend = number_format($newStopOperation->sendAmount, 2, '.', ' ');

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
            'bankCustomer' => $bankCustomer
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
                $accountDolareros = AccountDolarero::where('currency', 'PEN')
                    ->where('status', 1)
                    ->get();
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
                $accountDolareros = AccountDolarero::where('currency', 'PEN')
                    ->where('status', 1)
                    ->get();
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
        $number_operation = $request->get('codigo');

        $code_operation = $this->generateRandomString(10);

        DB::beginTransaction();
        try {

            // Actualizar el  StopData si hay
            $stopOperation = StopOperation::where('user_id', Auth::id())->first();
            if ( isset($stopOperation) )
            {
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
                    'code_operation' => $code_operation
                ]);

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
}
