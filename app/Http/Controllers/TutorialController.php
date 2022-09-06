<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Playlistsvideos;
use App\Models\Proposal;
use App\Models\Propsolution;
use App\Models\ReqSolution;
use App\Models\Request as ModelsRequest;
use App\Models\Tutorial;
use App\Models\Tutorialreview;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use LengthException;
use Nette\Utils\RegexpException;
use Symfony\Polyfill\Intl\Idn\Resources\unidata\Regex;

class TutorialController extends Controller
{


    //store tutorial data
    public function get(Request $request)
    {

        // if ($request->ajax()) :
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
            'type'          => ['required'],
        ]);
        $video = Playlist::all();
        if ($request->has('file')) {
            $request->validate([
                'file'         => ['required', 'mimes:jpg,jpeg,svg,pdf,png,zip,rar'],
            ]);
            if ($request->price != '') {
                $price = $request->price;
            } else {
                $price = 0;
            }
            $url = $request->playlists_id;
            parse_str(parse_url($url, PHP_URL_QUERY), $my_array);

            $filename = time() . '_' . $request->file->getClientOriginalName();
            $filepath = $request->file('file')->storeAs('uploads', $filename, 'public');
            Playlist::create(array_merge($request->only('type', 'Category'), [
                'user_id'      => auth()->id(),
                'price'        => $price,
                'playlists_id' => $my_array['v'],
                'file'         => '/storage/' . $filepath,
            ]));
        } else {
            if ($request->price != '') {
                $price = $request->price;
            } else {
                $price = 0;
            }
            $url = $request->playlists_id;
            parse_str(parse_url($url, PHP_URL_QUERY), $my_array);

            Playlist::create(array_merge($request->only('type', 'Category'), [
                'user_id'      => auth()->id(),
                'playlists_id' => $my_array['v'],
                'price'        => $price,
                'file'         => '',
            ]));
        }

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
            $user        = $playlists->user->username;
            $color       = $playlists->user->role->color->name;
            $cat         = $playlists->Category;
            $view_count  = $playlists->view_count;
            $url = $youtubeEndPoint . "search?part=" . $parts . "&maxResults=" . $maxResults . "&type=video&videoId=&key=" . $apikey . "&q=" . $playlist_id;
            $response = Http::get($url);
            $playlist_data = (array)json_decode($response->body());
            $playlists_json[] = ['playlists' => $playlist_data, 'id' => $playid, 'user' => $user, 'color' => $color,  'type' => $type, 'price' => $price, 'view_count' => $view_count, 'category' => $cat];
        }

        $t_req_count = ModelsRequest::whereDate('created_at', Carbon::today())->count();
        $t_prop_count = Proposal::whereDate('created_at', Carbon::today())->count();
        $t_reqsolution_count = ReqSolution::whereDate('created_at', Carbon::today())->count();
        $t_propsolution_count = Propsolution::whereDate('created_at', Carbon::today())->count();

        return view('tutorial', compact('playlists_json', 'playlist', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count'));
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
            $user        = $playlists->user->username;
            $color       = $playlists->user->role->color->name;
            $type        = $playlists->type;
            $cat         = $playlists->Category;
            $view_count  = $playlists->view_count;
            $url = $youtubeEndPoint . "search?part=" . $parts . "&maxResults=" . $maxResults . "&type=video&videoId=&key=" . $apikey . "&q=" . $playlist_id;
            $response = Http::get($url);
            $playlist_data = (array)json_decode($response->body());
            $playlists_json[] = ['playlists' => $playlist_data, 'id' => $playid, 'user' => $user, 'color' => $color,  'price' => $price, 'type' => $type, 'category' => $cat, 'view_count' => $view_count];
        }

        $t_req_count = ModelsRequest::whereDate('created_at', Carbon::today())->count();
        $t_prop_count = Proposal::whereDate('created_at', Carbon::today())->count();
        $t_reqsolution_count = ReqSolution::whereDate('created_at', Carbon::today())->count();
        $t_propsolution_count = Propsolution::whereDate('created_at', Carbon::today())->count();
        return view('tutorial', compact('playlists_json', 'playlist', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count'));
    }
    public function trending()
    {
        $parts = 'snippet';
        $apikey = config('services.youtube.api_key');
        $maxResults = 40;
        $youtubeEndPoint = config('services.youtube.playlist_endpoint');

        $playlist = Playlist::where('view_count', '>=', 20)->orderBy('updated_at', 'DESC')->get();
        $playlists_json = [];
        foreach ($playlist as $playlists) {
            $playlist_id = $playlists->playlists_id;
            $playid      = $playlists->id;
            $price       = $playlists->price;
            $user        = $playlists->user->username;
            $color       = $playlists->user->role->color->name;
            $type        = $playlists->type;
            $cat         = $playlists->Category;
            $view_count  = $playlists->view_count;
            $url = $youtubeEndPoint . "search?part=" . $parts . "&maxResults=" . $maxResults . "&type=video&videoId=&key=" . $apikey . "&q=" . $playlist_id;
            $response = Http::get($url);
            $playlist_data = (array)json_decode($response->body());
            $playlists_json[] = ['playlists' => $playlist_data, 'id' => $playid, 'user' => $user, 'color' => $color, 'price' => $price, 'type' => $type, 'category' => $cat, 'view_count' => $view_count];
        }
        $t_req_count = ModelsRequest::whereDate('created_at', Carbon::today())->count();
        $t_prop_count = Proposal::whereDate('created_at', Carbon::today())->count();
        $t_reqsolution_count = ReqSolution::whereDate('created_at', Carbon::today())->count();
        $t_propsolution_count = Propsolution::whereDate('created_at', Carbon::today())->count();


        return view('tutorial', compact('playlists_json', 'playlist', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count'));
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
            $user        = $playlists->user->username;
            $color       = $playlists->user->role->color->name;
            $type        = $playlists->type;
            $cat         = $playlists->Category;
            $view_count  = $playlists->view_count;
            $url = $youtubeEndPoint . "search?part=" . $parts . "&maxResults=" . $maxResults . "&type=video&videoId=&key=" . $apikey . "&q=" . $playlist_id;
            $response = Http::get($url);
            $playlist_data = (array)json_decode($response->body());
            $playlists_json[] = ['playlists' => $playlist_data, 'id' => $playid, 'user' => $user, 'color' => $color,  'price' => $price, 'type' => $type, 'category' => $cat, 'view_count' => $view_count];
        }

        $t_req_count = ModelsRequest::whereDate('created_at', Carbon::today())->count();
        $t_prop_count = Proposal::whereDate('created_at', Carbon::today())->count();
        $t_reqsolution_count = ReqSolution::whereDate('created_at', Carbon::today())->count();
        $t_propsolution_count = Propsolution::whereDate('created_at', Carbon::today())->count();

        return view('tutorial', compact('playlists_json', 'playlist', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count'));
    }


    //get all videos
    protected function getvideos()
    {
        $parts = 'snippet';
        $apikey = config('services.youtube.api_key');
        $maxResults = 40;
        $youtubeEndPoint = config('services.youtube.playlist_endpoint');

        $playlist = Playlist::all();

        // dd($playlist);
        $playlists_json = [];
        foreach ($playlist as $playlists) {
            $playlist_id = $playlists->playlists_id;
            $playid      = $playlists->id;
            $price       = $playlists->price;
            $user        = $playlists->user->username;
            $color       = $playlists->user->role->color->name;
            $cat         = $playlists->Category;
            $type        = $playlists->type;
            $view_count  = $playlists->view_count;
            $url = $youtubeEndPoint . "search?part=" . $parts . "&maxResults=" . $maxResults . "&type=video&videoId=&key=" . $apikey . "&q=" . $playlist_id;
            $response = Http::get($url);
            $playlist_data = (array)json_decode($response->body());
            $playlists_json[] = ['playlists' => $playlist_data, 'id' => $playid, 'user' => $user, 'color' => $color, 'type' => $type, 'price' => $price, 'view_count' => $view_count, 'category' => $cat];
        }
        // dd($playlist);
        $t_req_count = ModelsRequest::whereDate('created_at', Carbon::today())->count();
        $t_prop_count = Proposal::whereDate('created_at', Carbon::today())->count();
        $t_reqsolution_count = ReqSolution::whereDate('created_at', Carbon::today())->count();
        $t_propsolution_count = Propsolution::whereDate('created_at', Carbon::today())->count();
        return view('tutorial', compact('playlists_json', 'playlist', 't_req_count', 't_prop_count', 't_reqsolution_count', 't_propsolution_count'));
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
            $user        = $playlists->user->username;
            $color       = $playlists->user->role->color->name;
            $type        = $playlists->type;
            $cat         = $playlists->Category;
            $view_count  = $playlists->view_count;
            $url = $youtubeEndPoint . "search?part=" . $parts . "&maxResults=" . $maxResults . "&type=video&videoId=&key=" . $apikey . "&q=" . $playlist_id;
            $response = Http::get($url);
            $playlist_data = (array)json_decode($response->body());
            $playlists_json[] = ['playlists' => $playlist_data, 'id' => $playid, 'user' => $user, 'color' => $color, 'price' => $price, 'type' => $type, 'category' => $cat, 'view_count' => $view_count];
        }
        return view('tutorialtype', compact('playlists_json', 'id', 'playlist'));
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
        $reviews = Tutorialreview::where('playlist_id', $id)->orderBy('created_at', 'DESC')->cursorPaginate(4);
        return view('video_single', compact('playlist_data', 'playlist', 'reviews'));
    }
}
