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

    $playlist = Course::select('playlists_id', 'user_id', 'id', 'price', 'type', 'view_count', 'file', 'Category')->orderBy('created_at', 'ASC')->get();
    $playlists_json = [];
    foreach ($playlist as $playlists) {
      $playlist_id = $playlists->playlists_id;
      $playid      = $playlists->id;
      $price       = $playlists->price;
      $type        = $playlists->type;
      $cat         = $playlists->Category;
      $view_count  = $playlists->view_count;
      $url = $youtubeEndPoint . "playlistItems?part=" . $parts . "&maxResults=" . $maxResults . "&playlistId=" . $playlist_id . "&key=" . $apikey;
      $response = Http::get($url);
      $playlist_data = (array)json_decode($response->body());
      $playlists_json[] = ['playlists' => $playlist_data, 'id' => $playid, 'price' => $price, 'type' => $type, 'category' => $cat, 'view_count' => $view_count];
    }
    return view('course', compact('playlists_json', 'playlist'));
  }

  public function latest()
  {
    $parts = 'snippet';
    $apikey = config('services.youtube.api_key');
    $maxResults = 40;
    $youtubeEndPoint = config('services.youtube.playlist_endpoint');

    $playlist = Course::whereDate('created_at', Carbon::today())->orderBy('updated_at', 'DESC')->get();
    $playlists_json = [];
    foreach ($playlist as $playlists) {
      $playlist_id = $playlists->playlists_id;
      $playid      = $playlists->id;
      $price       = $playlists->price;
      $type        = $playlists->type;
      $cat         = $playlists->Category;
      $view_count  = $playlists->view_count;
      $url = $youtubeEndPoint . "playlistItems?part=" . $parts . "&maxResults=" . $maxResults . "&playlistId=" . $playlist_id . "&key=" . $apikey;
      $response = Http::get($url);
      $playlist_data = (array)json_decode($response->body());
      $playlists_json[] = ['playlists' => $playlist_data, 'id' => $playid, 'price' => $price, 'type' => $type, 'category' => $cat, 'view_count' => $view_count];
    }
    return view('course', compact('playlists_json', 'playlist'));
  }
  public function week()
  {
    $parts = 'snippet';
    $apikey = config('services.youtube.api_key');
    $maxResults = 40;
    $youtubeEndPoint = config('services.youtube.playlist_endpoint');

    $playlist = Course::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
    $playlists_json = [];
    foreach ($playlist as $playlists) {
      $playlist_id = $playlists->playlists_id;
      $playid      = $playlists->id;
      $price       = $playlists->price;
      $type        = $playlists->type;
      $cat         = $playlists->Category;
      $view_count  = $playlists->view_count;
      $url = $youtubeEndPoint . "playlistItems?part=" . $parts . "&maxResults=" . $maxResults . "&playlistId=" . $playlist_id . "&key=" . $apikey;
      $response = Http::get($url);
      $playlist_data = (array)json_decode($response->body());
      $playlists_json[] = ['playlists' => $playlist_data, 'id' => $playid, 'price' => $price, 'type' => $type, 'category' => $cat, 'view_count' => $view_count];
    }
    return view('course', compact('playlists_json', 'playlist'));
  }

  public function freecourse($id)
  {

    $parts = 'snippet';
    $apikey = config('services.youtube.api_key');
    $maxResults = 40;
    $youtubeEndPoint = config('services.youtube.playlist_endpoint');
    if ($id == 0) {
      $playlist = Course::where('type', $id)->get();
    } elseif ($id == 1) {
      $playlist = Course::where('type', $id)->get();
    }
    $playlists_json = [];
    foreach ($playlist as $playlists) {
      $playlist_id = $playlists->playlists_id;
      $playid      = $playlists->id;
      $price       = $playlists->price;
      $type        = $playlists->type;
      $cat         = $playlists->Category;
      $view_count  = $playlists->view_count;
      $url = $youtubeEndPoint . "playlistItems?part=" . $parts . "&maxResults=" . $maxResults . "&playlistId=" . $playlist_id . "&key=" . $apikey;
      $response = Http::get($url);
      $playlist_data = (array)json_decode($response->body());
      $playlists_json[] = ['playlists' => $playlist_data, 'id' => $playid, 'price' => $price, 'type' => $type, 'category' => $cat, 'view_count' => $view_count];
    }
    return view('coursetype', compact('playlists_json', 'playlist'));
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
    $url = $youtubeEndPoint . "playlistItems?part=" . $parts . "&maxResults=" . $maxResults . "&playlistId=" . $pla_id . "&key=" . $apikey;
    $response = Http::get($url);
    $playlist_data = (array)json_decode($response->body());
    $course_key = 'course_' . $id;
    if (!Session::has($course_key)) {
      $playlist->increment('view_count');
      Session::put($course_key, 1);
    }
    return view('course_single', compact('playlist_data', 'playlist'));
  }


  //store course data
  public function get(Request $request)
  {
    $request->validate([
      'playlists_id'  => [
        'required',
        'url',
        function ($attribute, $requesturl, $failed) {
          if (!preg_match('/(youtube.com|youtu.be)\/(embed)?(\?v=)?(\S+)?/', $requesturl)) {
            $failed(trans("general.not_youtube_url", ["name" => trans("general.url")]));
          }
        },
      ],
      'Category'      => ['required', 'max:25'],
      'price'         => ['required'],
      'type'          => ['required'],
    ]);

    if ($request->hasFile('file')) {
      $request->validate([
        'file'         => ['required', 'mimes:jpg,jpeg,svg,pdf,png,zip,rar'],
      ]);
      $url = $request->playlists_id;
      parse_str(parse_url($url, PHP_URL_QUERY), $my_array);
      $filename = time() . '_' . $request->file->getClientOriginalName();
      $filepath = $request->file('file')->storeAs('uploads', $filename, 'public');
      Course::create(array_merge($request->only('price', 'type', 'Category'), [
        'user_id'      => auth()->id(),
        'playlists_id' => $my_array['list'],
        'file'         => '/storage/' . $filepath,
      ]));
    } else {
      $url = $request->playlists_id;
      parse_str(parse_url($url, PHP_URL_QUERY), $my_array);
      Course::create(array_merge($request->only('price', 'type', 'Category'), [
        'user_id'      => auth()->id(),
        'playlists_id' => $my_array['list'],
        'file'         => '',
      ]));
    }
    return back()->with('success', 'Course has been uploaded Successfully');
  }


  //search 
  public function search(Request $request)
  {
    $request->validate([
      'search'  => ['required', 'string']
    ]);
    $search = $request->search;
    $parts = 'snippet';
    $apikey = config('services.youtube.api_key');
    $maxResults = 12;
    $youtubeEndPoint = config('services.youtube.playlist_endpoint');

    $playlist = Course::where('Category', 'LIKE', "%{$search}%")->orderBy('created_at', 'ASC')->get();

    $playlists_json = [];
    foreach ($playlist as $playlists) {
      $playlist_id = $playlists->playlists_id;
      $playid      = $playlists->id;
      $price       = $playlists->price;
      $type        = $playlists->type;
      $cat         = $playlists->Category;
      $view_count  = $playlists->view_count;
      $url = $youtubeEndPoint . "playlistItems?part=" . $parts . "&maxResults=" . $maxResults . "&playlistId=" . $playlist_id . "&key=" . $apikey;
      $response = Http::get($url);
      $playlist_data = (array)json_decode($response->body());
      $playlists_json[] = ['playlists' => $playlist_data, 'id' => $playid, 'type' => $type, 'price' => $price, 'category' => $cat, 'view_count' => $view_count];
    }
    return view('course', compact('playlists_json', 'playlist'));
  }
}
