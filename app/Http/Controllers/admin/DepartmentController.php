<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $dep = Department::all();
        return view('admin.userdep',compact('dep'));
    }
    public function show()
    {
        return view('admin.adddepartment');
    }
    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|max:5',
        ]);
        Department::Create([
             'name' => $request->name,
        ]);
        return redirect(route('admin.dep'))->with('success', 'Department Added Successfully');

    }
    public function del(Request $request)
    {
       $data=Department::find($request->dep_id);
       $data->delete();
       return back()->with('success', 'Department has deleted Successfully');
    }
}
