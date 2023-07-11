<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponDestroyRequest;
use App\Http\Requests\CouponStoreRequest;
use App\Http\Requests\CouponUpdateRequest;
use App\Models\Coupon;
use App\Models\User;
use App\Models\UserCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::all();

        return view('coupon.index', compact('coupons'));
    }

    public function store( CouponStoreRequest $request )
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {

            Coupon::create([
                'name' => $request->get('name'),
                'amountBuy' => $request->get('amountBuy'),
                'amountSell' => $request->get('amountSell'),
                'status' => 1,
                'special' => ($request->get('special') == 1) ? 1:0,
            ]);

            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Cupón guardado correctamente.',
        ], 200);
    }

    public function update( CouponUpdateRequest $request )
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {

            $coupon = Coupon::find($request->get('coupon_id'));

            $couponUsers = UserCoupon::where('coupon_id', $coupon->id)->get();
            if ( count($couponUsers) > 0 )
            {
                return response()->json(['message' => 'No se puede editar el cupón porque ha sido usado por usuarios.'], 422);
            }

            $coupon->name = $request->get('name');
            $coupon->amountBuy = $request->get('amountBuy');
            $coupon->amountSell = $request->get('amountSell');
            $coupon->save();

            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Cupón modificado correctamente.',
        ], 200);
    }

    public function destroy( CouponDestroyRequest $request, $coupon_id )
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {

            $coupon = Coupon::find($request->get('coupon_id'));

            $couponUsers = UserCoupon::where('coupon_id', $coupon->id)->get();
            if ( count($couponUsers) > 0 )
            {
                return response()->json(['message' => 'No se puede eliminar el cupón porque ha sido usado por usuarios.'], 422);
            }

            $coupon->delete();

            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Cupón eliminado correctamente.',
        ], 200);
    }

    public function updateStatus( Request $request )
    {
        $coupon_id = $request->get('coupon_id');
        $status = $request->get('status');

        $coupon = Coupon::find($coupon_id);
        $coupon->status = $status;
        $coupon->save();

        return response()->json([
            'message' => 'Estado actualizado con éxito'
        ], 200);
    }

    public function updateSpecial( Request $request )
    {
        $coupon_id = $request->get('coupon_id');
        $special = $request->get('special');

        $coupon = Coupon::find($coupon_id);
        $coupon->special = $special;
        $coupon->save();

        return response()->json([
            'message' => 'Estado actualizado con éxito'
        ], 200);
    }

    public function getUserCoupon($idCoupon)
    {
        $coupon = Coupon::find($idCoupon);
        if ( $coupon->special != 1 )
        {
            return response()->json(['message' => "No se puede asignar porque no es un cupón especial."], 422);
        }

        $users = User::all();

        $arrayUsers = [];

        foreach ( $users as $user )
        {
            $userCoupon = UserCoupon::where('user_id', $user->id)
                ->where('coupon_id', $coupon->id)->first();
            if (isset($userCoupon))
            {
                array_push($arrayUsers, [
                    'name' => ($user->business_name == null) ? $user->first_name." ".$user->last_name:$user->business_name,
                    'id' => $user->id,
                    'assign' => 1
                ]);
            } else {
                array_push($arrayUsers, [
                    'name' => ($user->business_name == null) ? $user->first_name." ".$user->last_name:$user->business_name,
                    'id' => $user->id,
                    'assign' => 0
                ]);
            }
        }

        return response()->json([
            'users' => $arrayUsers
        ], 200);
    }

    public function getUserDocument(Request $request)
    {
        $document = $request->input('document');

        $user = User::where('document', $document)->first();

        if ( isset($user) )
        {
            if ($user->account_type == 'p')
            {
                $avatar = strtoupper(substr($user->first_name, 0, 1).substr($user->last_name, 0, 1));
            } else {
                $avatar = strtoupper(substr($user->business_name, 0, 1));
            }

            $data = [
                'avatar' => $avatar,
                'id' => $user->id,
                'document' => $user->document,
                'name' => ($user->business_name != null) ? $user->business_name : $user->first_name . " " . $user->last_name,
                'phone' => $user->phone
            ];
        } else {
            $data = [
                'avatar' => 'NN',
                'id' => null,
                'document' => '000000000',
                'name' => 'Usuario no encontrado',
                'phone' => '00000000'
            ];
        }

        return response()->json([
            'user' => $data
        ], 200);
    }

    public function getDataCoupon(Request $request)
    {
        $idCoupon = $request->input('idCoupon');

        $coupon = Coupon::find($idCoupon);
        if ( $coupon->special != 1 )
        {
            return response()->json(['message' => "No se puede asignar porque no es un cupón especial."], 422);
        } else {
            return response()->json([
                'data' => true
            ], 200);
        }
    }

    public function getUserCouponAssign(Request $request)
    {
        $idCoupon = $request->input('idCoupon');

        $coupon = Coupon::find($idCoupon);

        $users = [];

        if ( $coupon->special != 1 )
        {
            return response()->json(['message' => "No se puede asignar porque no es un cupón especial."], 422);
        } else {
            $userCoupons = UserCoupon::where('coupon_id', $coupon->id)->get();
            foreach ( $userCoupons as $userCoupon )
            {
                $user = User::find($userCoupon->user_id);

                if ($user->account_type == 'p')
                {
                    $avatar = strtoupper(substr($user->first_name, 0, 1).substr($user->last_name, 0, 1));
                } else {
                    $avatar = strtoupper(substr($user->business_name, 0, 1));
                }

                array_push($users, [
                    'avatar' => $avatar,
                    'id' => $user->id,
                    'document' => $user->document,
                    'name' => ($user->business_name != null) ? $user->business_name : $user->first_name . " " . $user->last_name,
                    'phone' => $user->phone
                ]);
            }
        }

        return response()->json([
            'users' => $users
        ], 200);
    }

    public function assign( Request $request)
    {
        $user_id = $request->get('user_id');
        $coupon_id = $request->get('coupon_id');
        DB::beginTransaction();
        try {
            $user = User::find($user_id);
            $coupon = Coupon::find($coupon_id);

            if ( $coupon->special == 0 )
            {
                return response()->json(['message' => 'No se puede asignar el cupón porque no es especial.'], 422);
            }

            UserCoupon::firstOrCreate([
                'user_id' => $user->id,
                'coupon_id' => $coupon->id,
            ]);

            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Cupón asignado correctamente.',
        ], 200);
    }
}
