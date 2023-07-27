<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeExchangeStoreRequest;
use App\Models\DataGeneral;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class TypeExchangeController extends Controller
{
    public function index()
    {
        $tcManual = DataGeneral::where('name', 'tcManual')->first();
        $buyManual = DataGeneral::where('name', 'buyManual')->first();
        $sellManual = DataGeneral::where('name', 'sellManual')->first();

        return view('typeExchange.index', [
            'tcManual' => $tcManual,
            'buyManual' => $buyManual,
            'sellManual' => $sellManual,
        ]);
    }

    public function updateTcManual(Request $request)
    {
        $data_id = $request->get('data_id');
        $status = $request->get('status');

        $data = DataGeneral::find($data_id);
        $data->valueNumber = $status;
        $data->save();

        return response()->json([
            'message' => 'Cambio realizado con éxito'
        ], 200);
    }

    public function store(TypeExchangeStoreRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {

            $tcManual = DataGeneral::where('name', 'tcManual')->first();
            $tcManual->valueNumber = 1;
            $tcManual->save();
            $buyManual = DataGeneral::where('name', 'buyManual')->first();
            $buyManual->valueNumber = $request->get('buyManual');
            $buyManual->save();
            $sellManual = DataGeneral::where('name', 'sellManual')->first();
            $sellManual->valueNumber = $request->get('sellManual');
            $sellManual->save();

            //3 golpea el API con el TC manual
            $key = config('app.token_secret');

            $headers = [
                'Content-Type' => 'application/json',
                /*'AccessToken' => 'key',
                'Authorization' => 'Bearer token',*/
            ];

            $client = new Client([
                'base_uri' => 'https://www.api-dolareros.sbs/',
                'headers' => $headers
            ]);

            $body = [
                'typeFlag' => 1, // Reemplaza 'valor' con el valor correcto
                'buy' => $request->get('buyManual'), // Reemplaza 'valor' con el valor correcto
                'sell' => $request->get('sellManual'), // Reemplaza 'valor' con el valor correcto
                'nameWeb' => 'Dolareros', // Reemplaza 'valor' con el valor correcto
                'token_secret' => $key, // Reemplaza 'valor' con el valor correcto
            ];

            $response = $client->request('POST', 'api/tipoCambio/create', [
                'json' => $body,
            ]);

            $data = $response->getBody()->getContents();

            $tcManual = DataGeneral::where('name', 'tcManual')->first();
            $tcManual->valueNumber = 2;
            $tcManual->save();

            DB::commit();

        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $data = $response->getBody()->getContents();
                $errorResponse = json_decode($data, true); // Decodificar el JSON a un arreglo asociativo
                $errorMessage = isset($errorResponse['message']) ? $errorResponse['message'] : 'Error desconocido en la API';
            } else {
                $errorMessage = 'Error desconocido en la API';
            }
            // La solicitud falló (por ejemplo, problemas de conexión, tiempo de espera agotado, etc.)
            DB::rollBack();
            return response()->json(['message' => $errorMessage], 422);
        } catch (\Throwable $e) {
            // Otro tipo de error desconocido
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Tipos de cambios guardados correctamente.',
        ], 200);
    }
}
