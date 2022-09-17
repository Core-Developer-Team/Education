<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Resource::all();
        return view('admin.resource',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.addresource');
    }

    public function edit($id)
    {
        $data = Resource::find($id);
        return view('admin.addresource',compact('data'));
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
            'name'  => ['required','string'],
            'description'  => ['required','string'],
            'file'         => [ 'required','mimes:csv,jpg,jpeg,png,txt,xlx,xls,pdf,docx,pptx|max:30000'],
              ]);
          $filename = time().'_'.$request->file->getClientOriginalName();
          $imgPath = $request->file('file')->storeAs('ReqFile',$filename,'public');
          Resource::find($id)->update(array_merge($request->only('name','description'),[
            'file_path'    =>'/storage/'.$imgPath,
            'file_name'  => $filename,
             ]));
           return back()->with('status','Your Resource updated Successfully:)');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function del(Request $request)
    {
  
        $data=Resource::find($request->res_id);
        $file_path = public_path().$data->file_path;
        if(File::exists($file_path))
        {
         File::delete($file_path);
        }
        $data->delete();
        return back()->with('success', 'Resource has deleted Successfully');
    }
}
