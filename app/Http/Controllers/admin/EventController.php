<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Event::orderBy('updated_at', 'DESC')->get();
        return view('admin.event', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.addevent');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required',
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
            'user_id' => auth()->user()->id,
        ]));
       
        return redirect(route('admin.event.index'))->with('success','Event has Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Event::find($id);
        return view('admin.addevent', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'   => 'required',
            'image'          => 'required|image|mimes:jpg,jpeg,png,svg',
            'description'    => 'required|string',
            'location'       => 'required',
            'event_date'     => 'required',
            'start_time'     => 'required',
            'end_time'       => 'required',
        ]);
        $imagename = time() . '_' . $request->image->getClientOriginalName();
        $imagepath = $request->file('image')->storeAs('Images', $imagename, 'public');

        Event::find($id)->update(array_merge($request->only('description', 'location', 'event_date', 'start_time', 'end_time', 'name'), [

            'image'   => '/storage/' . $imagepath,
        ]));
        return redirect(route('admin.event.index'))->with('success','Event has Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function del(Request $request)
    {

        $data = Event::find($request->event_id);
        $file_path = public_path() . $data->image;
        if (File::exists($file_path)) {
            File::delete($file_path);
        }
        $data->delete();
        return back()->with('success', 'Event has deleted Successfully');
    }
}
