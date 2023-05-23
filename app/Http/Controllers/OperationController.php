<?php

namespace App\Http\Controllers;

use App\Models\AccountCustomer;
use App\Models\AccountDolarero;
use App\Models\Bank;
use App\Models\Department;
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
        $banks = Bank::all();
        $departments = Department::all();
        $accounts = AccountCustomer::with(['bank','department'])
            ->where('user_id', Auth::id())
            ->get();

        return view('accountCustomers.index', compact('banks', 'departments', 'accounts'));

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

        DB::beginTransaction();
        try {

            // Crear el StopOperation si no hay, Si hay se elimina
            $stopOperation = StopOperation::where('user_id', Auth::id())->first();
            if ( isset($stopOperation) )
            {
                ///$stopOperation->delete();

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
            }

            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Operación guardada.'
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
}
