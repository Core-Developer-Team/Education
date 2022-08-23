<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Feedback;
use App\Models\Product;
use App\Models\Reqbid;
use App\Models\Reqcomment;
use App\Models\ReqSolution;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::where('id',Auth()->id())->first();
        return view('profile',compact('user'));
    }
 
    public function update(Request $request, $id){
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => 'unique:users,email,' . $id,
            'mobile_no' => ['required','max:11'],
            'uni_id'    => ['required','string'],
            'uni_name'  => ['required','string'],
            'gender'    => ['required'],
        ]);
        $users=User::find($id);
        if($request->hasFile('image')){
            $request->validate([
              'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
        $filename = time().'_'.$request['image']->getClientOriginalName();
        $imgPath = $request['image']->storeAs('profile-photos',$filename,'public');
        $users->update(['image'=> $imgPath]);
        }
       $users->update([
            'username' => $request->username,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'uni_id' => $request->uni_id,
            'uni_name' => $request->uni_name,
            'gender'   => $request->gender,
        ]);
        return back()->with('message','Profile Updated Susseffully:)');
    }
    public function password(){
        
        return view('profile_password');
    }
    public function UpdatePass(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
   
        return back()->with('success','Password change successfully.');
    }

    public function show()
    {
        $user = User::where('id',Auth()->id())->first();
        $review = Feedback::where('user_id',Auth()->id())->inRandomOrder()->limit(4)->get();
        $reqcomment = Reqcomment::where('user_id',Auth()->id())->inRandomOrder()->limit(4)->get();
        $reqbid  = Reqbid::where('user_id',Auth()->id())->inRandomOrder()->limit(4)->get();
        $reqsol  = ReqSolution::where('user_id',Auth()->id())->inRandomOrder()->limit(4)->get();
        return view('profile_dashboard',compact('user','review','reqcomment','reqbid','reqsol'));
    }
    public function showreview()
    {
        $review = Feedback::where('user_id',Auth()->id())->orderBy('created_at','DESC')->cursorPaginate(6);
        $user = User::where('id',Auth()->id())->first();
        return view('myprofile_reviews',compact('user','review')); 
    }
    public function showactivity()
    {
        $reqcomment = Reqcomment::where('user_id',Auth()->id())->orderBy('created_at','DESC')->get();
        $reqbid  = Reqbid::where('user_id',Auth()->id())->orderBy('created_at','DESC')->get();
        $reqsol  = ReqSolution::where('user_id',Auth()->id())->orderBy('created_at','DESC')->get();
        $user = User::where('id',Auth()->id())->first();
        return view('myprofile_activity',compact('user','reqcomment','reqbid','reqsol'));      
    }
    public function showearning()
    {
        $user = User::where('id',Auth()->id())->first();
        return view('myprofile_earning',compact('user')); 
    }

    public function myreqs()
    {
        $reqs = ModelsRequest::where('user_id',Auth()->id())->orderBy('created_at','DESC')->cursorPaginate(6);

        return view('profile_myreqs',compact('reqs'));
    }
    public function products()
    {
        $product = Product::where('user_id',Auth()->id())->orderBy('created_at','DESC')->cursorPaginate(6);
        return view('profile_myproducts',compact('product'));
    }
    public function Book()
    {
        $book = Book::where('user_id',Auth()->id())->orderBy('created_at','DESC')->cursorPaginate(6);
        return view('profile_mybook',compact('book'));
    }

}
