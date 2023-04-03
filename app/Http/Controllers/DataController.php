<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    public function getData()
    {

        $data =
            [
                ["x"=>"Enero","y"=>rand(2,10)],
                ["x"=>"Febrero","y"=>rand(2,10)],
                ["x"=>"Marzo","y"=>rand(2,10)],
                ["x"=>"Abril","y"=>rand(2,10)],
                ["x"=>"Mayo","y"=>rand(2,10)],
                ["x"=>"Junio","y"=>rand(2,10)],
                ["x"=>"Julio","y"=>rand(2,10)],
                ["x"=>"Agosto","y"=>rand(2,10)],
                ["x"=>"Septiembre","y"=>rand(2,10)],
                ["x"=>"Octubre","y"=>rand(2,10)],
                ["x"=>"Noviembre","y"=>rand(2,10)],
                ["x"=>"Diciembre","y"=>rand(2,10)]
            ];

        return response()->json([
            "data" => $data
        ]);
    }
}
