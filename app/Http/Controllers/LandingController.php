<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class LandingController extends Controller
{
    public function faqs()
    {
        return view('landing.faqs');
    }

    public function termsAndConditions($filename)
    {
        $path = public_path('assets/files/'.$filename);

        if (file_exists($path)) {
            return Response::file($path);
        } else {
            abort(404);
        }
    }

    public function privacyPolicy($filename)
    {
        $path = public_path('assets/files/'.$filename);

        if (file_exists($path)) {
            return Response::file($path);
        } else {
            abort(404);
        }
    }
}
