<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Department;
use App\Models\Feedback;
use App\Models\PaymentLog;
use App\Models\Product;
use App\Models\Proposalbid;
use App\Models\Proposalreview;
use App\Models\Propsolution;
use App\Models\Reqbid;
use App\Models\Reqcomment;
use App\Models\ReqSolution;
use App\Models\Request as ModelsRequest;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::where('id', Auth()->id())->first();
        $dep = Department::all();
        return view('profile', compact('user','dep'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'username'  => ['required', 'string', 'max:255'],
            'email'     => 'unique:users,email,' . $id,
            'mobile_no' => ['required', 'max:11'],
            'uni_id'    => ['required', 'string'],
            'uni_name'  => ['required', 'string'],
            'gender'    => ['required'],
            'department_id'=> ['required'],
        ]);
        $users = User::find($id);
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $filename = time() . '_' . $request['image']->getClientOriginalName();
            $imgPath = $request['image']->storeAs('profile-photos', $filename, 'public');
            $users->update(['image' => $imgPath]);
        }
        if ($request->hasFile('cover_img')) {
            $request->validate([
                'cover_img' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $coverimg = time() . '_' . $request['cover_img']->getClientOriginalName();
            $coverPath = $request['cover_img']->storeAs('profile-photos', $coverimg, 'public');
            $users->update(['cover_img' => $coverPath]);
        }
        $users->update([
            'username'  => $request->username,
            'email'     => $request->email,
            'mobile_no' => $request->mobile_no,
            'uni_id'    => $request->uni_id,
            'uni_name'  => $request->uni_name,
            'gender'    => $request->gender,
            'department_id' => $request->department_id,
        ]);
        return back()->with('message', 'Profile Updated Susseffully:)');
    }
    public function updatecover(Request $request, $id)
    {
        dd($request->all());
    }
    public function password()
    {

        return view('profile_password');
    }
    public function UpdatePass(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        return back()->with('success', 'Password change successfully.');
    }

    public function show($id)
    {
        $user       = User::where('id', $id)->first();
        $review     = Review::where('t_user_id', $id)->inRandomOrder()->limit(4)->get();
        $preview     = Proposalreview::where('tp_user_id', $id)->inRandomOrder()->limit(4)->get();
        $reqcomment = Reqcomment::where('user_id', $id)->inRandomOrder()->limit(4)->get();
        $reqbid     = Reqbid::where('user_id', $id)->inRandomOrder()->limit(4)->get();
        $reqsol     = ReqSolution::where('user_id', $id)->inRandomOrder()->limit(4)->get();
        $propbid    = Proposalbid::where('user_id', $id)->inRandomOrder()->limit(4)->get();
        $propsol    = Propsolution::where('user_id', $id)->inRandomOrder()->limit(4)->get();
        return view('profile_dashboard', compact('user', 'preview', 'review', 'reqcomment', 'reqbid', 'reqsol', 'propbid', 'propsol'));
    }

    public function showreview($id)
    {
        $review = Review::where('t_user_id', $id)->orderBy('created_at', 'DESC')->get();
        $preview = Proposalreview::where('tp_user_id', $id)->orderBy('created_at', 'DESC')->get();
        $user = User::where('id', $id)->first();
        return view('myprofile_reviews', compact('user', 'review', 'preview'));
    }
    public function showactivity($id)
    {
        $reqcomment = Reqcomment::where('user_id', $id)->orderBy('created_at', 'DESC')->get();
        $reqbid     = Reqbid::where('user_id', $id)->orderBy('created_at', 'DESC')->get();
        $reqsol     = ReqSolution::where('user_id', $id)->orderBy('created_at', 'DESC')->get();
        $propbid    = Proposalbid::where('user_id', $id)->orderBy('created_at', 'DESC')->get();
        $propsol    = Propsolution::where('user_id', $id)->orderBy('created_at', 'DESC')->get();
        $user       = User::where('id', $id)->first();
        $propsol    = Propsolution::where('user_id', $id)->orderBy('created_at', 'DESC')->get();
        return view('myprofile_activity', compact('user', 'reqcomment', 'reqbid', 'reqsol', 'propbid', 'propsol'));
    }
    public function showearning($id)
    {
        $data = [];
        $data["user"] = User::where('id', $id)->first();
        $data["model"] = new PaymentLog();
        $data["items"] = PaymentLog::where('seller_id', auth()->user()->id)->get()->groupBy('pay_for');
        $step = 'requests';
        if (isset($_GET["step"])) {
            $step = $_GET["step"];
        }

        $numebrOfDayOfMonth = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime(date("Y-m-d H:i:s"))), date('Y', strtotime(date("Y-m-d H:i:s"))));
        $currentMonth  = date('m', strtotime(date("Y-m-d H:i:s")));
        $currentYear = date('Y', strtotime(date("Y-m-d H:i:s")));

        $firstDayOfMonth =  $currentYear . '-' . $currentMonth . '-01 00:00:00';
        $lastDayOfMonth = $currentYear . '-' . $currentMonth . '-' . $numebrOfDayOfMonth . ' 23:59:59';


        // $data["thisMonth"] = PaymentLog::where('seller_id', auth()->user()->id)->whereBetween('created_at', ['2022-09-01 00:00:00', '2022-09-30 23:59:59'])->pluck('amount')->sum();
        $data["thisMonth"] = PaymentLog::where('seller_id', auth()->user()->id)->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])->pluck('amount')->sum();

        $data["collections"] = PaymentLog::where('seller_id', auth()->user()->id)->where('pay_for', $step)->get();
        return view('myprofile_earning', $data);
    }

    public function myreqs($id)
    {
        $reqs = ModelsRequest::where('user_id', $id)->orderBy('created_at', 'DESC')->cursorPaginate(6);

        return view('profile_myreqs', compact('reqs'));
    }
    public function products($id)
    {
        $product = Product::where('user_id', $id)->orderBy('created_at', 'DESC')->cursorPaginate(6);
        return view('profile_myproducts', compact('product'));
    }
    public function Book($id)
    {
        $book = Book::where('user_id', $id)->orderBy('created_at', 'DESC')->cursorPaginate(6);
        return view('profile_mybook', compact('book'));
    }
}
