<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponDestroyRequest;
use App\Http\Requests\CouponStoreRequest;
use App\Http\Requests\CouponUpdateRequest;
use App\Models\Coupon;
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

    public function assign( $coupon_id, $user_id )
    {

        DB::beginTransaction();
        try {

            $coupon = Coupon::find($coupon_id);
            $user = Coupon::find($user_id);

            if ( $coupon->special == 0 )
            {
                return response()->json(['message' => 'No se puede asignar el cupón porque no es especial.'], 422);
            }

            UserCoupon::create([
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
