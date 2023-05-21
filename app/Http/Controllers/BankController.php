<?php

namespace App\Http\Controllers;

use App\Http\Requests\BankDestroyRequest;
use App\Http\Requests\BankStoreRequest;
use App\Http\Requests\BankUpdateRequest;
use App\Models\AccountDolarero;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class BankController extends Controller
{
    public function index()
    {
        $banks = Bank::all();
        
        return view('bank.index', compact('banks'));
    }

    public function create()
    {
        return view('bank.create');
    }

    public function store( BankStoreRequest $request )
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {

            $bank = Bank::create([
                'nameBank' => $request->get('nameBank')
            ]);

            if (!$request->file('imageBank')) {
                $bank->image = 'no_image.png';
                $bank->save();
            } else {
                $path = public_path().'/assets/images/banks/';
                $img = $request->file('imageBank');

                $filename = $bank->id .'_'. $this->generateRandomString(10). '.JPG';
                $imgBank = Image::make($img);
                $imgBank->orientate();
                $imgBank->save($path.$filename, 80, 'JPG');

                $bank->imageBank = $filename;
                $bank->save();

            }

            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Banco guardado correctamente.',
        ], 200);
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function update( BankUpdateRequest $request )
    {
        //dd($request->get('statusBank'));
        $validated = $request->validated();

        DB::beginTransaction();
        try {

            $bank = Bank::find($request->get('bank_id'));

            $bank->nameBank = $request->get('nameBank');
            $bank->status = ($request->get('statusBank') == 1) ? 1:0;
            $bank->save();

            if (!$request->file('imageBank')) {
                if ($bank->imageBank == 'no_image.png' || $bank->imageBank == null) {
                    $bank->imageBank = 'no_image.png';
                    $bank->save();
                }

            } else {
                $path = public_path().'/assets/images/banks/';
                $img = $request->file('imageBank');

                $filename = $bank->id .'_'. $this->generateRandomString(10). '.JPG';
                $imgBank = Image::make($img);
                $imgBank->orientate();
                $imgBank->save($path.$filename, 80, 'JPG');

                $bank->imageBank = $filename;
                $bank->save();

            }

            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Banco modificado correctamente.',
        ], 200);
    }

    public function updateStatus( Request $request )
    {
        $bank_id = $request->get('bank_id');
        $statusBank = $request->get('statusBank');

        $bank = Bank::find($bank_id);
        $bank->status = $statusBank;
        $bank->save();

        return response()->json([
            'message' => 'Estado actualizado con éxito'
        ], 200);
    }

    public function destroy( BankDestroyRequest $request, $bank_id )
    {
        $validated = $request->validated();

        $accounts = AccountDolarero::where('bank_id', $request->get('bank_id'))->get();
        if ( count($accounts) > 0 )
        {
            return response()->json([
                'message' => 'No se puede eliminar porque hay cuentas asociadas a este banco.',
            ], 422);
        }

        DB::beginTransaction();
        try {

            $bank = Bank::find($request->get('bank_id'));

            $bank->delete();

            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Banco eliminado correctamente.',
        ], 200);
    }


}
