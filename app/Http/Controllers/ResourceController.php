<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\Event;
use App\Models\Feedback;
use App\Models\Offlinetopic;
use App\Models\PaymentLog;
use App\Models\Product;
use App\Models\Proposal;
use App\Models\Propsolution;
use App\Models\Reqbid;
use App\Models\ReqSolution;
use App\Models\Request as ModelsRequest;
use App\Models\Resource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ResourceController extends Controller
{
  //get all resources
  public function index()
  {
    $datas = Resource::orderBy('updated_at', 'DESC')->cursorPaginate(6);
    $req_count = ModelsRequest::count();
    $categ = Resource::select('category')->distinct('category')->limit(15)->get();
    $feed_count = Feedback::count();
    $mysol = ReqSolution::where('user_id', Auth()->id())->count();
    $myques = ModelsRequest::where('user_id', Auth()->id())->count();
    $res  = Resource::count();
    $event = Event::count();
    $contest = Contest::count();
    $offline = Offlinetopic::count();
    $product = Product::count();
    $prop   = Proposal::count();
    $prev_count = ModelsRequest::whereYear('created_at', date('Y', strtotime('-1 year')))->count();
    $sol_count = ReqSolution::orderBy('created_at', 'DESC')->count();

    $t_req_count = ModelsRequest::whereDate('created_at', Carbon::today())->count();
    $t_prop_count = Proposal::whereDate('created_at', Carbon::today())->count();
    $t_reqsolution_count = ReqSolution::whereDate('created_at', Carbon::today())->count();
    $t_propsolution_count = Propsolution::whereDate('created_at', Carbon::today())->count();
    return view('resources', compact('datas', 't_req_count', 't_prop_count','contest','t_reqsolution_count', 't_propsolution_count', 'prev_count', 'sol_count', 'categ', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
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
    $contest = Contest::count();
    $offline = Offlinetopic::count();
    $product = Product::count();
    $prop   = Proposal::count();
    $categ = Resource::select('category')->distinct('category')->limit(15)->get();
    $prev_count = ModelsRequest::whereYear('created_at', date('Y', strtotime('-1 year')))->count();
    $sol_count = ReqSolution::orderBy('created_at', 'DESC')->count();

    $t_req_count = ModelsRequest::whereDate('created_at', Carbon::today())->count();
    $t_prop_count = Proposal::whereDate('created_at', Carbon::today())->count();
    $t_reqsolution_count = ReqSolution::whereDate('created_at', Carbon::today())->count();
    $t_propsolution_count = Propsolution::whereDate('created_at', Carbon::today())->count();
    return view('resources', compact('datas', 't_req_count','contest','t_prop_count', 't_reqsolution_count', 't_propsolution_count', 'prev_count', 'sol_count', 'categ', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
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
    $contest = Contest::count();
    $offline = Offlinetopic::count();
    $product = Product::count();
    $prop   = Proposal::count();
    $categ = Resource::select('category')->distinct('category')->limit(15)->get();
    $prev_count = ModelsRequest::whereYear('created_at', date('Y', strtotime('-1 year')))->count();
    $sol_count = ReqSolution::orderBy('created_at', 'DESC')->count();

    $t_req_count = ModelsRequest::whereDate('created_at', Carbon::today())->count();
    $t_prop_count = Proposal::whereDate('created_at', Carbon::today())->count();
    $t_reqsolution_count = ReqSolution::whereDate('created_at', Carbon::today())->count();
    $t_propsolution_count = Propsolution::whereDate('created_at', Carbon::today())->count();
    return view('resources', compact('datas', 't_req_count','contest','t_prop_count', 't_reqsolution_count', 't_propsolution_count', 'prev_count', 'sol_count', 'categ', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
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
    $contest = Contest::count();
    $offline = Offlinetopic::count();
    $product = Product::count();
    $prop   = Proposal::count();
    $categ = Resource::select('category')->distinct('category')->limit(15)->get();
    $prev_count = ModelsRequest::whereYear('created_at', date('Y', strtotime('-1 year')))->count();
    $sol_count = ReqSolution::orderBy('created_at', 'DESC')->count();

    $t_req_count = ModelsRequest::whereDate('created_at', Carbon::today())->count();
    $t_prop_count = Proposal::whereDate('created_at', Carbon::today())->count();
    $t_reqsolution_count = ReqSolution::whereDate('created_at', Carbon::today())->count();
    $t_propsolution_count = Propsolution::whereDate('created_at', Carbon::today())->count();
    return view('resources', compact('datas', 't_req_count','contest','t_prop_count', 't_reqsolution_count', 't_propsolution_count', 'prev_count', 'sol_count', 'categ', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
  }


  //insert data into database
  public function store(Request $request)
  {
    $request->validate([
      'name'         => ['required', 'string'],
      'description'  => ['required', 'string'],
      'price'        => ['required'],
      'category'     => ['required', 'string'],
      'file'         => ['required', 'mimes:jpg,jpeg,svg,pdf,png,zip,rar'],
    ]);

    $filename = time() . '_' . $request->file->getClientOriginalName();
    $imgPath = $request->file('file')->storeAs('ReqFile', $filename, 'public');
    Resource::create(array_merge($request->only('name', 'price', 'category', 'description'), [
      'user_id'    => auth()->id(),
      'file_path'  => '/storage/' . $imgPath,
      'file_name'  => $filename,
    ]));


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
    $contest = Contest::count();
    $offline = Offlinetopic::count();
    $product = Product::count();
    $prop   = Proposal::count();
    $categ = Resource::select('category')->distinct('category')->limit(15)->get();
    $prev_count = ModelsRequest::whereYear('created_at', date('Y', strtotime('-1 year')))->count();
    $sol_count = ReqSolution::orderBy('created_at', 'DESC')->count();

    $t_req_count = ModelsRequest::whereDate('created_at', Carbon::today())->count();
    $t_prop_count = Proposal::whereDate('created_at', Carbon::today())->count();
    $t_reqsolution_count = ReqSolution::whereDate('created_at', Carbon::today())->count();
    $t_propsolution_count = Propsolution::whereDate('created_at', Carbon::today())->count();
    return view('resources', compact('datas', 't_req_count','contest','t_prop_count', 't_reqsolution_count', 't_propsolution_count', 'prev_count', 'sol_count', 'categ', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
  }
  //search cat
  public function searchcategory($name)
  {
    $search = $name;
    $datas = Resource::query()
      ->Where('category', 'LIKE', "%{$search}%")
      ->cursorPaginate(6);
    $bid = Reqbid::all();
    $categ = Resource::select('category')->distinct('category')->limit(15)->get();
    $req_count = ModelsRequest::count();
    $feed_count = Feedback::count();
    $mysol = ReqSolution::where('user_id', Auth()->id())->count();
    $myques = ModelsRequest::where('user_id', Auth()->id())->count();
    $res  = Resource::count();
    $event = Event::count();
    $contest = Contest::count();
    $offline = Offlinetopic::count();
    $product = Product::count();
    $prop   = Proposal::count();
    $prev_count = ModelsRequest::whereYear('created_at', date('Y', strtotime('-1 year')))->count();
    $sol_count = ReqSolution::orderBy('created_at', 'DESC')->count();

    $t_req_count = ModelsRequest::whereDate('created_at', Carbon::today())->count();
    $t_prop_count = Proposal::whereDate('created_at', Carbon::today())->count();
    $t_reqsolution_count = ReqSolution::whereDate('created_at', Carbon::today())->count();
    $t_propsolution_count = Propsolution::whereDate('created_at', Carbon::today())->count();
    return view('resources', compact('datas', 't_req_count','contest','t_prop_count', 't_reqsolution_count', 't_propsolution_count', 'prev_count', 'sol_count', 'categ', 'req_count', 'feed_count', 'mysol', 'myques', 'res', 'event', 'offline', 'product', 'prop'));
  }

  //Live Search
  public function livesearch(Request $request)
  {
      if ($request->ajax()) {
          $output = "";

          $datas = Resource::where('name', 'LIKE', '%' . $request->search . "%")->get();
          if ($datas) {
              foreach ($datas as $data) {
                  $output .= '
                  <div class="full-width mt-4">
                  <div class="recent-items">
                      <div class="posts-list">
                          <div class="feed-shared-author-dt">
                              <div class="author-left userimg ">
                                  <img class="ft-plus-square job-bg-circle  bg-cyan mr-0" src="/storage/' . $data->user->image . '" alt="">
                                  <div style="position: relative;margin-top: -10px;margin-left: 10px;" class="presence-entity__badge '.(Cache::has("user-is-online-".$data->user_id) ? 'badge__online' : 'badge__offline' ).'">
                                      <span class="visually-hidden">
                                          Status is online
                                      </span>
                                  </div>
                                  <!--hover on image-->
                                  <div class="box imagehov shadow" style="width: auto; height:auto;  position: absolute; z-index: 1;">
                                      <div class="full-width">
                                          <div class="recent-items">
                                              <div class="posts-list">
                                                  <div class="feed-shared-author-dt">
                                                      <div class="author-left">
                                                          <img class="ft-plus-square job-bg-circle bg-cyan" src="/storage/' . $data->user->image . '" alt="">
                                                          <div class="'.(Cache::has("user-is-online-".$data->user->id) ? 'status-oncircle' : 'status-ofcircle' ).'">

                                                          </div>
                                                      </div>

                                                      <div class="author-dts">
                                                          <p class="notification-text font-username">
                                                              <a href="/profile_dashboard/' . $data->user_id . '" style="color:' . $data->user->role->color->name . '">' . $data->user->username . '
                                                              </a><img src="' . $data->user->badge->image . '" alt="" style="width: 20px;" title="' . $data->user->badge->name . '">
                                                              <span class="job-loca"><i class="fas fa-location-arrow"></i>' . $data->user->uni_name . '</span>
                                                          </p>

                                                          <p class="notification-text font-small-4 pt-1">
                                                              <span class="time-dt">Joined on ' . $data->user->created_at->format("d:M:y g:i A") . '</span>
                                                          </p>
                                                          <p class="notification-text font-small-4 pt-1">
                                                          <span class="time-dt">Last Seen '.(Cache::has("user-is-online-".$data->user->id) ? '<span class="text-success">Online</span>' : Carbon::parse($data->user->last_seen)->diffForHumans() ).' </span>
                                                          </p>
                                                          <p class="notification-text font-small-4 pt-1">
                                                              <span class="time-dt">Total Solutions ' . $data->user->solutions . '</span>
                                                          </p>
                                                          <p class="notification-text font-small-4 pt-1">
                                                              <span class="time-dt">Rating ' . $data->user->rating . '</span>
                                                          </p>
                                                          <p class="notification-text font-small-4 pt-1">
                                                              <span class="time-dt">' . $data->user->badge->name . '</span>
                                                          </p>
                                                      </div>

                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- end hover-->
                              </div>
                              <div class="iconreq">
                                  <img class="ft-plus-square job-bg-circle bg-cyan mr-0" src="' . $data->user->badge->image . '" style="width:20px; height:20px" title="' . $data->user->badge->name . '">
                              </div>
                              <div class="author-dts">
                                  <a href="/resource_single/' . $data->id . '" class="problems_title">' . $data->name . '</a>
                                  <p class="notification-text font-username">
                                  </p><div class="userimg">
                                      <a href="/profile_dashboard/' . $data->user_id . '" class="" style="color: ' . $data->user->role->color->name . '">' . $data->user->username . '
                                          &nbsp;
                                      </a>
                                      <!--hover on image-->
                                      <div class="box imagehov shadow" style="width: auto; height:auto;  position: absolute; z-index: 1;">
                                      <div class="full-width">
                                          <div class="recent-items">
                                              <div class="posts-list">
                                                  <div class="feed-shared-author-dt">
                                                      <div class="author-left">
                                                          <img class="ft-plus-square job-bg-circle bg-cyan" src="/storage/' . $data->user->image . '" alt="">
                                                          <div class="'.(Cache::has("user-is-online-".$data->user->id) ? 'status-oncircle' : 'status-ofcircle' ).'">
                                                          </div>
                                                      </div>

                                                      <div class="author-dts">
                                                          <p class="notification-text font-username">
                                                              <a href="/profile_dashboard/' . $data->user_id . '" style="color:' . $data->user->role->color->name . '">' . $data->user->username . '
                                                              </a><img src="' . $data->user->badge->image . '" alt="" style="width: 20px;" title="' . $data->user->badge->name . '">
                                                              <span class="job-loca"><i class="fas fa-location-arrow"></i>' . $data->user->uni_name . '</span>
                                                          </p>

                                                          <p class="notification-text font-small-4 pt-1">
                                                              <span class="time-dt">Joined on ' . $data->user->created_at->format("d:M:y g:i A") . '</span>
                                                          </p>
                                                          <p class="notification-text font-small-4 pt-1">
                                                              <span class="time-dt">Last Seen '.(Cache::has("user-is-online-".$data->user->id) ? '<span class="text-success">Online</span>' : Carbon::parse($data->user->last_seen)->diffForHumans() ).' </span>
                                                          </p>
                                                          <p class="notification-text font-small-4 pt-1">
                                                              <span class="time-dt">Total Solutions ' . $data->user->solutions . '</span>
                                                          </p>
                                                          <p class="notification-text font-small-4 pt-1">
                                                              <span class="time-dt">Rating ' . $data->user->rating . '</span>
                                                          </p>
                                                          <p class="notification-text font-small-4 pt-1">
                                                              <span class="time-dt">' . $data->user->badge->name . '</span>
                                                          </p>
                                                      </div>

                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                      <!-- end hover-->
                                  </div>
                                  <img src="'.($data->user->badge_id == 5 || $data->user->status == 1 ? "/storage/badges/verified.svg" : "" ).'" class=" '.($data->user->badge_id == 5 || $data->user->status == 1 ? " " : "d-none" ).'" alt="Verified" style="width: 17px;" title="Verified">
                                  <span class="job-loca"><i class="fas fa-location-arrow"></i>'.$data->user->uni_name.'</span>
                                  <p></p>
                                  <span>'.$data->description.'</span>
                                  <p class="notification-text font-small-4 pt-1">
                                      <span class="time-dt">'.$data->created_at->diffForHumans().'</span>
                                  </p>
                              </div>
                              <div class="ellipsis-options post-ellipsis-options dropdown dropdown-account">
                              <span class="job-badge ddcolor">৳ '.$data->price.' </span>
                                  <a href="" class="label-dker post_categories_top_right mr-20 ms-2"><span>'.$data->category.'</span></a>

                                  </div>
                          </div>
                      </div>
                      <div class="post-meta">
                          <div class="job-actions">
                              <div class="aplcnts_15">
                                  <i class="feather-eye mr-2"></i><span>Views</span><ins>'.$data->view_count.'
                                  </ins>
                              </div>
                              <div class="action-btns-job d-flex justify-content-space">
                                  <a href="/resource_single/'.$data->id.'" class="view-btn btn-hover">Detail</a>
                              </div>

                          </div>
                      </div>
                  </div>
              </div>';
              }

              return Response($output);
          }
      }
  }

}
