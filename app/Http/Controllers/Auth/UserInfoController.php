<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserInfoController extends Controller
{
    public function index()
    {
        return view('auth.userinfo');
    }

    public function store(Request $request)
    {
        $request->validate([
            'mobile_no' => ['required', 'max:11', 'unique:users'],
            'image'     => ['required', 'image', 'mimes:jpg,jpeg,png,svg'],
            'uni_id'    => ['required', 'string'],
            'uni_name'  => ['required', 'string'],
            'department' => ['required', 'regex:/^(0|1|2)$/'],
            'gender'    => ['required', 'regex:/^(0|1)$/'],
            'cover_img' => ['required'],
            'terms'     =>  ['accepted', 'required'],
        ]);

        $filename = time() . '_' . $request['image']->getClientOriginalName();
        $imgPath = $request['image']->storeAs('profile-photos', $filename, 'public');
        $covername = time() . '_' . $request['cover_img']->getClientOriginalName();
        $coverimgPath = $request['cover_img']->storeAs('profile-photos', $covername, 'public');

        $email = auth()->user()->email;
        $user = User::where('email', $email)->update([
            'mobile_no'  => $request->mobile_no,
            'image'      => $imgPath,
            'cover_img'  => $coverimgPath,
            'uni_id'     => $request->uni_id,
            'gender'     => $request->gender,
            'uni_name'   => $request->uni_name,
            'department_id' => $request->department,
            'role_id'    => '2',
            'badge_id'   => '1',
        ]);

        $announcements = Announcement::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->first();
        Session::flash('announcements', $announcements);

        return redirect('/');
    }
}
