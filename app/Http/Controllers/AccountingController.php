<?php

namespace App\Http\Controllers;

use App\Models\Accounting;
use App\Models\Bank;
use Illuminate\Http\Request;

class AccountingController extends Controller
{
    public function getDataContabilidad(Request $request, $pageNumber = 1)
    {
        $perPage = 10;

        /*$totalRecords = Accounting::count();
        $totalPages = ceil($totalRecords / $perPage);

        $startRecord = ($pageNumber - 1) * $perPage + 1;
        $endRecord = min($totalRecords, $pageNumber * $perPage);*/

        $documentCliente = $request->input('document_cliente');
        $codigoOperacion = $request->input('codigo_operacion');
        $bancoId = $request->input('banco_id');;

        $query = Accounting::with('operation', 'bank', 'account_dolarero');

        // Aplicar filtros si se proporcionan
        if ($documentCliente) {
            $query->where('document_customer', $documentCliente);
        }

        if ($codigoOperacion) {
            $query->whereHas('operation', function ($subquery) use ($codigoOperacion) {
                $subquery->where('code_operation', $codigoOperacion);
            });
        }

        if ($bancoId) {
            $query->whereHas('bank', function ($subquery) use ($bancoId) {
                $subquery->where('id', $bancoId);
            });
        }

        $totalFilteredRecords = $query->count();
        $totalPages = ceil($totalFilteredRecords / $perPage);

        $startRecord = ($pageNumber - 1) * $perPage + 1;
        $endRecord = min($totalFilteredRecords, $pageNumber * $perPage);

        $accountings = $query->skip(($pageNumber - 1) * $perPage)
            ->take($perPage)
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

        $pagination = [
            'currentPage' => (int)$pageNumber,
            'totalPages' => (int)$totalPages,
            'startRecord' => $startRecord,
            'endRecord' => $endRecord,
            'totalRecords' => $totalFilteredRecords,
            'totalFilteredRecords' => $totalFilteredRecords
        ];

        return ['data' => $arrayAccounting, 'pagination' => $pagination];

    }

    public function index()
    {
        $banks = Bank::all();

        return view('accounting.index', compact('banks'));
    }
}
