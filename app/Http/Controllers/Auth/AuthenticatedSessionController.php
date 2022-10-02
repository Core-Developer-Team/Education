<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Announcement;
use App\Models\Event;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        $announcements = Announcement::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->first();
  
        Session::flash('announcements', $announcements);
      
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    // Google Sign In / Sign Up
    public function googleStore(Request $request){
        $username = $request->username;
        $email = $request->email;
        
        $user = User::where('email', $email)->first();
        if(empty($user)){
            // Register as a new User
            $user = User::create([
                'username' => $username,
                'email' => $email,
                'role_id' => 2,
                'badge_id' => 1,
                'provider' => true,
            ]);

            Auth::login($user);

            return 'Registered';
        }else{
            if($user->provider){
                Auth::login($user);
                $announcements = Announcement::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->first();
                Session::flash('announcements', $announcements);
                return 'SignedIn';
            }else{
                return 'Error';
            }
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
