<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Privacy;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function index()
    {
        $datas = Privacy::all();
        return view('admin.privacy',compact('datas'));
    }
    public function show()
    {
        return view('admin.addprivacy');
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
       $fileUpload = Privacy::where('id', 1)->first();
       $fileUpload->description = $content;
       $fileUpload->save();
       flash()->addSuccess('Privacy Page Content Added Successsfully');
       return redirect(route('admin.privacy'));
    }
    public function getupdate($id)
    {
        $data = Privacy::find($id);
        return view('admin.addprivacy',compact('data'));
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
       $fileUpload = Privacy::find($id);
       $fileUpload->description = $content;
       $fileUpload->save();
       return back()->with('success', 'Privacy Updated Sussessfully');
    }
}
