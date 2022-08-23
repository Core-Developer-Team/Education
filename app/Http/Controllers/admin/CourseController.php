<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Course::all();
        return view('admin.course',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.addcourse');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $data = Course::find($id);
        return view('admin.addcourse',compact('data'));
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
            'coursename'   => 'required',
            'pic'          => 'required|image|mimes:jpg,jpeg,png,svg',
            'description'  => 'required|string',
            'price'        => 'required',
        ]);
        $imagename = time().'_'.$request->pic->getClientOriginalName();
        $imagepath = $request->file('pic')->storeAs('Images',$imagename, 'public');

        Course::find($id)->update(array_merge($request->only('description','price','coursename'),[
            'pic' => '/storage/'.$imagepath,
        ]));
        return back()->with('success', 'Course has been updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $data=Course::find($id);
       $file_path = public_path().$data->pic;
       if(File::exists($file_path))
       {
        File::delete($file_path);
       }
       $data->delete();
       return back()->with('success', 'Course has deleted Successfully');
    }
}
