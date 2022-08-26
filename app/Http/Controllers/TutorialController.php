<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\playlists;
use App\Models\Playlistsvideos;
use App\Models\Tutorial;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class TutorialController extends Controller
{
  //store tutorial data
  public function get(Request $request)
  {
    $request->validate([
      'playlists_id'  => ['required'],
      'Category'      => ['required', 'max:25'],
      'file'          =>  ['required', 'mimes:csv,txt,xlx,xls,pdf,docx,ppt,pptx', 'max:30000'],
      'price'         => ['required'],
      'type'          => ['required'],
    ]);
    $filename = time() . '_' . $request->file->getClientOriginalName();
    $filepath = $request->file('file')->storeAs('uploads', $filename, 'public');
    Playlist::create(array_merge($request->only('playlists_id', 'type', 'Category', 'price'), [
      'user_id'   => auth()->id(),
      'file'      => '/storage/' . $filepath,
    ]));
    return back()->with('success', 'Tutorial has been uploaded Successfully');
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

    $playlist = Playlist::where('Category', 'LIKE', "%{$search}%")->orderBy('created_at', 'ASC')->get();

    $playlists_json = [];
    foreach ($playlist as $playlists) {
      $playlist_id = $playlists->playlists_id;
      $playid      = $playlists->id;
      $price       = $playlists->price;
      $type        = $playlists->type;
      $cat         = $playlists->Category;
      $view_count  = $playlists->view_count;
      $url = $youtubeEndPoint . "search?part=" . $parts . "&maxResults=" . $maxResults . "&type=video&videoId=&key=" . $apikey . "&q=" . $playlist_id;
      $response = Http::get($url);
      $playlist_data = (array)json_decode($response->body());
      $playlists_json[] = ['playlists' => $playlist_data, 'id' => $playid, 'type' => $type, 'price' => $price, 'view_count' => $view_count, 'category' => $cat];
    }
    return view('tutorial', compact('playlists_json', 'playlist'));
  }

  public function latest()
  {
    $parts = 'snippet';
    $apikey = config('services.youtube.api_key');
    $maxResults = 40;
    $youtubeEndPoint = config('services.youtube.playlist_endpoint');

    $playlist = Playlist::whereDate('created_at', Carbon::today())->orderBy('updated_at', 'DESC')->get();
    $playlists_json = [];
    foreach ($playlist as $playlists) {
      $playlist_id = $playlists->playlists_id;
      $playid      = $playlists->id;
      $price       = $playlists->price;
      $type        = $playlists->type;
      $cat         = $playlists->Category;
      $view_count  = $playlists->view_count;
      $url = $youtubeEndPoint . "search?part=" . $parts . "&maxResults=" . $maxResults . "&type=video&videoId=&key=" . $apikey . "&q=" . $playlist_id;
      $response = Http::get($url);
      $playlist_data = (array)json_decode($response->body());
      $playlists_json[] = ['playlists' => $playlist_data, 'id' => $playid, 'price' => $price, 'type' => $type, 'category' => $cat, 'view_count' => $view_count];
    }
    return view('tutorial', compact('playlists_json', 'playlist'));
  }
  public function week()
  {
    $parts = 'snippet';
    $apikey = config('services.youtube.api_key');
    $maxResults = 40;
    $youtubeEndPoint = config('services.youtube.playlist_endpoint');

    $playlist = Playlist::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
    $playlists_json = [];
    foreach ($playlist as $playlists) {
      $playlist_id = $playlists->playlists_id;
      $playid      = $playlists->id;
      $price       = $playlists->price;
      $type        = $playlists->type;
      $cat         = $playlists->Category;
      $view_count  = $playlists->view_count;
      $url = $youtubeEndPoint . "search?part=" . $parts . "&maxResults=" . $maxResults . "&type=video&videoId=&key=" . $apikey . "&q=" . $playlist_id;
      $response = Http::get($url);
      $playlist_data = (array)json_decode($response->body());
      $playlists_json[] = ['playlists' => $playlist_data, 'id' => $playid, 'price' => $price, 'type' => $type, 'category' => $cat, 'view_count' => $view_count];
    }
    return view('tutorial', compact('playlists_json', 'playlist'));
  }


  //get all videos
  protected function getvideos()
  {
    $parts = 'snippet';
    $apikey = config('services.youtube.api_key');
    $maxResults = 40;
    $youtubeEndPoint = config('services.youtube.playlist_endpoint');

    $playlist = Playlist::select('playlists_id', 'id', 'price', 'type', 'view_count', 'file', 'Category')->orderBy('created_at', 'ASC')->get();

    $playlists_json = [];
    foreach ($playlist as $playlists) {
      $playlist_id = $playlists->playlists_id;
      $playid      = $playlists->id;
      $price       = $playlists->price;
      $cat         = $playlists->Category;
      $type        = $playlists->type;
      $view_count  = $playlists->view_count;
      $url = $youtubeEndPoint . "search?part=" . $parts . "&maxResults=" . $maxResults . "&type=video&videoId=&key=" . $apikey . "&q=" . $playlist_id;
      $response = Http::get($url);
      $playlist_data = (array)json_decode($response->body());
      $playlists_json[] = ['playlists' => $playlist_data, 'id' => $playid, 'type' => $type, 'price' => $price, 'view_count' => $view_count, 'category' => $cat];
    }
    return view('tutorial', compact('playlists_json', 'playlist'));
  }

  public function freetutorial($id)
  {

    $parts = 'snippet';
    $apikey = config('services.youtube.api_key');
    $maxResults = 40;
    $youtubeEndPoint = config('services.youtube.playlist_endpoint');
    if ($id == 0) {
      $playlist = Playlist::where('type', $id)->get();
    } elseif ($id == 1) {
      $playlist = Playlist::where('type', $id)->get();
    }
    $playlists_json = [];
    foreach ($playlist as $playlists) {
      $playlist_id = $playlists->playlists_id;
      $playid      = $playlists->id;
      $price       = $playlists->price;
      $type        = $playlists->type;
      $cat         = $playlists->Category;
      $view_count  = $playlists->view_count;
      $url = $youtubeEndPoint . "search?part=" . $parts . "&maxResults=" . $maxResults . "&type=video&videoId=&key=" . $apikey . "&q=" . $playlist_id;
      $response = Http::get($url);
      $playlist_data = (array)json_decode($response->body());
      $playlists_json[] = ['playlists' => $playlist_data, 'id' => $playid, 'price' => $price, 'type' => $type, 'category' => $cat, 'view_count' => $view_count];
    }
    return view('coursetype', compact('playlists_json', 'playlist'));
  }


  //show single playlist
  public function showsinglevideos($id)
  {
    $parts = 'snippet';
    $apikey = config('services.youtube.api_key');
    $maxResults = 40;
    $youtubeEndPoint = config('services.youtube.playlist_endpoint');

    $playlist = Playlist::find($id);
    $pla_id = $playlist->playlists_id;
    $url = $youtubeEndPoint . "search?part=" . $parts . "&maxResults=" . $maxResults . "&type=video&videoId=&key=" . $apikey . "&q=" . $pla_id;
    $response = Http::get($url);
    $playlist_data = (array)json_decode($response->body());
    $tutorial_key = 'course_' . $id;
    if (!Session::has($tutorial_key)) {
      $playlist->increment('view_count');
      Session::put($tutorial_key, 1);
    }
    return view('video_single', compact('playlist_data', 'playlist'));
  }
}
