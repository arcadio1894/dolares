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
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function profile()
    {
        $token = UserToken::where('user_id', Auth::id())->first();
        return view('user.profile', compact('token'));
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

            if ($user->account_type == 'p')
            {
                $avatar = strtoupper(substr($user->first_name, 0, 1).substr($user->last_name, 0, 1));
            } else {
                $avatar = strtoupper(substr($user->business_name, 0, 1));
            }

            if ($user->account_type == 'p')
            {
                $name = $user->first_name . " " . $user->last_name;
            } else {
                $name = $user->business_name;
            }

            array_push($arrayUsers, [
                "name" => $name,
                "first_name" => $user->first_name,
                "last_name" => $user->last_name,
                "email" => $user->email,
                "avatar" => $avatar,
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

        if ($user->account_type == 'p')
        {
            $avatar = strtoupper(substr($user->first_name, 0, 1).substr($user->last_name, 0, 1));
        } else {
            $avatar = strtoupper(substr($user->business_name, 0, 1));
        }

        if ($user->account_type == 'p')
        {
            $name = $user->first_name . " " . $user->last_name;
        } else {
            $name = $user->business_name;
        }

        $userData = [
            "name" => $name,
            "first_name" => $user->first_name,
            "last_name" => $user->last_name,
            "email" => $user->email,
            "avatar" => $avatar,
            "role_name" => $rol,
            "direction" => $user->department->name . ','. $user->province->name . ',' . $user->district->name . ' ' . $user->direction,
            "profession" => $user->profession,
            "name_legal_representative" => $user->name_legal_representative,
            "dni_legal_representative" => $user->dni_legal_representative,
            "economic_sector" => ($user->economic_sector_id == null) ? null: $user->economic_sector->description,
            "economic_activity" => ($user->economic_activity_id == null) ? null:$user->economic_activity->description,
            "constitution_date" => ($user->constitution_date == null) ? null: $user->constitution_date->format('d/m/Y'),
            "state_company" => ($user->state_company == 1) ? 'SI': 'NO',
            "last_login" => $diferencia,
            "joined_date" => $user->created_at->format('d M Y, g:i a'),
            "id" => $user->id,
            "phone" => $user->phone,
            "document" => $user->document,
            "role_id" => (isset($role)) ? $role->name:"",
            "role_description" => (isset($role)) ? $role->description:"Sin rol",
            "cantProcessing" => count($operationsPending),
            "cantFinish" => count($operationsFinish),
            "cantRefuse" => count($operationsRefuse),
            "imageFront" => ($user->front_image == null) ? 'front.png': $user->front_image,
            "imageReverse" => ($user->reverse_image == null) ? 'back.png': $user->reverse_image
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

    public function submitImageFront( Request $request )
    {
        if( !$request->hasFile('image_front') )
        {
            return response()->json(['message' => "Suba una imagen o PDF."], 422);
        }

        DB::beginTransaction();
        try {
            $user = User::find(Auth::id());

            if ($request->hasFile('image_front')) {
                $image = $request->file('image_front');
                $path = public_path().'/assets/images/user/documents/';
                $extension = $request->file('image_front')->getClientOriginalExtension();
                //$filename = $entry->id . '.' . $extension;
                if ( strtoupper($extension) != "PDF" )
                {
                    if ( strtolower($extension) != 'jpg' && strtolower($extension) != 'png' && strtolower($extension) != 'jpeg' )
                    {
                        return response()->json(['message' => "El formato de la imagen es incorrecto.".$extension], 422);
                    }
                    $filename = $user->id.'_front_' . $this->generateRandomString(20).'.jpg';
                    $img = Image::make($image);
                    $img->orientate();
                    $img->save($path.$filename, 80, 'jpg');
                    //$request->file('image')->move($path, $filename);
                    if ( $user->front_image != null )
                    {
                        $image_path = public_path().'/assets/images/user/documents/'.$user->front_image;
                        if (file_exists($image_path)) {
                            unlink($image_path);
                        }
                    }
                    $user->front_image = $filename;
                    $user->flag_front = null;
                    $user->save();
                } else {

                    if ( $user->account_type == 'p' )
                    {
                        return response()->json(['message' => "Suba una imagen no se permite pdf."], 422);
                    }

                    $filename = 'pdf_front_'.$user->id . $this->generateRandomString(20) . '.' .$extension;
                    $request->file('image_front')->move($path, $filename);
                    if ( $user->front_image != null )
                    {
                        $image_path = public_path().'/assets/images/user/documents/'.$user->front_image;
                        if (file_exists($image_path)) {
                            unlink($image_path);
                        }
                    }
                    $user->front_image = $filename;
                    $user->flag_front = null;
                    $user->save();
                }
            }
            DB::commit();
        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Imagen frontal guardada con éxito.'
        ], 200);
    }

    public function submitImageReverse( Request $request )
    {
        if( !$request->hasFile('image_reverse') )
        {
            return response()->json(['message' => "Suba una imagen o PDF."], 422);
        }

        DB::beginTransaction();
        try {
            $user = User::find(Auth::id());

            if ($request->hasFile('image_reverse')) {
                $image = $request->file('image_reverse');
                $path = public_path().'/assets/images/user/documents/';
                $extension = $request->file('image_reverse')->getClientOriginalExtension();
                //$filename = $entry->id . '.' . $extension;
                if ( strtoupper($extension) != "PDF" )
                {
                    if ( strtolower($extension) != 'jpg' && strtolower($extension) != 'png' && strtolower($extension) != 'jpeg' )
                    {
                        return response()->json(['message' => "El formato de la imagen es incorrecto."], 422);
                    }

                    $filename = $user->id.'_reverse_' . $this->generateRandomString(20).'.jpg';
                    $img = Image::make($image);
                    $img->orientate();
                    $img->save($path.$filename, 80, 'jpg');
                    //$request->file('image')->move($path, $filename);
                    if ( $user->reverse_image != null )
                    {
                        $image_path = public_path().'/assets/images/user/documents/'.$user->reverse_image;
                        if (file_exists($image_path)) {
                            unlink($image_path);
                        }
                    }
                    $user->reverse_image = $filename;
                    $user->flag_reverse = null;
                    $user->save();
                } else {
                    if ( $user->account_type == 'p' )
                    {
                        return response()->json(['message' => "Suba una imagen no se permite pdf."], 422);
                    }

                    $filename = 'pdf_reverse_'.$user->id . $this->generateRandomString(20) . '.' .$extension;
                    $request->file('image_reverse')->move($path, $filename);
                    if ( $user->reverse_image != null )
                    {
                        $image_path = public_path().'/assets/images/user/documents/'.$user->reverse_image;
                        if (file_exists($image_path)) {
                            unlink($image_path);
                        }
                    }
                    $user->reverse_image = $filename;
                    $user->flag_reverse = null;
                    $user->save();
                }
            }
            DB::commit();
        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Imagen de reverso guardada con éxito.'
        ], 200);
    }

    public function generateRandomString($length = 25) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function indexUserVerificationImages()
    {
        $users = User::whereNotNull('front_image')
            ->whereNotNull('reverse_image')
            ->whereNull('flag_front')
            ->orWhere('flag_front', 0)
            ->whereNull('flag_reverse')
            ->orWhere('flag_reverse', 0)
            ->get();

        $arrayUsers = [];

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

            if ($user->account_type == 'p')
            {
                $avatar = strtoupper(substr($user->first_name, 0, 1).substr($user->last_name, 0, 1));
            } else {
                $avatar = strtoupper(substr($user->business_name, 0, 1));
            }

            if ($user->account_type == 'p')
            {
                $name = $user->first_name . " " . $user->last_name;
            } else {
                $name = $user->business_name;
            }

            array_push($arrayUsers, [
                "name" => $name,
                "first_name" => $user->first_name,
                "last_name" => $user->last_name,
                "email" => $user->email,
                "avatar" => $avatar,
                "role_name" => $rol,
                "last_login" => $diferencia,
                "joined_date" => $user->created_at->format('d M Y, g:i a'),
                "id" => $user->id,
                "phone" => $user->phone,
                "document" => $user->document,
                "role_id" => (isset($role)) ? $role->name:"",
                "role_description" => (isset($role)) ? $role->description:"Sin rol",
                "direction" => $user->department->name . ','. $user->province->name . ',' . $user->district->name . ' ' . $user->direction,
                "profession" => $user->profession,
                "name_legal_representative" => $user->name_legal_representative,
                "dni_legal_representative" => $user->dni_legal_representative,
                "economic_sector" => ($user->economic_sector_id == null) ? null: $user->economic_sector->description,
                "economic_activity" => ($user->economic_activity_id == null) ? null:$user->economic_activity->description,
                "constitution_date" => ($user->constitution_date == null) ? null: $user->constitution_date->format('d/m/Y'),
                "state_company" => ($user->state_company == 1) ? 'SI': 'NO',
                "imageFront" => ($user->front_image == null) ? 'front.png': $user->front_image,
                "imageReverse" => ($user->reverse_image == null) ? 'back.png': $user->reverse_image
            ]);
        }

        return view('user.verifyImages', compact('arrayUsers'));
    }


}
