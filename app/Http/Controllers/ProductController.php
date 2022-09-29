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
}
