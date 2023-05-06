<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AccountCustomerController extends Controller
{
    public function index()
    {
        /*session(['codigo_correcto' => true]);*/
        /*Session::forget('codigo_correcto');*/
        return "Pagina protegida";
        //return view('accountCustomer.index', compact('response'));
    }

    public function operaciones()
    {
        /*session(['codigo_correcto' => true]);*/
        /*Session::forget('codigo_correcto');*/
        return "Pagina de operaciones";
        //return view('accountCustomer.index', compact('response'));
    }
}
