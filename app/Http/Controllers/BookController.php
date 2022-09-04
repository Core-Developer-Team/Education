<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Book;
use App\Models\Bookreview;
use Carbon\Carbon;
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
            'book'         => 'required|mimes:csv,txt,xlx,xls,pdf,docx,ppt,pptx,zip,rar|max:30000',
            'description'  => 'required|string',
            'price'        => 'required',
        ]);

        $filename = time() . '_' . $request->book->getClientOriginalName();
        $filepath = $request->file('book')->storeAs('uploads', $filename, 'public');
        $bookname = $request->book->getClientOriginalName();
        // store cover image path
        $imagename = time() . '_' . $request->cover_pic->getClientOriginalName();
        $imagepath = $request->file('cover_pic')->storeAs('Images', $imagename, 'public');

        Book::create(array_merge($request->only('price', 'description', 'Category'), [
            'user_id'   => auth()->id(),
            'book'      => '/storage/' . $filepath,
            'cover_pic' => '/storage/' . $imagepath,
            'book_name' => $bookname,
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
}
