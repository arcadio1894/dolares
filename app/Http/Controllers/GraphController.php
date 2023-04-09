<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GraphController extends Controller
{
    public function indexKambista()
    {
        return view('graph.indexKambista');
    }

    public function indexBloomberg()
    {
        return view('graph.indexBloomberg');
    }

    public function indexGoogle()
    {
        return view('graph.indexGoogle');
    }

    public function indexCocosylucas()
    {
        return view('graph.indexCocosylucas');
    }

    public function indexTKambio()
    {
        return view('graph.indexTKambio');
    }

    public function indexSecuEx()
    {
        return view('graph.indexSecuEx');
    }

    public function indexDolareros()
    {
        return view('graph.indexDolareros');
    }
}
