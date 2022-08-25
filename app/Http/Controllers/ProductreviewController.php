<?php

namespace App\Http\Controllers;

use App\Models\Productreview;
use Illuminate\Http\Request;

class ProductreviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rating'       => 'required',
            'description'  => 'required|string',
        ]);

        Productreview::create(array_merge($request->only('description', 'rating'), [
            'user_id'   => auth()->id(),
            'product_id'   => $request->product_id,
        ]));
        return back()->with('status', 'Thanks for your Review :)');
    }
}
