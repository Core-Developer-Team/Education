<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        return view('admin.user',compact('data'));
    }

    public function upstatus($id)
    {
       $user =  User::find($id);
       if($user->status == 0)
       {
        $user->status = '1';
       }
       elseif($user->status==1)
       {
        $user->status = '0';
       }
       $user->save();
       return back()->with('success', 'Status Updated Successfully');
    }

    public function delete(Request $request)
    {
      
        $data=User::find($request->user_id);
        $file_path = public_path().'/storage/'.$data->profile_photo_path;
        if(File::exists($file_path))
        {
         File::delete($file_path);
        }
        $data->delete();
        return back()->with('success', 'User has deleted Successfully');
    }

    // show Role Update Page
    public function showeditrole($id)
    {   $role = Role::all();
        $user = User::findOrFail($id);
        return view('admin.editrole',compact('user','role'));
    }
    //update Role
    public function updaterole(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->role_id = $request->role;
        $user->save();
        return redirect(route('admin.user.index'))->with('success', 'Role Updated Successfully');
    }
}
