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
use DateInterval;
use DateTime;
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
            'type'          => ['required', 'regex:/^(0|1)$/'],
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
        flash()->addSuccess('Tutorial has been uploaded Successfully');
        return back();
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

            //get video duration
            foreach ($playlist_data['items'] as $key => $data) {
                if ($key == 0) {

                    $video_id = $data->id->videoId;
                    $url_duration = $youtubeEndPoint . "videos?id=" . $video_id . "&part=contentDetails&key=" . $apikey;
                    $response_duration = Http::get($url_duration);
                    $duration_data = (array)json_decode($response_duration->body());
                    $video_duration = $duration_data['items'][0]->contentDetails->duration;

                    if ($video_duration) {
                        $start = new DateTime('@0'); // Unix epoch
                        $start->add(new DateInterval($video_duration));
                        $youtube_time = $start->format('H:i:s');
                    }
                }
            }

            $playlists_json[] = ['playlists' => $playlist_data, 'id' => $playid, 'duration' => $youtube_time, 'user' => $user, 'color' => $color,  'type' => $type, 'price' => $price, 'view_count' => $view_count, 'category' => $cat];
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

            //get video duration
            foreach ($playlist_data['items'] as $key => $data) {
                if ($key == 0) {

                    $video_id = $data->id->videoId;
                    $url_duration = $youtubeEndPoint . "videos?id=" . $video_id . "&part=contentDetails&key=" . $apikey;
                    $response_duration = Http::get($url_duration);
                    $duration_data = (array)json_decode($response_duration->body());
                    $video_duration = $duration_data['items'][0]->contentDetails->duration;

                    if ($video_duration) {
                        $start = new DateTime('@0'); // Unix epoch
                        $start->add(new DateInterval($video_duration));
                        $youtube_time = $start->format('H:i:s');
                    }
                }
            }

            $playlists_json[] = ['playlists' => $playlist_data, 'duration' => $youtube_time, 'id' => $playid, 'user' => $user, 'color' => $color,  'price' => $price, 'type' => $type, 'category' => $cat, 'view_count' => $view_count];
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

            //get video duration

            foreach ($playlist_data['items'] as $key => $data) {
                if ($key == 0) {

                    $video_id = $data->id->videoId;
                    $url_duration = $youtubeEndPoint . "videos?id=" . $video_id . "&part=contentDetails&key=" . $apikey;
                    $response_duration = Http::get($url_duration);
                    $duration_data = (array)json_decode($response_duration->body());
                    $video_duration = $duration_data['items'][0]->contentDetails->duration;

                    if ($video_duration) {
                        $start = new DateTime('@0'); // Unix epoch
                        $start->add(new DateInterval($video_duration));
                        $youtube_time = $start->format('H:i:s');
                    }
                }
            }

            $playlists_json[] = ['playlists' => $playlist_data, 'duration' => $youtube_time, 'id' => $playid, 'user' => $user, 'color' => $color, 'price' => $price, 'type' => $type, 'category' => $cat, 'view_count' => $view_count];
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

            //get video duration

            foreach ($playlist_data['items'] as $key => $data) {
                if ($key == 0) {

                    $video_id = $data->id->videoId;
                    $url_duration = $youtubeEndPoint . "videos?id=" . $video_id . "&part=contentDetails&key=" . $apikey;
                    $response_duration = Http::get($url_duration);
                    $duration_data = (array)json_decode($response_duration->body());
                    $video_duration = $duration_data['items'][0]->contentDetails->duration;

                    if ($video_duration) {
                        $start = new DateTime('@0'); // Unix epoch
                        $start->add(new DateInterval($video_duration));
                        $youtube_time = $start->format('H:i:s');
                    }
                }
            }

            $playlists_json[] = ['playlists' => $playlist_data, 'duration' => $youtube_time, 'id' => $playid, 'user' => $user, 'color' => $color,  'price' => $price, 'type' => $type, 'category' => $cat, 'view_count' => $view_count];
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
            //get video duration

            //dd($playlist_data);

            foreach ($playlist_data['items'] as $key => $data) {
                if ($key == 0) {

                    $video_id = $data->id->videoId;
                    $url_duration = $youtubeEndPoint . "videos?id=" . $video_id . "&part=contentDetails&key=" . $apikey;
                    $response_duration = Http::get($url_duration);
                    $duration_data = (array)json_decode($response_duration->body());
                    $video_duration = $duration_data['items'][0]->contentDetails->duration;

                    if ($video_duration) {
                        $start = new DateTime('@0'); // Unix epoch
                        $start->add(new DateInterval($video_duration));
                        $youtube_time = $start->format('H:i:s');
                    }
                }
            }
            $playlists_json[] = ['playlists' => $playlist_data, 'duration' => $youtube_time, 'id' => $playid, 'user' => $user, 'color' => $color, 'type' => $type, 'price' => $price, 'view_count' => $view_count, 'category' => $cat];
        }
        // dd($playlists_json);

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

            //get video duration

            foreach ($playlist_data['items'] as $key => $data) {
                if ($key == 0) {

                    $video_id = $data->id->videoId;
                    $url_duration = $youtubeEndPoint . "videos?id=" . $video_id . "&part=contentDetails&key=" . $apikey;
                    $response_duration = Http::get($url_duration);
                    $duration_data = (array)json_decode($response_duration->body());
                    $video_duration = $duration_data['items'][0]->contentDetails->duration;

                    if ($video_duration) {
                        $start = new DateTime('@0'); // Unix epoch
                        $start->add(new DateInterval($video_duration));
                        $youtube_time = $start->format('H:i:s');
                    }
                }
            }

            $playlists_json[] = ['playlists' => $playlist_data, 'duration' => $youtube_time, 'id' => $playid, 'user' => $user, 'color' => $color, 'price' => $price, 'type' => $type, 'category' => $cat, 'view_count' => $view_count];
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

    //live search
    public function livesearch(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $parts = 'snippet';
            $apikey = config('services.youtube.api_key');
            $maxResults = 40;
            $youtubeEndPoint = config('services.youtube.playlist_endpoint');

            $datas = Playlist::where('Category', 'LIKE', '%' . $request->search . "%")->get();
            $playlists_json = [];
            foreach ($datas as $playlists) {
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
                //get video duration
                foreach ($playlist_data['items'] as $key => $data) {
                    if ($key == 0) {

                        $video_id = $data->id->videoId;
                        $url_duration = $youtubeEndPoint . "videos?id=" . $video_id . "&part=contentDetails&key=" . $apikey;
                        $response_duration = Http::get($url_duration);
                        $duration_data = (array)json_decode($response_duration->body());
                        $video_duration = $duration_data['items'][0]->contentDetails->duration;

                        if ($video_duration) {
                            $start = new DateTime('@0'); // Unix epoch
                            $start->add(new DateInterval($video_duration));
                            $youtube_time = $start->format('H:i:s');
                        }
                    }
                }
                $playlists_json[] = ['playlists' => $playlist_data, 'id' => $playid, 'duration' => $youtube_time, 'user' => $user, 'color' => $color, 'type' => $type, 'price' => $price, 'view_count' => $view_count, 'category' => $cat];
            }

            if ($datas) {
                foreach ($playlists_json as $key => $items) {
                    foreach ($items['playlists']['items'] as $key => $item) {
                        if ($key == 0) {

                            $output .= '
                      <div class="col-xl-4 col-lg-6 col-md-6">
                      <div class="full-width mt-4">
                          <div class="recent-items">
                              <div class="posts-list">
                                  <div class="feed-shared-product-dt">
                                      <div class="pdct-img">
                                          <a><img
                                                  class="ft-plus-square product-bg-w bg-cyan me-0"
                                                  src="' . $item->snippet->thumbnails->medium->url . '"
                                                  alt=""></a>
                                          <div class="overlay-item">
                                              <div class="badge-timer">
                                                  ' . $items['duration'] . '
                                              </div>
                                          </div>
                                      </div>
                                      <div class="author-dts pp-20">
                                          <a  class="job-heading pp-title">{{
                                              ' . $item->snippet->title . '</a>
                                                  <p
                                                  class="notification-text font-small-4">
                                                  by <a href="#"
                                                  class="cmpny-dt blk-clr" style="color:' . $items['color'] . '">' . $items['user'] . '</a>
                                              </p>
                                              <p class="notification-text font-small-4">
                                                  <i class="fas fa-tag"></i> ' . $items['category'] . '
                                              </p>
                                          <div class="ppdt-price-sales">

                                              <div class="ppdt-price">
                                                  ৳ ' . $items['price'] . '
                                              </div>
                                              <div class="ppdt-sales">
                                                  0 Sales
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="post-meta">
                                  <div class="job-actions">
                                      <div class="aplcnts_15">
                                          <a href="/tutorial_sin/' . $items['id'] . '" class="
                                              view-btn btn-hover">Detail
                                              View</a>
                                      </div>
                                      <div class="action-btns-job">
                                          <i class="feather-eye mr-2"></i>' . $items['view_count'] . '

                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>';
                        }
                    }
                }
                return Response($output);
            }
        }
    }
}
