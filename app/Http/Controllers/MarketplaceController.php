<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Product;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('created_at','DESC')->get();
        $products = Product::orderBy('created_at','DESC')->get();
        return view('products',compact('books','products'));
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
           return view('products',compact('books','products'));
        }
}
