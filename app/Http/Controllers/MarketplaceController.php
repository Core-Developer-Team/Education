<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Product;
use App\Models\Proposal;
use App\Models\Propsolution;
use App\Models\ReqSolution;
use App\Models\Request as ModelsRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('created_at','DESC')->get();
        $products = Product::orderBy('created_at','DESC')->get();
        $t_req_count = ModelsRequest::whereDate('created_at', Carbon::today())->count();
        $t_prop_count = Proposal::whereDate('created_at', Carbon::today())->count();
        $t_reqsolution_count = ReqSolution::whereDate('created_at', Carbon::today())->count();
        $t_propsolution_count = Propsolution::whereDate('created_at', Carbon::today())->count();
        return view('products',compact('books','products', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count'));
    }

        //search 
        public function search(Request $request)
        {
           $request->validate([
               'search'  => ['required','string']
           ]);
           $search = $request->search;
           $books = Book::query()
           ->where('book_name', 'LIKE', "%{$search}%")
           ->get();
           $products = Product::query()
           ->where('name', 'LIKE', "%{$search}%")
           ->get();

           $t_req_count = ModelsRequest::whereDate('created_at', Carbon::today())->count();
           $t_prop_count = Proposal::whereDate('created_at', Carbon::today())->count();
           $t_reqsolution_count = ReqSolution::whereDate('created_at', Carbon::today())->count();
           $t_propsolution_count = Propsolution::whereDate('created_at', Carbon::today())->count();

           return view('products',compact('books','products', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count'));
        }
}
