<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\Contest_user;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContestController extends Controller
{
    public function index()
    {
        $data = Contest::where('event_date','=', Carbon::now()->format('Y-m-d'))->cursorPaginate(6);
        $expires = Contest::where('event_date','<', Carbon::now()->format('Y-m-d'))->cursorPaginate(6);
        $upcoming = Contest::where('event_date','>', Carbon::now()->format('Y-m-d'))->cursorPaginate(6);
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
            'price'          => 'required',
        ]);
        $imagename = time() . '_' . $request->image->getClientOriginalName();
        $imagepath = $request->file('image')->storeAs('Images', $imagename, 'public');

        Contest::create(array_merge($request->only('description', 'location','price','event_date', 'start_time', 'end_time', 'name'), [
            'image' => '/storage/' . $imagepath,
            'user_id' => Auth()->id(),
        ]));
        return back()->with('status', 'Event
         has been created Successfully');
    }
    public function single($id)
    {
        $data = Contest::find($id);
        return view('contestdetail',compact('data'));
    }
    public function interested($id , $mesg)
    {
       Contest_user::create([
            'slug'     => $mesg,
            'contest_id' => $id,
            'user_id'  => Auth()->id(),
       ]);
       return back()->with('status','Thanks for Your Interest...');
    }
}
