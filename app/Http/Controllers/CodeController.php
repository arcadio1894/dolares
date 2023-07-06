<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CodeController extends Controller
{
    public function index($url)
    {
        Session::forget('codigo_correcto');
        $user = User::find(Auth::id());
        $token = UserToken::where('user_id', $user->id)->first();
        $flag = 0;
        if ( isset($token) )
        {
            $flag = 1;
        }
        return view('code.index', compact('url', 'flag'));
    }

    public function verification(Request $request, $url)
    {
        $urls = [
            '1' => 'accountCustomer.index',
            '2' => 'operationCustomer.index'
        ];

        $ruta = $urls[$url];

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

        $userToken = UserToken::where('user_id', Auth::id())->first();

        if ( ! Hash::check($tokenSecure, $userToken->token) )
        {
            return response()->json([
                'message' => 'La contraseña no coincide con la contraseña guardada.',
            ], 422);
        } else {
            $message = 'La contraseña es correcta';
            session(['codigo_correcto' => false]);
            return response()->json([
                'message' => $message,
                'url' => route($ruta)
            ], 200);
        }

        //return redirect()->route('codigo')->with('mensaje', 'Código incorrecto');
    }
}
