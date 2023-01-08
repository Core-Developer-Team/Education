<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BadgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Badge::all();
        return view('admin.badges',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.addbadge');
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
            'description'  => 'required|string',
            'solution'     => 'required|integer|regex:/^[0-9]+$/',
            'rating'     => 'required|numeric|min:0|max:5',
        ]);
        $imagename = time().'_'.$request->image->getClientOriginalName();
        $imagepath = $request->file('image')->storeAs('Images',$imagename, 'public');

        Badge::create(array_merge($request->only('description','solution','rating','name'),[
            'user_id'   => auth()->id(),
            'image' => '/storage/'.$imagepath,
        ]));
        return back()->with('success', 'Badge has been uploaded Successfully');
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
        $data = Badge::find($id);
        return view('admin.addbadge', compact('data'));
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
            'description'  => 'required|string',
            'solution'     => 'required|integer|regex:/^[0-9]+$/',
            'rating'     => 'required|numeric|min:0|max:5',
        ]);
        $imagename = time().'_'.$request->image->getClientOriginalName();
        $imagepath = $request->file('image')->storeAs('Images',$imagename, 'public');

        Badge::find($id)->update(array_merge($request->only('description','solution','rating','name'),[
            'image' => '/storage/'.$imagepath,
        ]));
        return back()->with('success', 'Badge has Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function del(Request $request)
    {
        $data=Badge::find($request->badge_id);
        $file_path = public_path().$data->image;
        if(File::exists($file_path))
        {
         File::delete($file_path);
        }
        $data->delete();
        return back()->with('success', 'Badge has deleted Successfully');
    }
}
