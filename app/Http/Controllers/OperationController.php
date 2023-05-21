<?php

namespace App\Http\Controllers;

use App\Models\AccountCustomer;
use App\Models\AccountDolarero;
use App\Models\Bank;
use App\Models\Department;
use App\Models\SourceFund;
use App\Models\StopData;
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

    public function create()
    {
        $stopData = StopData::with('coupon')
            ->where('user_id', Auth::id())->first();
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


        return view('operation.create', compact('stopData', 'banks', 'sources', 'accountsDolareros', 'arrayAccountCustomers', 'departments'));
    }
}
