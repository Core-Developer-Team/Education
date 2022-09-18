<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminProductController extends Controller
{
    public function index()
    {
        $data = Product::all();
        return view('admin.product',compact('data'));
    }
    public function del(Request $request)
    { 
        $data=Product::find($request->product_id);
       $file_path = public_path().$data->cover_pic;
       if(File::exists($file_path))
       {
        File::delete($file_path);
       }
       $data->delete();
       return back()->with('success', 'Product has deleted Successfully');
    }
}
