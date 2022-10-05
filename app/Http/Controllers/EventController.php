<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Event_user;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $data = Event::where('event_date','=', Carbon::now()->format('Y-m-d'))->cursorPaginate(6);
        $expires = Event::where('event_date','<', Carbon::now()->format('Y-m-d'))->cursorPaginate(6);
        $upcoming = Event::where('event_date','>', Carbon::now()->format('Y-m-d'))->cursorPaginate(6);
        $event = Event::all();
        $eventcount = $event->count();
        return view('event', compact('data','expires','eventcount','upcoming'));
    }

    public function single($id)
    {
        $data = Event::find($id);
        return view('eventdetail',compact('data'));
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
            'user_id' => Auth()->id(),
            'image'   => '/storage/' . $imagepath,
        ]));
        return back()->with('status', 'Event
         has been created Successfully');
    }
     public function interested($id , $mesg)
     {
        Event_user::create([
             'slug'     => $mesg,
             'event_id' => $id,
             'user_id'  => Auth()->id(),
        ]);
        return back()->with('status','Thanks for Your Interest...');
     }
}
