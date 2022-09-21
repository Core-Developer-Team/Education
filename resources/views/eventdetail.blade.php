@section('title', 'Event_Detail')
@include('layouts.header')

<header class="header clearfix">
    <div class="header-inner">
        <!--Top Menu-->
        @include('layouts.menu')
        <!--/Top Menu-->
        <div class="overlay"></div>
    </div>
</header>

<div class="wrapper pt-0">
   
    <div class="page-tabs">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="">Event_Detail</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="event-content-main">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-lg-12 col-md-12">
                    <div class="event-card evnt55t">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="event-img-view">
                                        <div class="event-img">
                                            <div class="item-slide d-flex">
                                                <img class="justify-content-center align-self-center img-lazy-load b-loaded br-10"
                                                    src="{{$data->image}}" alt="">
                                                <div class="slider-blured-background"
                                                    style="background-image: url('{images/event-imgs/img-1.jpg}');"></div>
                                            </div>
                                            <div class="event-date">
                                                <span class="emnth">{{$data->event_date->format('M')}}</span>
                                                <span class="edate">{{$data->event_date->format('d')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="event_dts p-0">
                                        <span class="evnt_time txtbold"> {{$data->event_date->format('D, d M ')}} AT {{ $data->start_time->format('g:i A') }} To {{ $data->end_time->format('g:i A') }}</span>
                                        <h4 class="event-heading-title text-left">{{$data->name}}</h4>
                                        <div class="ttlcnt15 invtbyuser">
                                            <div class="invited_avtar_ee userimg">
                                                <img class="ft-plus-square evnt-invite-circle bg-cyan me-0"
                                                    src="/storage/{{$data->user->image}}" alt="">
                                                     <!--hover on image-->
                                            <div class="box imagehov shadow"
                                            style="width: auto; height:auto;  position: absolute; z-index: 1;">
                                            <div class="full-width">
                                                <div class="recent-items">
                                                    <div class="posts-list">
                                                        <div class="feed-shared-author-dt">
                                                            <div class="author-left">
                                                                <img class="ft-plus-square job-bg-circle bg-cyan mr-0"
                                                                    src="/storage/{{ $data->user->image }}"
                                                                    alt="">
                                                                <div
                                                                    class="@if (Cache::has('user-is-online-' . $data->user->id)) status-oncircle @else status-ofcircle @endif">
                                                                </div>
                                                            </div>
                                                            <div class="author-dts">
                                                                <p class="notification-text font-username">
                                                                    <a href="{{ route('profile.show', ['id' => $data->user_id]) }}"
                                                                        style="color: {{ $data->user->role->color->name }}">{{ $data->user->username }}
                                                                    </a><img src="{{ $data->user->badge->image }}"
                                                                        alt="" style="width: 20px;"
                                                                        title="{{ $data->user->badge->name }}">
                                                                    <span class="job-loca"><i
                                                                            class="fas fa-location-arrow"></i>{{ $data->user->uni_name }}</span>
                                                                </p>

                                                                <p class="notification-text font-small-4 pt-1">
                                                                    <span class="time-dt">Joined on
                                                                        {{ $data->user->created_at->format('d:M:y g:i A') }}</span>
                                                                </p>
                                                                <p class="notification-text font-small-4 pt-1">
                                                                    <span class="time-dt">Last Seen
                                                                        @if (Cache::has('user-is-online-' . $data->user->id))
                                                                            <span
                                                                                class="text-success">Online</span>
                                                                        @else
                                                                            {{ Carbon\Carbon::parse($data->user->last_seen)->diffForHumans() }}
                                                                        @endif
                                                                    </span>
                                                                </p>
                                                                <p class="notification-text font-small-4 pt-1">
                                                                    <span class="time-dt">Total Solutions
                                                                        {{ $data->user->solutions }}</span>
                                                                </p>
                                                                <p class="notification-text font-small-4 pt-1">
                                                                    <span class="time-dt">Rating
                                                                        {{ $data->user->rating }}</span>
                                                                </p>
                                                                <p class="notification-text font-small-4 pt-1">
                                                                    <span
                                                                        class="time-dt">{{ $data->user->badge->name }}</span>
                                                                </p>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end hover-->
                                            </div>
                                            <span class="evntcunt">Hosted by <a href="{{ route('profile.show', ['id' => $data->user_id]) }}"  style="color: {{ $data->user->role->color->name }}"> {{$data->user->username}} </a> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="event-card mt-30">
                        <div class="headtte14m">
                            <span><i class="feather-info"></i></span>
                            <h4>Details</h4>
                        </div>
                        <div class="evntdt99">
                          
                            <div class="mndtlist">
                                <div class="evntflldt4 flxcntr">
                                    <div class="hhttd14s">
                                        <i class="feather-map-pin"></i>
                                    </div>
                                    <div class="ttlpple">
                                        <a href="#">{{$data->location}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="mndtlist">
                                <div class="mndesp145">
                                    <div class="evarticledes">
                                        <p class="mb-0">
                                            {{$data->description}}
                                        </p>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--footer-->
@include('layouts.footer')
<!---/footer-->
