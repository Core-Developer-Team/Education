<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermsandPrivacyController extends Controller
{
    public function termshow()
    {
        return view('terms');
    }
    public function privacyshow()
    {
        return view('privacy');
    }
}
