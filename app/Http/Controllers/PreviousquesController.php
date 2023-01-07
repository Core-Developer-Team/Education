<?php

namespace App\Http\Controllers;

use App\Models\Previousques;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Session;

class PreviousquesController extends Controller
{
   //store requests
   public function insert(FlasherInterface $flasher, Request $request)
   {

       $request->validate([
           'quesname'  => ['required', 'string', 'max:25'],
           'description'  => ['required', 'string'],
           'coursename'   => ['required', 'string'],
           'price'          => ['required'],
           'file'         => ['required', 'mimes:jpg,jpeg,svg,pdf,png,zip,rar'],
       ]);

           $filename = time() . '_' . $request->file->getClientOriginalName();
           $imgPath = $request->file('file')->storeAs('ReqFile', $filename, 'public');
           Previousques::create(array_merge($request->only('quesname', 'coursename', 'description','price'), [
               'user_id' => auth()->id(),
               'file'    => '/storage/' . $imgPath,
               'filename' => $filename,
           ]));

       flash()->addSuccess('Your Question Published Successfully:)');
       return redirect('/previousyearrequests');
   }
    //show single resource
  public function showsingle($id)
  {
    $data = Previousques::find($id);
    //increase view count
    $res_key = 'res_' . $id;
    if (!Session::has($res_key)) {
     $data->increment('view_count');
      Session::put($res_key, 1);
    }
    return view('previousques_single', compact('data'));
  }
}
