<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class CourseController extends Controller
{
       //get all course
       protected function index()
       {
        $parts = 'snippet';
        $apikey = config('services.youtube.api_key');
        $maxResults = 40;
        $youtubeEndPoint = config('services.youtube.playlist_endpoint');

        $playlist = Course::select('playlists_id','user_id','id','price','type','view_count','file','Category')->orderBy('created_at','ASC')->get();
        $playlists_json=[];
          foreach($playlist as $playlists)
          {
           $playlist_id = $playlists->playlists_id;
           $playid      = $playlists->id;
           $price       = $playlists->price;
           $type        = $playlists->type;
           $cat         = $playlists->Category;
           $view_count  = $playlists->view_count;
           $url=$youtubeEndPoint."playlistItems?part=".$parts."&maxResults=".$maxResults."&playlistId=".$playlist_id."&key=".$apikey;
           $response = Http::get($url);
           $playlist_data = (array)json_decode($response->body());
           $playlists_json[]= ['playlists'=>$playlist_data, 'id'=>$playid,'price'=>$price,'type'=>$type , 'category'=>$cat ,'view_count'=>$view_count];
          }
          return view('course',compact('playlists_json','playlist'));
          
        }
        
        public function freecourse($id)
        {
         
            $parts = 'snippet';
            $apikey = config('services.youtube.api_key');
            $maxResults = 40;
            $youtubeEndPoint = config('services.youtube.playlist_endpoint');
            if($id==0)
            {
            $playlist = Course::where('type',$id)->get();
           
            }
            elseif($id==1)
            {
              $playlist = Course::where('type',$id)->get();
            
            }
            $playlists_json=[];
              foreach($playlist as $playlists)
              {
               $playlist_id = $playlists->playlists_id;
               $playid      = $playlists->id;
               $price       = $playlists->price;
               $type        = $playlists->type;
               $cat         = $playlists->Category;
               $view_count  = $playlists->view_count;
               $url=$youtubeEndPoint."playlistItems?part=".$parts."&maxResults=".$maxResults."&playlistId=".$playlist_id."&key=".$apikey;
               $response = Http::get($url);
               $playlist_data = (array)json_decode($response->body());
               $playlists_json[]= ['playlists'=>$playlist_data, 'id'=>$playid,'price'=>$price,'type'=>$type , 'category'=>$cat ,'view_count'=>$view_count];
              }
              return view('coursetype',compact('playlists_json','playlist'));
        
        }

           //show single course
           public function showcourse($id)
           {
             $parts = 'snippet';
             $apikey = config('services.youtube.api_key');
             $maxResults = 40;
             $youtubeEndPoint = config('services.youtube.playlist_endpoint');
   
             $playlist = Course::Find($id);
              $pla_id = $playlist->playlists_id;
              $url=$youtubeEndPoint."playlistItems?part=".$parts."&maxResults=".$maxResults."&playlistId=".$pla_id."&key=".$apikey;
              $response = Http::get($url);
              $playlist_data = (array)json_decode($response->body());
              $course_key= 'course_'.$id;
              if(!Session::has($course_key)){
                $playlist->increment('view_count');
                Session::put($course_key, 1);
              }
             return view('course_single',compact('playlist_data','playlist'));    
          
           }

     
        //store course data
        public function get(Request $request)
        {
            $request->validate([
              'playlists_id'  => ['required'],
              'Category'      => ['required','max:11'],
              'file'          =>  ['required','mimes:csv,txt,xlx,xls,pdf,docx,ppt,pptx','max:30000'],
              'price'         => ['required'],
              'type'          => ['required'],
            ]);
            $filename = time().'_'.$request->file->getClientOriginalName();
            $filepath = $request->file('file')->storeAs('uploads',$filename, 'public');
            Course::create(array_merge($request->only('price','playlists_id','type','Category'),[
                'user_id'   => auth()->id(),
                'file'      => '/storage/'.$filepath,
            ]));
            return back()->with('success', 'Course has been uploaded Successfully');
        }
   
   
          //search 
          public function search(Request $request)
          {
             $request->validate([
                 'search'  => ['required','string']
             ]);
             $search = $request->search;
             $parts = 'snippet';
             $apikey = config('services.youtube.api_key');
             $maxResults = 12;
             $youtubeEndPoint = config('services.youtube.playlist_endpoint');
     
             $playlist = Course::where('Category', 'LIKE', "%{$search}%")->orderBy('created_at','ASC')->get();
            
               $playlists_json=[];
               foreach($playlist as $playlists)
               {
                $playlist_id = $playlists->playlists_id;
                $playid      = $playlists->id;
                $price       = $playlists->price;
                $type        = $playlists->type;
                $cat         = $playlists->Category;
                $view_count  = $playlists->view_count;
                $url=$youtubeEndPoint."playlistItems?part=".$parts."&maxResults=".$maxResults."&playlistId=".$playlist_id."&key=".$apikey;
                $response = Http::get($url);
                $playlist_data = (array)json_decode($response->body());
                $playlists_json[]= ['playlists'=>$playlist_data, 'id'=>$playid,'type'=>$type ,'price'=>$price , 'category'=>$cat ,'view_count'=>$view_count];
               }
               return view('course',compact('playlists_json','playlist'));
          }
}
