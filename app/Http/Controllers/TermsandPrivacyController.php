<?php

namespace App\Http\Controllers;

use App\Models\Privacy;
use App\Models\Terms;
use Illuminate\Http\Request;

class TermsandPrivacyController extends Controller
{
    public function termshow()
    {
        $term = Terms::first();
     
        return view('terms',compact('term'));
    }
    public function privacyshow()
    {
        $policy = Privacy::first();
        return view('privacy',compact('policy'));
    }
}
