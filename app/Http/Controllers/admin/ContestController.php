<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;

class ContestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Contest::orderBy('updated_at', 'DESC')->get();
        return view('admin.contest', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.addcontest');
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
            'price'          => 'required',
            'end_time'       => 'required',
        ]);
        $imagename = time() . '_' . $request->image->getClientOriginalName();
        $imagepath = $request->file('image')->storeAs('Images', $imagename, 'public');

        Contest::create(array_merge($request->only('description', 'location', 'price', 'event_date', 'start_time', 'end_time', 'name'), [
            'image' => '/storage/' . $imagepath,
            'user_id' => auth()->user()->id,
        ]));
        return redirect(route('admin.contest.index'))->with('success','contest has been created Successfully');
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
        $data = Contest::find($id);
        return view('admin.addcontest', compact('data'));
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
            'price'          => 'required',
            'end_time'       => 'required',
        ]);
        $imagename = time() . '_' . $request->image->getClientOriginalName();
        $imagepath = $request->file('image')->storeAs('Images', $imagename, 'public');

        Contest::find($id)->update(array_merge($request->only('description', 'price', 'location', 'event_date', 'event_time', 'name'), [

            'image'   => '/storage/' . $imagepath,
        ]));
      
        return redirect(route('admin.contest.index'))->with('success','contest has Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function del(Request $request)
    {

        $data = Contest::find($request->event_id);
        $file_path = public_path() . $data->image;
        if (File::exists($file_path)) {
            File::delete($file_path);
        }
        $data->delete();
        return back()->with('success', 'Contest has deleted Successfully');
    }
}
