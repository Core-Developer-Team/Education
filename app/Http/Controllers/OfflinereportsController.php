<?php

namespace App\Http\Controllers;

use App\Models\Offlinereports;
use Illuminate\Http\Request;

class OfflinereportsController extends Controller
{
    public function store(Request $request)
    {
       
        $request->validate([
            'description' => 'required',
         ]);
         Offlinereports::create(array_merge($request->only('description'), [
            'user_id'      => $request->user_id,
            'offlinetopic_id' => $request->chat_id,
          ]));
          return back()->with('success', 'Report send Successfully');
    }
}
