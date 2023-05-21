<?php

namespace App\Http\Controllers;

use App\Http\Requests\SourceFundDestroyRequest;
use App\Http\Requests\SourceFundStoreRequest;
use App\Http\Requests\SourceFundUpdateRequest;
use App\Models\SourceFund;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SourceFundController extends Controller
{
    public function index()
    {
        $sources = SourceFund::all();

        return view('sourceFund.index', compact('sources'));
    }

    public function store( SourceFundStoreRequest $request )
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {

            SourceFund::create([
                'description' => $request->get('description'),

            ]);

            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Origen de fondos guardado correctamente.',
        ], 200);
    }

    public function update( SourceFundUpdateRequest $request )
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {

            $source = SourceFund::find($request->get('source_id'));

            $source->description = $request->get('description');
            $source->save();

            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Origen de fondos modificado correctamente.',
        ], 200);
    }

    public function destroy( SourceFundDestroyRequest $request, $account_id )
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {

            $source = SourceFund::find($request->get('source_id'));

            $source->delete();

            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Origen de fondos eliminado correctamente.',
        ], 200);
    }
}
