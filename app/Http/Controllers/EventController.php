<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $data = Event::where('event_date','=', Carbon::now()->format('Y:m:d'))->cursorPaginate(6);
        $expires = Event::where('event_date','<', Carbon::now()->format('Y:m:d'))->cursorPaginate(6);
        $upcoming = Event::where('event_date','>', Carbon::now()->format('Y:m:d'))->cursorPaginate(6);
        return view('event', compact('data','expires','upcoming'));
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

        Event::create(array_merge($request->only('description', 'location', 'event_date', 'start_time', 'end_time', 'name'), [
            'image' => '/storage/' . $imagepath,
        ]));
        return back()->with('status', 'Event
         has been created Successfully');
    }
}
