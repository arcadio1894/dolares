<?php

namespace App\Http\Controllers;

use App\Http\Requests\InformationDestroyRequest;
use App\Http\Requests\InformationStoreRequest;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class InformationController extends Controller
{
    public function getDataInformations() {
        // Aquí obtén las imágenes de tu fuente de datos (base de datos, API, etc.)
        $images = Information::where('active', 1)->get();

        $imagenes = [];

        foreach ( $images as $image )
        {
            $url = asset("assets/images/information/".$image->image);
            array_push($imagenes, [
                "url" =>$url
            ]);
        }

        return response()->json(['images' => $imagenes]);
    }

    public function index()
    {
        $informations = Information::where('active', 1)->get();

        return view('information.index', compact('informations'));
    }

    public function store( InformationStoreRequest $request )
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {

            $information = Information::create([
                'active' => 1,
            ]);

            if (!$request->file('image')) {
                $information->image = 'no_image.png';
                $information->save();
            } else {
                $path = public_path().'/assets/images/information/';
                $img = $request->file('image');

                $filename = 'imagen_'.$information->id .'.JPG';
                $imgBank = Image::make($img);
                $imgBank->orientate();
                $imgBank->save($path.$filename, 80, 'JPG');

                $information->image = $filename;
                $information->save();

            }

            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Noticia guardada correctamente.',
        ], 200);
    }

    public function destroy( InformationDestroyRequest $request, $coupon_id )
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {

            $information = Information::find($request->get('information_id'));

            if ($information->image !== 'no_image.png')
            {
                $my_image = public_path().'/assets/images/information/'.$information->image;
                if (@getimagesize($my_image)) {
                    unlink($my_image);
                }

            }

            $information->delete();

            DB::commit();

        } catch ( \Throwable $e ) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'message' => 'Noticia eliminada correctamente.',
        ], 200);
    }

    public function updateStatus( Request $request )
    {
        $information_id = $request->get('information_id');
        $status = $request->get('status');

        $information = Information::find($information_id);
        $information->active = $status;
        $information->save();

        return response()->json([
            'message' => 'Estado actualizado con éxito'
        ], 200);
    }
}
