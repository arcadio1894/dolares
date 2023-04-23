<?php

namespace App\Http\Controllers;

use App\Models\StopData;
use App\Models\UserToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile()
    {
        return view('user.profile');
    }

    public function token()
    {
        $token = UserToken::where('user_id', Auth::id())->first();
        return view('user.token', compact('token'));
    }

    public function storeToken( Request $request )
    {
        $tokens = $request->get('token');

        $tokenSecure = '';
        for ( $i=0; $i<count($tokens); $i++ )
        {
            $tokenSecure = $tokenSecure . $tokens[$i];
            if ( $tokens[$i] == '' || $tokens[$i] == null )
            {
                return response()->json([
                    'message' => 'Ingrese 4 números válidos',
                ], 422);
            }
        }

        DB::beginTransaction();
        try {

            UserToken::create([
                'user_id' => Auth::id(),
                'token' => Hash::make($tokenSecure),
            ]);
            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Token seguro guardado con éxito.',
        ], 200);
    }

    public function renewToken( Request $request )
    {
        $tokens = $request->get('token');

        $tokenSecure = '';
        for ( $i=0; $i<count($tokens); $i++ )
        {
            $tokenSecure = $tokenSecure . $tokens[$i];
            if ( $tokens[$i] == '' || $tokens[$i] == null )
            {
                return response()->json([
                    'message' => 'Ingrese 4 números válidos',
                ], 422);
            }
        }

        DB::beginTransaction();
        try {

            $userToken = UserToken::where('user_id', Auth::id())->first();

            $userToken->delete();

            $token = UserToken::create([
                'user_id' => Auth::id(),
                'token' => Hash::make($tokenSecure),
            ]);

            // Actualizar el token en StopData si hay
            $stopData = StopData::where('user_id', Auth::id())->first();
            if ( isset($stopData) )
            {
                $stopData->token = $token;
                $stopData->save();
            }

            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Token seguro renovado con éxito.',
        ], 200);
    }
}
