<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookorder;
class BookorderController extends Controller
{

    public function index(){
        $data = Bookorder::where('user_id', Auth()->id())->orderBy('updated_at','DESC')->get();
        return view('bookcart',compact('data'));
    }
    public function store($bid){
        Bookorder::create([
            'user_id'    => Auth()->id(),
            'book_id'    => $bid,
            'status'     => '0',
        ]);
        return back()->with('success', 'Book has added to cart Successfully');
    }

    public function sell(){
        dd("hello");
    }
}
