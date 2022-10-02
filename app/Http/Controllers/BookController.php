<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Book;
use App\Models\Bookreview;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Spatie\FlareClient\View;

class BookController extends Controller
{
    //All Books
    public function index()
    {
        $data = Book::orderBy('updated_at', 'DESC')->cursorPaginate(15);
        return view('books', compact('data'));
    }

    //get latest request
    public function latest()
    {
        $data = Book::whereDate('created_at', Carbon::today())->orderBy('updated_at', 'DESC')->cursorPaginate(15);
        return view('books', compact('data'));
    }

    //get latest request
    public function trending()
    {
        $data = Book::where('view_count', '>=', 20)->orderBy('updated_at', 'DESC')->cursorPaginate(15);
        return view('books', compact('data'));
    }

    //get week request
    public function week()
    {
        $data = Book::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('updated_at', 'DESC')->cursorPaginate(15);
        return view('books', compact('data'));
    }
    //store books data
    public function store(Request $request)
    {
        $request->validate([
            'cover_pic'    => 'required|image|mimes:jpg,jpeg,png,svg',
            'Category'     => 'required|max:25',
            'description'  => 'required|string',
            'price'        => 'required',
            'title'        => 'required',
        ]);

        // store cover image path
        $imagename = time() . '_' . $request->cover_pic->getClientOriginalName();
        $imagepath = $request->file('cover_pic')->storeAs('Images', $imagename, 'public');

        Book::create(array_merge($request->only('price','title', 'description', 'Category'), [
            'user_id'   => auth()->id(),
            'cover_pic' => '/storage/' . $imagepath,
        ]));
        return back()->with('success', 'Book has been uploaded Successfully');
    }
    //get single book
    public function showbook($id)
    {
        $data = Book::find($id);
        $reviews = Bookreview::where('book_id', $id)->orderBy('created_at', 'DESC')->cursorPaginate(4);
        //increase view count
        $book_key = 'book_' . $id;
        if (!Session::has($book_key)) {
            $data->increment('view_count');
            Session::put($book_key, 1);
        }
        return view('books_single', compact('data', 'reviews'));
    }
    //search 
    public function search(Request $request)
    {
        $request->validate([
            'search'  => ['required', 'string']
        ]);
        $search = $request->search;
        $data = Book::query()
            ->where('book_name', 'LIKE', "%{$search}%")
            ->cursorPaginate(6);
        return view('books', compact('data'));
    }
   //live search
    public function livesearch(Request $request)
    {
        if ($request->ajax()) {
            $output = "";

            $datas = Book::where('title', 'LIKE', '%' . $request->search . "%")->get();
            if ($datas) {
                foreach ($datas as $data) {
                    $output .= ' 
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                    <div class="full-width mt-4">
                        <div class="recent-items">
                            <div class="posts-list">
                                <div class="feed-shared-product-dt">
                                    <div class="pdct-img">
                                        <a><img class="ft-plus-square product-bg-w bg-cyan me-0" src="'.$data->cover_pic.'" alt="">
                                            <div class="overlay-item">
                                                <div class="badge-timer">
                                                   '.$data->created_at->diffForHumans().'
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="author-dts pp-20">
                                        <a class="job-heading pp-title">'.$data->title.'</a>
                                        <p class="notification-text font-small-4">
                                            by <a href="/profile_dashboard/'.$data->id.'" class="cmpny-dt blk-clr" style="color:'.$data->user->role->color->name.'">'.$data->user->username.'</a>
                                        </p>
                                        <div class="ppdt-price-sales">
                                            <div class="ppdt-price">
                                                ৳ '.$data->price.'
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
                                        <a href="/books_single/'.$data->id.'" class="view-btn btn-hover">Detail
                                            View</a>
                                    </div>
                                    <div class="action-btns-job">
                                        <i class="fas fa-eye"></i> '.$data->view_count.'
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
