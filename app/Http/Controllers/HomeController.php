<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\StopData;
use App\Models\UserCoupon;
use App\Models\UserToken;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Creamos la data de
        $respRetrieve = '';
        $respControl = '';
        $respError = '';
        try {

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

            $body = '{"token" : "'.$key.'"}';

            $r = $client->request('POST', 'api/tipoCambio/retrieve', [
                'body' => $body
            ]);

            $c = $client->request('POST', 'api/tipoCambio/retrieve/control', [
                'body' => $body
            ]);

            //$status_code = $r->getStatusCode();

            $respRetrieve = json_decode($r->getBody()->getContents());

            $respControl = json_decode($c->getBody()->getContents());

            /*dump($respRetrieve->tipoCambio->buy);
            dump($respControl);*/
            $lastStop = StopData::where('user_id', Auth::id())->first();
            $lastToken = UserToken::where('user_id', Auth::id())->first();
            if ( isset($lastStop) )
            {
                $lastStop->delete();
                $stopData = StopData::create([
                    'user_id' => Auth::id(),
                    'buyStop' => $respRetrieve->tipoCambio->buy,
                    'sellStop' => $respRetrieve->tipoCambio->sell,
                    'buyControl' => $respControl->tipoCambio->buy,
                    'sellControl' => $respControl->tipoCambio->sell,
                    'token' => (!isset($lastToken)) ? null:$lastToken->token
                ]);
            } else {
                $stopData = StopData::create([
                    'user_id' => Auth::id(),
                    'buyStop' => $respRetrieve->tipoCambio->buy,
                    'sellStop' => $respRetrieve->tipoCambio->sell,
                    'buyControl' => $respControl->tipoCambio->buy,
                    'sellControl' => $respControl->tipoCambio->sell,
                    'token' => (!isset($lastToken)) ? null:$lastToken->token
                ]);
            }

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $respError = json_decode($e->getResponse()->getBody()->getContents());
            //dump( json_decode($e->getResponse()->getBody()->getContents()) );
            //dump($respError->message);
            Log::channel('dolareros')->info($respError->message);
            //dd();
            return view('home', compact('stopData', 'respError'));
        }
        //dd();
        return view('home', compact('stopData', 'respError'));
    }

    public function applyCoupon(Request $request)
    {
        $coupon = $request->get('coupon');

        if ( $coupon == '' || $coupon == null )
        {
            return response()->json([
                "message" => 'Debe escribir un cupón.'
            ], 422);
        }

        $couponComplete = Coupon::where('name', $coupon)
            ->where('status', 1)
            ->first();

        if ( !isset($couponComplete) )
        {
            return response()->json([
                "message" => 'No existe un cupón con ese nombre, por favor ingrese otro cupón'
            ], 422);
        }

        if ( $couponComplete->special == 1 )
        {
            $userCoupon = UserCoupon::where('user_id', Auth::id())
                ->where('coupon_id', $couponComplete->id)
                ->first();

            if ( !isset($userCoupon) )
            {
                return response()->json([
                    "message" => 'Este cupón es especial y no fue asignado a su usuario, ingrese otro cupón.'
                ], 422);
            }
        } else {
            $userCoupon = UserCoupon::where('user_id', Auth::id())
                ->where('coupon_id', $couponComplete->id)
                ->first();

            if ( isset($userCoupon) )
            {
                return response()->json([
                    "message" => 'Este cupón ya fue utilizado, por favor ingrese otro cupón.'
                ], 422);
            }
        }

        // TODO: Esta creacion debe hacerse al culminar la operación con el cupón
        /*$userCouponNew = UserCoupon::create([
            'user_id' => Auth::id(),
            'coupon_id' => $couponComplete->id,
        ]);*/

        DB::beginTransaction();
        try {

            // Actualizar el  StopData si hay
            $stopData = StopData::where('user_id', Auth::id())->first();
            if ( isset($stopData) )
            {
                $stopData->coupon_id = $couponComplete->id;
                $stopData->save();
            }

            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Cupón aplicado correctamente.',
            'stopData' => $stopData,
            'coupon' => $couponComplete
        ], 200);

    }
}
