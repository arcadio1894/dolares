<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function faqs()
    {
        return view('landing.faqs');
    }
}
