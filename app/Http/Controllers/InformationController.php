<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;

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
}
