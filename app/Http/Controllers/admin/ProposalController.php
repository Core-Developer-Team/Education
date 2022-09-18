<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data=Proposal::all();
       return view('admin.proposal',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.addproposal');
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
        $data = Proposal::find($id);
        return view('admin.addproposal',compact('data'));
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
            'proposalname'  => ['required','string'],
            'price'         => ['required','string'],
            'description'   => ['required','string'],
            'file'          => ['required','mimes:jpg,jpeg,svg,pdf,png,jpeg'],
        ]);
        $filename  = $request->file->getClientOriginalName();
        $filePath   =  $request->file('file')->storeAs('Images',$filename,'public');
        Proposal::find($id)->update(array_merge($request->only('proposalname','price','description'),[
            'file'     =>'/storage/'.$filePath,
            'filename' => $filename,
        ]));
        return back()->with('status','Your Proposal updated Successfully:)');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function del(Request $request)
    {
        $data=Proposal::find($request->proposal_id);
        $file_path = public_path().$data->file;
        if(File::exists($file_path))
        {
         File::delete($file_path);
        }
        $data->delete();
        return back()->with('success', 'Course has deleted Successfully');
    }
}
