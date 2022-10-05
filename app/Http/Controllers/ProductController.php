<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Productreview;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{

    public function index()
    {
        $data = Product::orderBy('updated_at', 'DESC')->cursorPaginate(15);
        return view('marketplace', compact('data'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'cover_pic'    => 'required|image|mimes:jpg,jpeg,png,svg',
            'name'         => 'required|max:25',
            'Category'      => ['required', 'max:25'],
            'description'  => 'required|string',
            'price'        => 'required',
        ]);
        // store cover image path
        $imagename = time() . '_' . $request->cover_pic->getClientOriginalName();
        $imagepath = $request->file('cover_pic')->storeAs('Images', $imagename, 'public');

        Product::create(array_merge($request->only('description', 'Category', 'name', 'price'), [
            'user_id'   => auth()->id(),
            'cover_pic' => '/storage/' . $imagepath,
        ]));
        return back()->with('success', 'Product has been Added Successfully');
    }

    //search
    public function search(Request $request)
    {
        $request->validate([
            'search'  => ['required', 'string']
        ]);
        $search = $request->search;
        $data = Product::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->cursorPaginate(6);
        return view('marketplace', compact('data'));
    }

    //get latest request
    public function latest()
    {
        $data = Product::whereDate('created_at', Carbon::today())->orderBy('updated_at', 'DESC')->cursorPaginate(15);
        return view('marketplace', compact('data'));
    }

    //get latest request
    public function trending()
    {
        $data = Product::where('view_count', '>=', 20)->orderBy('updated_at', 'DESC')->cursorPaginate(15);
        return view('marketplace', compact('data'));
    }

    //get week request
    public function week()
    {
        $data = Product::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('updated_at', 'DESC')->cursorPaginate(15);
        return view('marketplace', compact('data'));
    }

    //get single product

    public function showproduct($id)
    {
        $data = Product::find($id);
        $reviews = Productreview::where('product_id', $id)->orderBy('created_at', 'DESC')->cursorPaginate(4);
        //increase view count
        $product_key = 'product_' . $id;
        if (!Session::has($product_key)) {
            $data->increment('view_count');
            Session::put($product_key, 1);
        }

        return view('product_single', compact('data', 'reviews'));
    }
    //live search

    public function livesearch(Request $request)
    {
        if ($request->ajax()) {
            $output = "";

            $datas = Product::where('name', 'LIKE', '%' . $request->search . "%")->get();
            if ($datas) {
                foreach ($datas as $data) {
                    $output .= '
                     <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                     <div class="full-width mt-4">
                         <div class="recent-items">
                             <div class="posts-list">
                                 <div class="feed-shared-product-dt">
                                     <div class="pdct-img">
                                         <a><img class="ft-plus-square product-bg-w bg-cyan me-0" src="' . $data->cover_pic . '" alt="">
                                             <div class="overlay-item">
                                                 <div class="badge-timer">
                                                    ' . $data->created_at->diffForHumans() . '
                                                 </div>
                                             </div>
                                         </a>
                                     </div>
                                     <div class="author-dts pp-20">
                                         <a class="job-heading pp-title">' . $data->name . '</a>
                                         <p class="notification-text font-small-4">
                                             by <a href="/profile_dashboard/' . $data->id . '" class="cmpny-dt blk-clr" style="color:' . $data->user->role->color->name . '">' . $data->user->username . '</a>
                                         </p>
                                         <div class="ppdt-price-sales">
                                             <div class="ppdt-price">
                                                 ৳ ' . $data->price . '
                                             </div>
                                             <div class="ppdt-sales">
                                                 0 Sales
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="post-meta">
                                 <div class="job-actions">
                                     <div class="aplcnts_15">
                                         <a href="/product_single/' . $data->id . '" class="view-btn btn-hover">Detail
                                             View</a>
                                     </div>
                                     <div class="action-btns-job">
                                         <i class="fas fa-eye"></i> ' . $data->view_count . '
                                     </div>
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
