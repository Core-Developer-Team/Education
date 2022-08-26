<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use Illuminate\Http\Request;

class BadgesController extends Controller
{
    public function show()
    {
        $badges = Badge::all();
        return view('badges',compact('badges'));
    }
}
