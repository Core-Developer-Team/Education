<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Feedback;
use App\Models\Offlinetopic;
use App\Models\PaymentLog;
use App\Models\Product;
use App\Models\Proposal;
use App\Models\Reqbid;
use App\Models\ReqSolution;
use App\Models\Request as ModelsRequest;
use App\Models\Resource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ResourceController extends Controller
{
  //get all resources
  public function index()
  {
    $datas = Resource::orderBy('updated_at', 'DESC')->cursorPaginate(6);
    $req_count = ModelsRequest::count();
    $categ = Resource::orderBy('created_at', 'DESC')->inRandomOrder()->limit(15)->get();
    $feed_count = Feedback::count();
    $mysol = ReqSolution::where('user_id', Auth()->id())->count();
    $myques = ModelsRequest::where('user_id', Auth()->id())->count();
    $res  = Resource::count();
    $event = Event::count();
    $offline = Offlinetopic::count();
    $product = Product::count();
    $prop   = Proposal::count();
    $prev_count = ModelsRequest::whereYear('created_at', date('Y', strtotime('-1 year')))->count();
    $sol_count = ReqSolution::orderBy('created_at', 'DESC')->count();

    return view('resources', compact('datas', 'prev_count', 'sol_count', 'categ', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
  }
  //get latest request
  public function latest()
  {
    $datas = Resource::whereDate('created_at', Carbon::today())->orderBy('updated_at', 'DESC')->cursorPaginate(6);
    $req_count = ModelsRequest::count();
    $feed_count = Feedback::count();
    $mysol = ReqSolution::where('user_id', Auth()->id())->count();
    $myques = ModelsRequest::where('user_id', Auth()->id())->count();
    $res  = Resource::count();
    $event = Event::count();
    $offline = Offlinetopic::count();
    $product = Product::count();
    $prop   = Proposal::count();
    $categ = Resource::orderBy('created_at', 'DESC')->inRandomOrder()->limit(15)->get();
    $prev_count = ModelsRequest::whereYear('created_at', date('Y', strtotime('-1 year')))->count();
    $sol_count = ReqSolution::orderBy('created_at', 'DESC')->count();

    return view('resources', compact('datas', 'categ', 'prev_count', 'sol_count', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
  }
  //get trending request
  public function trending()
  {
    $datas = Resource::where('view_count', '>=', 20)->orderBy('updated_at', 'DESC')->cursorPaginate(6);
    $req_count = ModelsRequest::count();
    $feed_count = Feedback::count();
    $mysol = ReqSolution::where('user_id', Auth()->id())->count();
    $myques = ModelsRequest::where('user_id', Auth()->id())->count();
    $res  = Resource::count();
    $event = Event::count();
    $offline = Offlinetopic::count();
    $product = Product::count();
    $prop   = Proposal::count();
    $categ = Resource::orderBy('created_at', 'DESC')->inRandomOrder()->limit(15)->get();
    $prev_count = ModelsRequest::whereYear('created_at', date('Y', strtotime('-1 year')))->count();
    $sol_count = ReqSolution::orderBy('created_at', 'DESC')->count();
    return view('resources', compact('datas', 'categ', 'sol_count', 'prev_count', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
  }
  //get week request
  public function week()
  {
    $datas = Resource::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('updated_at', 'DESC')->cursorPaginate(6);
    $req_count = ModelsRequest::count();
    $feed_count = Feedback::count();
    $mysol = ReqSolution::where('user_id', Auth()->id())->count();
    $myques = ModelsRequest::where('user_id', Auth()->id())->count();
    $res  = Resource::count();
    $event = Event::count();
    $offline = Offlinetopic::count();
    $product = Product::count();
    $prop   = Proposal::count();
    $categ = Resource::orderBy('created_at', 'DESC')->inRandomOrder()->limit(15)->get();
    $prev_count = ModelsRequest::whereYear('created_at', date('Y', strtotime('-1 year')))->count();
    $sol_count = ReqSolution::orderBy('created_at', 'DESC')->count();
    return view('resources', compact('datas', 'categ', 'sol_count', 'prev_count', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
  }

  //insert data into database
  public function store(Request $request)
  {
    $request->validate([
      'name'         => ['required', 'string'],
      'description'  => ['required', 'string'],
      'price'        => ['required'],
      'category'     => ['required', 'string'],
    ]);

    if ($request->hasFile('file')) {
      $request->validate([
        'file'         => ['required', 'mimes:jpg,jpeg,svg,pdf,png,zip,rar'],
      ]);
      $filename = time() . '_' . $request->file->getClientOriginalName();
      $imgPath = $request->file('file')->storeAs('ReqFile', $filename, 'public');
      Resource::create(array_merge($request->only('name', 'price', 'category', 'description'), [
        'user_id'    => auth()->id(),
        'file_path'  => '/storage/' . $imgPath,
        'file_name'  => $filename,
      ]));
    } else {
      Resource::create(array_merge($request->only('name', 'price', 'category', 'description'), [
        'user_id'    => auth()->id(),
        'file_path'  => '',
        'file_name'  => '',
      ]));
    }

    return  back()->with('status', 'Your Resource Published Successfully:)');
  }
  //show single resource
  public function showresource($id)
  {
    $item = [];
    $item["data"] = Resource::find($id);
    $item["isPaid"] = PaymentLog::where('request_id', $id)->where('pay_by', auth()->id())->where('pay_for', 'resources')->first();
    //increase view count
    $res_key = 'res_' . $id;
    if (!Session::has($res_key)) {
      $item["data"]->increment('view_count');
      Session::put($res_key, 1);
    }
    return view('resources_single', $item);
  }
  public function search(Request $request)
  {

    $request->validate([
      'search'  => ['required', 'string']
    ]);
    $search = $request->search;
    $datas = Resource::query()
      ->where('name', 'LIKE', "%{$search}%")
      ->cursorPaginate(6);

    $req_count = ModelsRequest::count();
    $feed_count = Feedback::count();
    $mysol = ReqSolution::where('user_id', Auth()->id())->count();
    $myques = ModelsRequest::where('user_id', Auth()->id())->count();
    $res  = Resource::count();
    $event = Event::count();
    $offline = Offlinetopic::count();
    $product = Product::count();
    $prop   = Proposal::count();
    $categ = Resource::orderBy('created_at', 'DESC')->inRandomOrder()->limit(15)->get();
    $prev_count = ModelsRequest::whereYear('created_at', date('Y', strtotime('-1 year')))->count();
    $sol_count = ReqSolution::orderBy('created_at', 'DESC')->count();
    return view('resources', compact('datas', 'categ', 'sol_count', 'prev_count', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
  }
  //search cat
  public function searchcategory($name)
  {
    $search = $name;
    $datas = Resource::query()
      ->Where('category', 'LIKE', "%{$search}%")
      ->cursorPaginate(6);
    $bid = Reqbid::all();
    $categ = Resource::orderBy('created_at', 'DESC')->inRandomOrder()->limit(15)->get();
    $req_count = ModelsRequest::count();
    $feed_count = Feedback::count();
    $mysol = ReqSolution::where('user_id', Auth()->id())->count();
    $myques = ModelsRequest::where('user_id', Auth()->id())->count();
    $res  = Resource::count();
    $event = Event::count();
    $offline = Offlinetopic::count();
    $product = Product::count();
    $prop   = Proposal::count();
    $prev_count = ModelsRequest::whereYear('created_at', date('Y', strtotime('-1 year')))->count();
    $sol_count = ReqSolution::orderBy('created_at', 'DESC')->count();
    return view('resources', compact('datas', 'sol_count', 'prev_count', 'categ', 'bid', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
  }
}
