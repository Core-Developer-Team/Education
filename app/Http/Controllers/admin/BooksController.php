<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Book::all();
        return view('admin.book',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.addbook');    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $data= Book::find($id);
       return view('admin.addbook',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'cover_pic'    => 'required|image|mimes:jpg,jpeg,png,svg',
            'book'         => 'required|mimes:csv,txt,xlx,xls,pdf,docx,ppt,pptx|max:30000',
            'description'  => 'required|string',
            'price'        => 'required',
        ]);
        $filename = time().'_'.$request->book->getClientOriginalName();
        $filepath = $request->file('book')->storeAs('uploads',$filename, 'public');
        $bookname=$request->book->getClientOriginalName();
        // store cover image path
        $imagename = time().'_'.$request->cover_pic->getClientOriginalName();
        $imagepath = $request->file('cover_pic')->storeAs('Images',$imagename, 'public');

        Book::find($id)->update(array_merge($request->only('description','price'),[
            'book'      => '/storage/'.$filepath,
            'cover_pic' => '/storage/'.$imagepath,
            'book_name' => $bookname,
        ]));
        return back()->with('success', 'Book has been Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=Book::find($id);
       $file_path = public_path().$data->cover_pic;
       $file_sec =  public_path().$data->book;
       if(File::exists($file_path))
       {
        File::delete($file_path , $file_sec);
       }
       $data->delete();
       return back()->with('success', 'Course has deleted Successfully');
    }
}
