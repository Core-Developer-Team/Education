@section('title', 'Resource_Single')
@include('layouts.header')
<header class="header clearfix">
    <div class="header-inner">
        @include('layouts.menu')
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
                            <a class="nav-link active" href="">Resource Details</a>
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
                    <div class="full-width">
                        <div class="recent-items">
                            <div class="posts-list">
                                <div class="feed-job-dt">
                                    <div class="joblftdt5">
                                        <div class="author-left main_img_view userimg">
                                            <a href="#">
                                                <img class="ft-plus-square iconreq job-bg-circle bg-cyan mr-0"
                                                    src="{{ $data->user->badge->image }}"
                                                    style="width:25px; height:25px; margin-top:5px"
                                                    title="{{ $data->user->badge->name }}">
                                                <img class="ft-plus-square main-job-bg-circle bg-cyan me-0"
                                                    src="/storage/{{ $data->user->image }}" alt="">
                                                <div style="width: 17px; height:17px;margin-top: 80px; position:absolute;display: inline-block;margin-left: -30px;"
                                                    class="@if (Cache::has('user-is-online-' . $data->user->id)) status-oncircle @else status-ofcircle @endif">
                                                </div>
                                            </a>

                                            <!--hover on image-->
                                            <div class="box imagehov shadow"
                                                style="width: auto; height:auto;  position: absolute; z-index: 1;">
                                                <div class="full-width">
                                                    <div class="recent-items">
                                                        <div class="posts-list">
                                                            <div class="feed-shared-author-dt">
                                                                <div class="author-left">
                                                                    <a href="#"><img
                                                                            class="ft-plus-square job-bg-circle bg-cyan mr-0"
                                                                            src="/storage/{{ $data->user->image }}"
                                                                            alt=""></a>
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
                                                                            {{ $data->user->created_at }}</span>
                                                                    </p>
                                                                    <p class="notification-text font-small-4 pt-1">
                                                                        <span class="time-dt">Last Seen
                                                                            @if (Cache::has('user-is-online-' . $data->user->id))
                                                                                <span class="text-success">Online</span>
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
                                        <div class="author-dts">
                                            <h4 class="job-view-heading job-center">{{ $data->name }}</h4>
                                            <p class="notification-text font-small-4 job-center">
                                            <div class="userimg">
                                                <a href="{{ route('profile.show', ['id' => $data->user_id]) }}"
                                                    style="color: {{ $data->user->role->color->name }}"
                                                    class="cmpny-dt">{{ $data->user->username }}</a>
                                                <!--hover on image-->
                                                <div class="box imagehov shadow"
                                                    style="width: auto; height:auto;  position: absolute; z-index: 1;">
                                                    <div class="full-width">
                                                        <div class="recent-items">
                                                            <div class="posts-list">
                                                                <div class="feed-shared-author-dt">
                                                                    <div class="author-left">
                                                                        <a href="#"><img
                                                                                class="ft-plus-square job-bg-circle bg-cyan mr-0"
                                                                                src="/storage/{{ $data->user->image }}"
                                                                                alt=""></a>
                                                                    </div>
                                                                    <div class="author-dts">
                                                                        <p class="notification-text font-username">
                                                                            <a href="{{ route('profile.show', ['id' => $data->user_id]) }}"
                                                                                style="color: {{ $data->user->role->color->name }}">{{ $data->user->username }}
                                                                            </a><img
                                                                                src="{{ $data->user->badge->image }}"
                                                                                alt="" style="width: 20px;"
                                                                                title="{{ $data->user->badge->name }}">
                                                                            <span class="job-loca"><i
                                                                                    class="fas fa-location-arrow"></i>{{ $data->user->uni_name }}</span>
                                                                        </p>

                                                                        <p class="notification-text font-small-4 pt-1">
                                                                            <span class="time-dt">Joined on
                                                                                {{ $data->user->created_at }}</span>
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
                                            <span class="job-loca"><i class="fas fa-location-arrow"></i><ins
                                                    class="state-name">{{ $data->user->uni_name }}</span>
                                            <p class="notification-text font-small-4 pt-2 job-center">
                                                <span class="time-dt">{{ $data->updated_at->diffForHumans() }}</span>
                                            </p>
                                            <div class="jbopdt142">

                                                        <div class="aplcnts_15 job-center applcntres ml-3 mb-md-0 mb-4">
                                                            <span class="job-badge bg-success payNow d-inline" data-id=""
                                                                data-amount="{{ $data->price }}"
                                                                data-seller="{{$data->user_id}}"
                                                                data-resource="resources">
                                                                Take this resource
                                                            </span>
                                                        </div>

                                                <div class="aplcnts_15 job-center applcntres ml-3">
                                                    <i
                                                        class="feather-users ms-2"></i><span class="d-inline">Applicants</span><ins>0</ins>
                                                    <span class="job-badge ddcolor d-inline">??? {{ $data->price }} </span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    {{-- <div class="action-btns-job job-center resmargin">
                                        @if (!(auth()->id() == $data->user_id))
                                            <a href="#"
                                                class="apply_job_btn ps-4 view-btn btn-hover  @if ($data->resourcebid()->where('user_id', Auth()->id())->count() >= 1) d-none @endif"
                                                data-bs-toggle="modal" data-bs-target="#addresourcebid">Bid Now</a>
                                        @endif
                                        <span class="apply_job_btn ">$ {{ $data->price }}</span>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9 col-md-12">

                    <!--description-->
                    @if (session('status'))
                        <div class="bg-success p-4 rounded-lg mb-6 text-white text-center">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="event-card mt-4">
                        <div class="jobdt99">
                            <div class="jbdes25">
                                <div class="jobtxt47">
                                    <h4>Description</h4>
                                    {{ $data->description }}
                                </div>

                            </div>

                        </div>
                    </div>


                        <!--file-->
                        <div class="event-card mt-4">
                            <div class="jobdt99">
                                <div class="jbdes25">
                                    <div class="jobtxt47">
                                        <h4>Download file from here</h4>
                                        <hr>
                                        <a href="{{ $data->file_path }}" download>Download here</a>
                                    </div>

                                </div>
                            </div>
                        </div>

                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="full-width mt-4">
                        <div class="user-profile">
                            <div class="username-dt dpbg-1">
                                <div class="usr-pic">
                                    <div style="margin-top: 10px; width:15px; height: 15px"
                                        class="@if (Cache::has('user-is-online-' . $data->user->id)) status-oncircle @else status-ofcircle @endif">
                                    </div>
                                    <img src="/storage/{{ $data->user->image }}" alt="">
                                </div>
                            </div>
                            <div class="username-main-dt">
                                <a class="h4" href="{{ route('profile.show', ['id' => $data->user_id]) }}"
                                    style="color: {{ $data->user->role->color->name }}">{{ $data->user->username }}
                                </a>
                            </div>
                            <div class="user-info__sections">
                                <ul class="info__sections">
                                    <li>
                                        <div class="all-info__sections">
                                            <span class="all-info__left">Post Requests</span>
                                            <span class="all-info__right">{{ $data->user->request->count() }}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="all-info__sections">
                                            <span class="all-info__left">Solutions</span>
                                            <span class="all-info__right">{{ $data->user->solutions }}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="all-info__sections">
                                            <span class="all-info__left">Products</span>
                                            <span
                                                class="all-info__right">{{ $data->user->book->count() + $data->user->product->count() }}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="profile-link">
                                <a href="{{ route('profile.show', ['id' => $data->user_id]) }}">View Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<input type="hidden" class="reqId" value="{{ $data->id }}" />

<style>
    #bKash_button {
        cursor: pointer;
    }
</style>
<!--footer-->
@include('layouts.footer')
<!---/footer-->
<script src="{{ asset('asset/js/bkashpayment.js') }}"></script>
<link rel="stylesheet" href="{{ asset('asset/css/paymentBkash.css') }}">

