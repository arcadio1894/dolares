<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountCustomerDestroyRequest;
use App\Http\Requests\AccountCustomerStoreRequest;
use App\Http\Requests\AccountCustomerUpdateRequest;
use App\Models\AccountCustomer;
use App\Models\Bank;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AccountCustomerController extends Controller
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

    public function store( AccountCustomerStoreRequest $request )
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {

            AccountCustomer::create([
                'department_id' => $request->get('department_id'),
                'bank_id' => $request->get('bank_id'),
                'user_id' => Auth::id(),
                'nameAccount' => $request->get('nameAccount'),
                'numberAccount' => $request->get('numberAccount'),
                'type_account' => $request->get('type_account'),
                'currency' => $request->get('currency'),
                'property' => ($request->get('property') == 1) ? 1:0,
            ]);

            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Cuenta guardada correctamente.',
        ], 200);
    }

    public function update( AccountCustomerUpdateRequest $request )
    {
        $validated = $request->validated();

        /*$accounts = AccountCustomer::where('bank_id', $request->get('bank_id'))
            ->where('currency', $request->get('currency'))
            ->where('id', '<>',$request->get('account_id'))
            ->get();
        if ( count($accounts) > 0 )
        {
            return response()->json([
                'message' => 'No se puede guardar porque ya hay una cuenta con esa moneda en ese banco.',
            ], 422);
        }*/

        DB::beginTransaction();
        try {

            $account = AccountCustomer::find($request->get('account_id'));

            $account->department_id = $request->get('department_id');
            $account->bank_id = $request->get('bank_id');
            $account->nameAccount = $request->get('nameAccount');
            $account->numberAccount = $request->get('numberAccount');
            $account->type_account = $request->get('type_account');
            $account->currency = $request->get('currency');
            $account->status = ($request->get('statusAccount') == 1) ? 1:0;
            $account->property = ($request->get('property') == 1) ? 1:0;
            $account->save();

            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Cuenta modificada correctamente.',
        ], 200);
    }

    public function updateStatus( Request $request )
    {
        $account_id = $request->get('account_id');
        $statusAccount = $request->get('statusAccount');

        $account = AccountCustomer::find($account_id);
        $account->status = $statusAccount;
        $account->save();

        return response()->json([
            'message' => 'Estado actualizado con éxito'
        ], 200);
    }

    public function destroy( AccountCustomerDestroyRequest $request, $account_id )
    {
        $validated = $request->validated();

        // TODO: Verificar las operaciones si hay, no se puede eliminar

        DB::beginTransaction();
        try {

            $account = AccountCustomer::find($request->get('account_id'));

            $account->delete();

            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Cuenta eliminada correctamente.',
        ], 200);
    }

    public function operaciones()
    {
        /*session(['codigo_correcto' => true]);*/
        /*Session::forget('codigo_correcto');*/
        return "Pagina de operaciones";
        //return view('accountCustomer.index', compact('response'));
    }
}
