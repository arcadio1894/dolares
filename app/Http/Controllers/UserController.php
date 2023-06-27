<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\District;
use App\Models\Operation;
use App\Models\Province;
use App\Models\StopData;
use App\Models\StopOperation;
use App\Models\User;
use App\Models\UserToken;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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
        $tokensl = $request->get('tokenl');
        //dump($tokens);
        //dump($tokensl);
        //dd();
        $tokenSecurel = '';
        for ( $i=0; $i<count($tokensl); $i++ )
        {
            if ( $tokensl[$i] == '' || $tokensl[$i] == null )
            {
                return response()->json([
                    'message' => 'Ingrese 4 números válidos en la contraseña antigua',
                ], 422);
            }
        }

        $tokenSecure = '';
        for ( $i=0; $i<count($tokens); $i++ )
        {
            if ( $tokens[$i] == '' || $tokens[$i] == null )
            {
                return response()->json([
                    'message' => 'Ingrese 4 números válidos en la nueva contraseña',
                ], 422);
            }
        }

        for ( $i=0; $i<count($tokens); $i++ )
        {
            $tokenSecure = $tokenSecure . $tokens[$i];
        }

        for ( $i=0; $i<count($tokensl); $i++ )
        {
            $tokenSecurel = $tokenSecurel . $tokensl[$i];
        }

        $userToken = UserToken::where('user_id', Auth::id())->first();

        if ( ! Hash::check($tokenSecurel, $userToken->token) )
        {
            return response()->json([
                'message' => 'La contraseña antigua no coincide con la contraseña indicada.',
            ], 422);
        }

        DB::beginTransaction();
        try {

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

    public function index()
    {
        Carbon::setLocale('es');
        $users = User::all();
        $arrayUsers = [];
        $roles = Role::all();
        foreach ( $users as $user )
        {
            $rol = $user->getRoleNames()->first();
            $role = Role::where('name', $rol)->first();
            if (!$rol)
            {
                $rol = "Sin Rol";
            }

            $diferencia = "";
            if ( isset($user->last_login) )
            {
                $fechaBD = Carbon::parse($user->last_login);

                $diferencia = $fechaBD->diffForHumans();
            }

            array_push($arrayUsers, [
                "name" => $user->first_name . " " . $user->last_name,
                "first_name" => $user->first_name,
                "last_name" => $user->last_name,
                "email" => $user->email,
                "avatar" => strtoupper(substr($user->first_name, 0, 1).substr($user->last_name, 0, 1)),
                "role_name" => $rol,
                "last_login" => $diferencia,
                "joined_date" => $user->created_at->format('d M Y, g:i a'),
                "id" => $user->id,
                "phone" => $user->phone,
                "document" => $user->document,
                "role_id" => (isset($role)) ? $role->name:"",
                "role_description" => (isset($role)) ? $role->description:"Sin rol"
            ]);
        }

        return view('user.index', compact("arrayUsers", "roles"));
    }

    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => bcrypt('dolareros2023'),
            'phone' => $request->get('phone'),
            'document' => $request->get('document'),
        ]);

        // Sincronizar con roles
        $roles = $request->get('role');
        //var_dump($roles);
        $user->syncRoles($roles);

        return response()->json(['message' => 'Usuario guardado con éxito.'], 200);

    }

    public function update(UpdateUserRequest $request)
    {
        $validated = $request->validated();

        $user = User::find($request->get('user_id'));

        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $user->document = $request->get('document');
        $user->save();

        // Sincronizar con roles
        $roles = $request->get('role_edit');
        $user->syncRoles($roles);

        return response()->json(['message' => 'Usuario modificado con éxito.'], 200);

    }

    public function destroy(DeleteUserRequest $request)
    {
        $validated = $request->validated();

        $user = User::find($request->get('user_id'));

        $operations = Operation::where('user_id', $user->id)->get();
        $stopOperations = StopOperation::where('user_id', $user->id)->get();
        $stopDatas = StopData::where('user_id', $user->id)->get();

        if ( count($operations) > 0 || count($stopOperations) > 0 )
        {
            return response()->json(['message' => 'No se puede eliminar porque el usuario tiene operaciones.'], 422);
        }

        if ( count($stopDatas) > 0 )
        {
            foreach ( $stopDatas as $stopData )
            {
                $stopData->delete();
            }
        }

        $user->delete();

        return response()->json(['message' => 'Usuario eliminado con éxito.'], 200);

    }

    public function show( $user_id )
    {
        $user = User::find($user_id);
        $rol = $user->getRoleNames()->first();
        $role = Role::where('name', $rol)->first();
        if (!$rol)
        {
            $rol = "Sin Rol";
        }

        $diferencia = "";
        if ( isset($user->last_login) )
        {
            $fechaBD = Carbon::parse($user->last_login);

            $diferencia = $fechaBD->diffForHumans();
        }

        $operationsPending = Operation::where('user_id', $user->id)
            ->where('state', 'processing')->get();
        $operationsFinish = Operation::where('user_id', $user->id)
            ->where('state', 'finished')->get();
        $operationsRefuse = Operation::where('user_id', $user->id)
            ->where('state', 'refused')->get();

        $userData = [
            "name" => $user->first_name . " " . $user->last_name,
            "first_name" => $user->first_name,
            "last_name" => $user->last_name,
            "email" => $user->email,
            "avatar" => strtoupper(substr($user->first_name, 0, 1).substr($user->last_name, 0, 1)),
            "role_name" => $rol,
            "last_login" => $diferencia,
            "joined_date" => $user->created_at->format('d M Y, g:i a'),
            "id" => $user->id,
            "phone" => $user->phone,
            "document" => $user->document,
            "role_id" => (isset($role)) ? $role->name:"",
            "role_description" => (isset($role)) ? $role->description:"Sin rol",
            "cantProcessing" => count($operationsPending),
            "cantFinish" => count($operationsFinish),
            "cantRefuse" => count($operationsRefuse)
        ];

        return view('user.show', compact('userData'));
    }

    public function getProvincesOfDepartment($department_id)
    {
        $provinces = Province::where('department_id', $department_id)->get();

        return $provinces;
    }

    public function getDistrictsOfProvince($province_id)
    {
        $districts = District::where('province_id', $province_id)->get();

        return $districts;
    }
}
