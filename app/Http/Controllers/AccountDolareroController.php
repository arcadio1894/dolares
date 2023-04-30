<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountDolareroDestroyRequest;
use App\Http\Requests\AccountDolareroStoreRequest;
use App\Http\Requests\AccountDolareroUpdateRequest;
use App\Models\AccountDolarero;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountDolareroController extends Controller
{
    public function index()
    {
        $banks = Bank::all();
        $accounts = AccountDolarero::with('bank')->get();

        return view('accountDolareros.index', compact('banks', 'accounts'));
    }

    public function create()
    {
        return view('bank.create');
    }

    public function store( AccountDolareroStoreRequest $request )
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {

            AccountDolarero::create([
                'bank_id' => $request->get('bank_id'),
                'numberAccount' => $request->get('numberAccount'),
                'currency' => $request->get('currency'),
            ]);

            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Cuenta Dolarero guardado correctamente.',
        ], 200);
    }

    public function update( AccountDolareroUpdateRequest $request )
    {
        $validated = $request->validated();

        $accounts = AccountDolarero::where('bank_id', $request->get('bank_id'))
            ->where('currency', $request->get('currency'))
            ->where('id', '<>',$request->get('account_id'))
            ->get();
        if ( count($accounts) > 0 )
        {
            return response()->json([
                'message' => 'No se puede guardar porque ya hay una cuenta con esa moneda en ese banco.',
            ], 422);
        }

        DB::beginTransaction();
        try {

            $account = AccountDolarero::find($request->get('account_id'));

            $account->bank_id = $request->get('bank_id');
            $account->numberAccount = $request->get('numberAccount');
            $account->currency = $request->get('currency');
            $account->status = ($request->get('statusAccount') == 1) ? 1:0;
            $account->save();

            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Cuenta Dolarero modificada correctamente.',
        ], 200);
    }

    public function updateStatus( Request $request )
    {
        $account_id = $request->get('account_id');
        $statusAccount = $request->get('statusAccount');

        $account = AccountDolarero::find($account_id);
        $account->status = $statusAccount;
        $account->save();

        return response()->json([
            'message' => 'Estado actualizado con éxito'
        ], 200);
    }

    public function destroy( AccountDolareroDestroyRequest $request, $account_id )
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {

            $account = AccountDolarero::find($request->get('account_id'));

            $account->delete();

            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Cuenta Dolarero eliminada correctamente.',
        ], 200);
    }
}
