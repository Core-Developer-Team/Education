<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data= ModelsRequest::all();
       return view('admin.request',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.addrequest');
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
       $data = ModelsRequest::find($id);
       return view('admin.addrequest',compact('data'));
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
            'requestname'  => ['required','string'],
            'coursename'   => ['required','string'],
            'description'  => ['required','string'],
            'file'         => ['required','mimes:jpg,jpeg,svg,pdf,png'],
            'tag'          => ['required'],
        ]);
        $filename = time().'_'.$request->file->getClientOriginalName();
        $imgPath = $request->file('file')->storeAs('ReqFile',$filename,'public');
        ModelsRequest::find($id)->update(array_merge($request->only('requestname','coursename','description','tag'),[
            'file'    =>'/storage/'.$imgPath,
            'filename' => $filename,
        ]));
        return back()->with('reqstatus','Your Request updated Successfully:)');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=ModelsRequest::find($id);
        $file_path = public_path().$data->file;
        if(File::exists($file_path))
        {
         File::delete($file_path);
        }
        $data->delete();
        return back()->with('success', 'Course has deleted Successfully');
    }
}
