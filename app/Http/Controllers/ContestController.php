<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContestController extends Controller
{
    public function index()
    {
        $data = Contest::where('event_date','=', Carbon::now()->format('Y:m:d'))->cursorPaginate(6);
        $expires = Contest::where('event_date','<', Carbon::now()->format('Y:m:d'))->cursorPaginate(6);
        $upcoming = Contest::where('event_date','>', Carbon::now()->format('Y:m:d'))->cursorPaginate(6);
        $contest = Contest::all();
        $contestcount = $contest->count();
        return view('contest', compact('data','expires','upcoming','contestcount'));
    }
   
    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required',
            'image'          => 'required|image|mimes:jpg,jpeg,png,svg',
            'description'    => 'required|string',
            'location'       => 'required',
            'event_date'     => 'required',
            'start_time'     => 'required',
            'end_time'       => 'required',
        ]);
        $imagename = time() . '_' . $request->image->getClientOriginalName();
        $imagepath = $request->file('image')->storeAs('Images', $imagename, 'public');

        Contest::create(array_merge($request->only('description', 'location', 'event_date', 'start_time', 'end_time', 'name'), [
            'image' => '/storage/' . $imagepath,
        ]));
        return back()->with('status', 'Event
         has been created Successfully');
    }
}
