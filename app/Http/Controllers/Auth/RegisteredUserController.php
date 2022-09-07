<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'username'  => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile_no' => ['required','max:11','unique:users'],
            'image'     => ['required','image','mimes:jpg,jpeg,png,svg'],
            'uni_id'    => ['required','string'],
            'uni_name'  => ['required','string'],
            'department'=> ['required'],
            'gender'    => ['required'],
            'cover_img' => ['required'],
            'password'  => ['required', 'confirmed', Rules\Password::defaults()],
            'terms'     =>  ['accepted', 'required'],
        ]);
     
        $filename = time().'_'.$request['image']->getClientOriginalName();
        $imgPath = $request['image']->storeAs('profile-photos',$filename,'public');
        $covername = time().'_'.$request['cover_img']->getClientOriginalName();
        $coverimgPath = $request['cover_img']->storeAs('profile-photos',$covername,'public');
        
        $user = User::create([
            'username'   => $request->username,
            'email'      => $request->email,
            'mobile_no'  => $request->mobile_no,
            'image'      => $imgPath,
            'cover_img'  => $coverimgPath,
            'uni_id'     => $request->uni_id,
            'gender'     => $request->gender,
            'uni_name'   => $request->uni_name,
            'department' => $request->department,
            'password'   => Hash::make($request->password),
            'role_id'    => '2',
            'badge_id'   => '1',
        ]);

        event(new Registered($user));

        $request->session()->regenerate();
        $announcements = Event::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->first();
        
        Session::flash('announcements', $announcements);

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
