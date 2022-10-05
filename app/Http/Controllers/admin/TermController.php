<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Terms;
use Illuminate\Http\Request;

class TermController extends Controller
{
    public function index()
    {
        $datas = Terms::all();
        return view('admin.term',compact('datas'));
    }
    public function show()
    {
        return view('admin.addterm');
    }
    public function get(Request $request)
    {
        $this->validate($request, [
            
            'description' => 'required'
       ]);
       $content = $request->description;
       $dom = new \DomDocument();
       $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
       $imageFile = $dom->getElementsByTagName('imageFile');
 
       foreach($imageFile as $item => $image){
           $data = $image->getAttribute('src');
           list($type, $data) = explode(';', $data);
           list(, $data)      = explode(',', $data);
           $imgeData = base64_decode($data);
           $image_name= "/upload/" . time().$item.'.png';
           $path = '/storage'. $image_name;
           file_put_contents($path, $imgeData);
           
           $image->removeAttribute('src');
           $image->setAttribute('src', $image_name);
        }
 
       $content = $dom->saveHTML();
       $fileUpload = Terms::where('id',1)->first();
       $fileUpload->description = $content;
       $fileUpload->save();
       flash()->addSuccess('Terms Page Content Added Successsfully');
       return redirect(route('admin.term'));
    }
    public function getupdate($id)
    {
        $data = Terms::find($id);
        return view('admin.addterm',compact('data'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            
            'description' => 'required'
       ]);
       $content = $request->description;
       $dom = new \DomDocument();
       $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
       $imageFile = $dom->getElementsByTagName('imageFile');
 
       foreach($imageFile as $item => $image){
           $data = $image->getAttribute('src');
           list($type, $data) = explode(';', $data);
           list(, $data)      = explode(',', $data);
           $imgeData = base64_decode($data);
           $image_name= "/upload/" . time().$item.'.png';
           $path = '/storage'. $image_name;
           file_put_contents($path, $imgeData);
           
           $image->removeAttribute('src');
           $image->setAttribute('src', $image_name);
        }
 
       $content = $dom->saveHTML();
       $fileUpload = Terms::find($id);
       $fileUpload->description = $content;
       $fileUpload->save();
       return back()->with('success', 'Terms Updated Sussessfully');
    }
}
