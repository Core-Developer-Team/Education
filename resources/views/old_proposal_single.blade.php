@section('title', 'Proposal_Single')
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
                            <a class="nav-link active" href="">Proposal Details</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="event-content-main">
        <div class="container">
            <div class="row ">
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
                                                    style="width:25px; height:25px; ; margin-top:5px; position: absolute;"
                                                    title="{{ $data->user->badge->name }}">
                                                <img class="ft-plus-square main-job-bg-circle bg-cyan me-0"
                                                    src="/storage/{{ $data->user->image }}" alt="">
                                                <div style="width: 15px; height:15px;margin-top: 80px; position:absolute;display: inline-block;margin-left: -30px;"
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
                                                                            alt="">
                                                                        <div
                                                                            class="@if (Cache::has('user-is-online-' . $data->user->id)) status-oncircle @else status-ofcircle @endif">
                                                                        </div>
                                                                    </a>
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
                                            <h4 class="job-view-heading job-center">{{ $data->proposalname }}</h4>
                                            <p class="notification-text font-small-4 job-center">
                                            <div class="userimg">
                                                <a href="{{ route('profile.show', ['id' => $data->user_id]) }}"
                                                    class="cmpny-dt"
                                                    style="color: {{ $data->user->role->color->name }}">{{ $data->user->username }}</a>
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
                                                                                alt="">
                                                                            <div
                                                                                class="@if (Cache::has('user-is-online-' . $data->user->id)) status-oncircle @else status-ofcircle @endif">
                                                                            </div>
                                                                        </a>
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
                                                                                {{ $data->user->created_at->format('d:M:y g:i A') }}</span>
                                                                        </p>
                                                                        <span class="time-dt">Last Seen
                                                                            @if (Cache::has('user-is-online-' . $data->user->id))
                                                                                <span class="text-success">Online</span>
                                                                            @else
                                                                                {{ Carbon\Carbon::parse($data->user->last_seen)->diffForHumans() }}
                                                                            @endif
                                                                        </span>
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
                                            </p>
                                            <p class="notification-text font-small-4 pt-2 job-center">
                                                <span class="time-dt">{{ $data->updated_at->diffForHumans() }}</span>
                                            </p>
                                            <div class="jbopdt142">
                                                <div class="jbbdges10">
                                                    <span class="job-badge ffcolor">
                                                        @if ($data->tag == 1)
                                                            Offline
                                                        @else
                                                            Online
                                                        @endif
                                                    </span>
                                                    <span class="job-badge ddcolor">??? {{ $data->price }}</span>
                                                </div>
                                                <div class="aplcnts_15 job-center applcntres ml-3">
                                                    <i
                                                        class="feather-users ms-2"></i><span>Applicants</span><ins>{{ $data->proposalbid()->count() }}</ins>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="action-btns-job job-center resmargin">
                                        @if (!(auth()->id() == $data->user_id))
                                            @if ($data->propsolution()->count() == 0)
                                                <a href="#"
                                                    class="apply_job_btn ps-4 view-btn btn-hover  @if ($data->proposalbid()->where('user_id', Auth()->id())->count() >= 1) d-none @endif"
                                                    data-bs-toggle="modal" data-bs-target="#addproposalbid">Bid
                                                    Now</a>
                                            @endif
                                            @if (@$data->isBided()->first()->id != @$data->paymentLog($data->id)->bid_id)
                                                <a href="#" class="job-badge btn-success text-light"
                                                    data-bs-toggle="" data-bs-target=""
                                                    title="Waiting for buyer response"><i
                                                        class="fa-solid fa-check"></i> Bided</a>
                                            @else
                                                <a href="#"
                                                    class="apply_job_btn ps-4 view-btn btn-hover @if ($data->proposalbid()->where('user_id', Auth()->id())->count() == false ||
                                                        $data->propsolution()->where('user_id', Auth()->id())->count() >= 1) d-none @endif"
                                                    data-bs-toggle="modal" data-bs-target="#addsolution">
                                                    Solution
                                                </a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9 col-md-12">
                    @if (session('status'))
                        <div class="bg-danger p-4 rounded-lg mb-6 text-white text-center">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('solstatus'))
                        <div class="bg-danger p-4 rounded-lg mb-6 text-white text-center">
                            {{ session('solstatus') }}
                        </div>
                    @endif
                    <!--All Bids-->
                    @if (auth()->id() == $data->user_id)
                        <div class="event-card mt-4">
                            <div class="jobdt99">
                                <div class="jbdes25">
                                    <div class="jobtxt47">
                                        <h4>All Bids</h4>
                                        <hr>
                                        @forelse ($data->proposalbid()->orderBy('updated_at','DESC')->get() as $bids)
                                            <div
                                                class="d-sm-flex align-items-center rounded border-none mt-3 p-3 justify-content-between mb-4">
                                                <div class="">
                                                    <div class="rounded-circle d-flex">
                                                        <div class="userimg">
                                                            <img class="ft-plus-square job-bg-circle iconreq bg-cyan mr-0"
                                                                src="{{ $bids->user->badge->image }}"
                                                                style="width:20px; height:20px"
                                                                title="{{ $bids->user->badge->name }}">
                                                            <img src="/storage/{{ $bids->user->image }}"
                                                                class="rounded-circle"
                                                                style="width: 50px;height: 50px;" alt=""
                                                                srcset="">
                                                            <div style="margin-top: 38px; position:absolute;display: inline-block;margin-left: -18px;"
                                                                class="@if (Cache::has('user-is-online-' . $bids->user->id)) status-oncircle @else status-ofcircle @endif">
                                                            </div>
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
                                                                                            src="/storage/{{ $bids->user->image }}"
                                                                                            alt="">
                                                                                        <div
                                                                                            class="@if (Cache::has('user-is-online-' . $bids->user->id)) status-oncircle @else status-ofcircle @endif">
                                                                                        </div>
                                                                                    </a>
                                                                                </div>
                                                                                <div class="author-dts">
                                                                                    <p
                                                                                        class="notification-text font-username">
                                                                                        <a href="{{ route('profile.show', ['id' => $bids->user_id]) }}"
                                                                                            style="color: {{ $bids->user->role->color->name }}">{{ $bids->user->username }}
                                                                                        </a><img
                                                                                            src="{{ $bids->user->badge->image }}"
                                                                                            alt=""
                                                                                            style="width: 20px;"
                                                                                            title="{{ $bids->user->badge->name }}">
                                                                                        <span class="job-loca"><i
                                                                                                class="fas fa-location-arrow"></i>{{ $bids->user->uni_name }}</span>
                                                                                    </p>

                                                                                    <p
                                                                                        class="notification-text font-small-4 pt-1">
                                                                                        <span class="time-dt">Joined on
                                                                                            {{ $bids->user->created_at->format('d:M:y g:i A') }}</span>
                                                                                    </p>
                                                                                    <span class="time-dt">Last Seen
                                                                                        @if (Cache::has('user-is-online-' . $bids->user->id))
                                                                                            <span
                                                                                                class="text-success">Online</span>
                                                                                        @else
                                                                                            {{ Carbon\Carbon::parse($bids->user->last_seen)->diffForHumans() }}
                                                                                        @endif
                                                                                    </span>
                                                                                    <p
                                                                                        class="notification-text font-small-4 pt-1">
                                                                                        <span class="time-dt">Total
                                                                                            Solutions
                                                                                            {{ $bids->user->solutions }}</span>
                                                                                    </p>
                                                                                    <p
                                                                                        class="notification-text font-small-4 pt-1">
                                                                                        <span class="time-dt">Rating
                                                                                            {{ $bids->user->rating }}</span>
                                                                                    </p>
                                                                                    <p
                                                                                        class="notification-text font-small-4 pt-1">
                                                                                        <span
                                                                                            class="time-dt">{{ $bids->user->badge->name }}</span>
                                                                                    </p>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end hover-->
                                                        </div>
                                                        <div class="ps-4 pt-3">
                                                            <a href="{{ route('profile.show', ['id' => $bids->user_id]) }}"
                                                                class="h3"
                                                                style="color: {{ $bids->user->role->color->name }}">
                                                                {{ $bids->user->username }}</p>
                                                                <a> <small>Bid on
                                                                        {{ $bids->created_at->diffForHumans() }}</small>
                                                                    </p>
                                                                    <p>{{ $bids->description }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex">
                                                    <span class="job-badge ddcolor">??? {{ $bids->price }}</span>

                                                    @if ($data->user_id == auth()->id() && $data->isAccept($data->id, $bids->id) == false)
                                                        @if ($data->isAccept($data->id) != true)
                                                            <span class="job-badge bg-success payNow"
                                                                data-id="{{ $bids->id }}"
                                                                data-amount="{{ $bids->price }}"
                                                                data-seller="{{$bids->user_id}}"
                                                                data-resource="proposals">
                                                                Take this offer
                                                            </span>
                                                        @endif
                                                    @else
                                                        <form method="POST"class="job-badge p-0"
                                                            action="{{ route('messages') }}">
                                                            @csrf
                                                            <input type="hidden" name="to_id"
                                                                value="{{ $data->user_id != auth()->id() ? $bids->user->id : $data->user_id }}">
                                                            <button type="submit"
                                                                class="apply_job_btn ps-4 view-btn btn-hover">Chat
                                                                Now</button>
                                                        </form>
                                                    @endif
                                                    <button class="btn">Reply</button>
                                                </div>
                                            </div>
                                            <hr>
                                        @empty
                                            <div class="bg-danger mt-4 p-4 rounded-lg mb-6 text-white text-center">
                                                Sorry No Bid Yet
                                            </div>
                                        @endforelse
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endif
                    <!--Solution-->
                    {{-- @if (auth()->id() == $data->user_id) --}}
                    @if (isset(
                        $data->propsolution()->orderBy('updated_at', 'DESC')->get()[0]->user_id))
                        @if (auth()->id() !=
                            $data->propsolution()->orderBy('updated_at', 'DESC')->get()[0]->user_id)
                            <div class="event-card mt-4">
                                <div class="jobdt99">
                                    <div class="jbdes25">
                                        <div class="jobtxt47">
                                            <h4>Solution</h4>
                                            @foreach ($data->propsolution()->orderBy('updated_at','DESC')->get() as $item)
                                                <div
                                                    class="d-sm-flex align-items-center rounded border-none mt-3 p-3  mb-4">
                                                    <div class="rounded-circle d-flex ">
                                                        <div class="userimg">
                                                            <img class="ft-plus-square job-bg-circle iconreq bg-cyan mr-0"
                                                                src="{{ $item->user->badge->image }}"
                                                                style="width:20px; height:20px"
                                                                title="{{ $item->user->badge->name }}">
                                                            <img src="/storage/{{ $item->user->image }}"
                                                                class="rounded-circle"
                                                                style="width: 50px;height: 50px;" alt=""
                                                                srcset="">
                                                            <div style="margin-top: 38px; position:absolute;display: inline-block;margin-left: -18px;"
                                                                class="@if (Cache::has('user-is-online-' . $item->user->id)) status-oncircle @else status-ofcircle @endif">
                                                            </div>
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
                                                                                            src="/storage/{{ $item->user->image }}"
                                                                                            alt="">
                                                                                        <div
                                                                                            class="@if (Cache::has('user-is-online-' . $item->user->id)) status-oncircle @else status-ofcircle @endif">
                                                                                        </div>
                                                                                    </a>
                                                                                </div>
                                                                                <div class="author-dts">
                                                                                    <p
                                                                                        class="notification-text font-username">
                                                                                        <a href="{{ route('profile.show', ['id' => $item->user_id]) }}"
                                                                                            style="color: {{ $item->user->role->color->name }}">{{ $item->user->username }}
                                                                                        </a><img
                                                                                            src="{{ $item->user->badge->image }}"
                                                                                            alt=""
                                                                                            style="width: 20px;"
                                                                                            title="{{ $item->user->badge->name }}">
                                                                                        <span class="job-loca"><i
                                                                                                class="fas fa-location-arrow"></i>{{ $item->user->uni_name }}</span>
                                                                                    </p>

                                                                                    <p
                                                                                        class="notification-text font-small-4 pt-1">
                                                                                        <span class="time-dt">Joined on
                                                                                            {{ $item->user->created_at->format('d:M:y g:i A') }}</span>
                                                                                    </p>
                                                                                    <span class="time-dt">Last Seen
                                                                                        @if (Cache::has('user-is-online-' . $item->user->id))
                                                                                            <span
                                                                                                class="text-success">Online</span>
                                                                                        @else
                                                                                            {{ Carbon\Carbon::parse($item->user->last_seen)->diffForHumans() }}
                                                                                        @endif
                                                                                    </span>
                                                                                    <p
                                                                                        class="notification-text font-small-4 pt-1">
                                                                                        <span class="time-dt">Total
                                                                                            Solutions
                                                                                            {{ $item->user->solutions }}</span>
                                                                                    </p>
                                                                                    <p
                                                                                        class="notification-text font-small-4 pt-1">
                                                                                        <span class="time-dt">Rating
                                                                                            {{ $item->user->rating }}</span>
                                                                                    </p>
                                                                                    <p
                                                                                        class="notification-text font-small-4 pt-1">
                                                                                        <span
                                                                                            class="time-dt">{{ $item->user->badge->name }}</span>
                                                                                    </p>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end hover-->
                                                        </div>
                                                        <div class="ps-4 pt-0">
                                                            <a href="{{ route('profile.show', ['id' => $item->user_id]) }}"
                                                                class="h2"
                                                                style="color: {{ $item->user->role->color->name }}">{{ $item->user->username }}</a>
                                                            <p> <small>Created on
                                                                    {{ $item->created_at->diffForHumans() }}</small>
                                                            </p>
                                                            <p>{{ $item->description }}</p>
                                                            <div class="jobtxt47">
                                                                <a href="{{ $data->istTakeSolution($data->id) ? $item->file : 'javascript:void(0)' }}"
                                                                    download title="{!! $data->istTakeSolution($data->id) ? 'Download' : 'Please pay first to download the solution' !!}"
                                                                    data-id="{{ $data->paymentLog($data->id)->request_id }}"
                                                                    data-amount="{{ $data->paymentLog($data->id)->amount }}"
                                                                    data-resource="proposals" class="payNow">Download
                                                                    File from here {!! $data->istTakeSolution($data->id) == false ? ' <i class="fas fa-lock"></i>' : '' !!}</a>
                                                            </div>
                                                            @if ($data->propsolreport()->count() > 0 && $data->propsolreport->propsolution_id == $item->id)
                                                                <span class="text-danger">Reported</span>
                                                            @else
                                                                <a href="{{ route('proposal.reppropsol', ['uid' => $item->user_id, 'rid' => $item->proposal_id, 'sid' => $item->id]) }}"
                                                                    class="label-dker post_categories_reported mr-10"><span>Report</span></a>
                                                            @endif
                                                            <a href=""
                                                                class="label-dker post_categories_top_right mr-20"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#review"><span>Review</span></a>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                    <!--file-->
                    @if (!$data->file == '')
                        <div class="event-card mt-4">
                            <div class="jobdt99">
                                <div class="jbdes25">
                                    <div class="jobtxt47">
                                        <h4>Download file from here</h4>
                                        <hr>
                                        <a href="{{ $data->file }}" download>Download here</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endif
                    <!--description-->
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

                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="full-width mt-4">
                        <div class="user-profile">
                            <div class="username-dt dpbg-1">
                                <div class="usr-pic">
                                    <div style="margin-top: 10px; width:15px; height: 15px; margin-left:5px"
                                        class="@if (Cache::has('user-is-online-' . $data->user->id)) status-oncircle @else status-ofcircle @endif">
                                    </div>
                                    <img src="/storage/{{ $data->user->image }}" alt=""
                                        style="width: 80px; height:80px">

                                </div>
                            </div>
                            <div class="username-main-dt">
                                <a href="{{ route('profile.show', ['id' => $data->user_id]) }}" class="h4"
                                    style="color: {{ $data->user->role->color->name }}">{{ $data->user->username }}</a>
                            </div>
                            <div class="user-info__sections">
                                <ul class="info__sections">
                                    <li>
                                        <div class="all-info__sections">
                                            <span class="all-info__left">Post Proposal</span>
                                            <span class="all-info__right">{{ $data->user->proposal->count() }}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="all-info__sections">
                                            <span class="all-info__left">Products</span>
                                            <span
                                                class="all-info__right">{{ $data->user->product->count() + $data->user->book->count() }}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="all-info__sections">
                                            <span class="all-info__left">Courses</span>
                                            <span class="all-info__right">{{ $data->user->course->count() }}</span>
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

<!--Bid Model-->
<div class="modal fade" id="addproposalbid" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Proposal Bid</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container bg-white rounded">
                    <!--bid Form-->
                    <form class="form p-3" method="POST" id="probid" action="{{ route('proposalbid.store') }}">
                        @csrf
                        <input type="hidden" name="proposal_user" value="{{ $data->user_id }}">
                        <input type="hidden" name="proposal_id" value="{{ $data->id }}">
                        <div class="form-group">
                            <label for="price">Enter Your Amount</label>
                            <input type="number" class="form-control" name="price" id="price"
                                placeholder="???" value="{{ old('price') }}">
                            <div class="text-danger mt-2 text-sm priceError"></div>
                        </div>
                        <div class="form-group pt-2 pb-2">
                            <label for="days">In how much days you'll done it</label>
                            <input type="number" class="form-control" name="days" id="days"
                                placeholder="No of days" value="{{ old('days') }}">
                            <div class="text-danger mt-2 text-sm daysError"></div>
                        </div>
                        <div class="form-group pt-2">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"> {{ old('description') }}</textarea>
                            <div class="text-danger mt-2 text-sm descriptionError"></div>
                        </div>
                        <input type="submit" class="view-btn btn-hover mt-2" name="submit" value="Submit">
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!--solution Model-->
<div class="modal fade" id="addsolution" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Proposal Solution</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container bg-white rounded">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!--sol Form-->
                    <form class="form p-3 form-prevent-mul" method="POST" id="propsol"
                        action="{{ route('prosolution.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="proposal_user" value="{{ $data->user_id }}">
                        <input type="hidden" name="proposal_id" value="{{ $data->id }}">
                        <input type="hidden" name="user_id" value="{{ Auth()->id() }}" required>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"> {{ old('description') }}</textarea>
                            <div class="text-danger mt-2 text-sm descriptioneror"></div>
                        </div>
                        <div class="form-group">
                            <label for="file">File/Image</label>
                            <input type="file" class="form-control" id="file"
                                accept="image/*,.doc,.docx,.pdf,.pptx" name="file" value=" {{ old('file') }}">
                            <div class="text-danger mt-2 text-sm fileeror"></div>
                        </div>
                        <button type="submit" class="apply_job_btn ps-4 view-btn btn-hover btn-prevent-mul mt-3"
                            name="submit"> submit</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<!--Review Model-->
<div class="modal fade" id="review" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Request Solution</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container bg-white rounded">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!--Review Form-->
                    <form method="POST" id="rev" action="{{ route('propreview.store') }}">
                        @csrf
                        <input type="hidden" name="proposal_id" value="{{ $data->id }}">
                        @if ($data->propsolution()->count() >= 1)
                            <input type="hidden" name="tp_user_id" value="{{ $data->propsolution->user_id }}">
                        @endif
                        <div class="mt-30">
                            <div class="rating-container">
                                <div class="rating-text">
                                    <p>How satisfied are you with This User?</p>
                                </div>
                                <div class="rating">
                                    <div class="rating-form">
                                        <label for="super-sad" data-toggle="tooltip" data-placement="bottom"
                                            title="Super Sad">
                                            <input type="radio" name="rating" class="super-sad" id="super-sad"
                                                value="1">
                                            <svg viewBox="0 0 24 24">
                                                <path
                                                    d="M12,2C6.47,2 2,6.47 2,12C2,17.53 6.47,22 12,22A10,10 0 0,0 22,12C22,6.47 17.5,2 12,2M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20M16.18,7.76L15.12,8.82L14.06,7.76L13,8.82L14.06,9.88L13,10.94L14.06,12L15.12,10.94L16.18,12L17.24,10.94L16.18,9.88L17.24,8.82L16.18,7.76M7.82,12L8.88,10.94L9.94,12L11,10.94L9.94,9.88L11,8.82L9.94,7.76L8.88,8.82L7.82,7.76L6.76,8.82L7.82,9.88L6.76,10.94L7.82,12M12,14C9.67,14 7.69,15.46 6.89,17.5H17.11C16.31,15.46 14.33,14 12,14Z" />
                                            </svg>
                                        </label>
                                        <label for="sad" data-toggle="tooltip" data-placement="bottom"
                                            title="Sad">
                                            <input type="radio" name="rating" class="sad" id="sad"
                                                value="2">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                width="100%" height="100%" viewBox="0 0 24 24">
                                                <path
                                                    d="M20,12A8,8 0 0,0 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12M22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2A10,10 0 0,1 22,12M15.5,8C16.3,8 17,8.7 17,9.5C17,10.3 16.3,11 15.5,11C14.7,11 14,10.3 14,9.5C14,8.7 14.7,8 15.5,8M10,9.5C10,10.3 9.3,11 8.5,11C7.7,11 7,10.3 7,9.5C7,8.7 7.7,8 8.5,8C9.3,8 10,8.7 10,9.5M12,14C13.75,14 15.29,14.72 16.19,15.81L14.77,17.23C14.32,16.5 13.25,16 12,16C10.75,16 9.68,16.5 9.23,17.23L7.81,15.81C8.71,14.72 10.25,14 12,14Z" />
                                            </svg>
                                        </label>
                                        <label for="neutral" data-toggle="tooltip" data-placement="bottom"
                                            title="Neutral">
                                            <input type="radio" name="rating" class="neutral" id="neutral"
                                                value="3">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                width="100%" height="100%" viewBox="0 0 24 24">
                                                <path
                                                    d="M8.5,11A1.5,1.5 0 0,1 7,9.5A1.5,1.5 0 0,1 8.5,8A1.5,1.5 0 0,1 10,9.5A1.5,1.5 0 0,1 8.5,11M15.5,11A1.5,1.5 0 0,1 14,9.5A1.5,1.5 0 0,1 15.5,8A1.5,1.5 0 0,1 17,9.5A1.5,1.5 0 0,1 15.5,11M12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22C6.47,22 2,17.5 2,12A10,10 0 0,1 12,2M9,14H15A1,1 0 0,1 16,15A1,1 0 0,1 15,16H9A1,1 0 0,1 8,15A1,1 0 0,1 9,14Z" />
                                            </svg>
                                        </label>
                                        <label for="happy" data-toggle="tooltip" data-placement="bottom"
                                            title="Happy">
                                            <input type="radio" name="rating" class="happy" id="happy"
                                                value="4">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                width="100%" height="100%" viewBox="0 0 24 24">
                                                <path
                                                    d="M20,12A8,8 0 0,0 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12M22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2A10,10 0 0,1 22,12M10,9.5C10,10.3 9.3,11 8.5,11C7.7,11 7,10.3 7,9.5C7,8.7 7.7,8 8.5,8C9.3,8 10,8.7 10,9.5M17,9.5C17,10.3 16.3,11 15.5,11C14.7,11 14,10.3 14,9.5C14,8.7 14.7,8 15.5,8C16.3,8 17,8.7 17,9.5M12,17.23C10.25,17.23 8.71,16.5 7.81,15.42L9.23,14C9.68,14.72 10.75,15.23 12,15.23C13.25,15.23 14.32,14.72 14.77,14L16.19,15.42C15.29,16.5 13.75,17.23 12,17.23Z" />
                                            </svg>
                                        </label>
                                        <label for="super-happy" data-toggle="tooltip" data-placement="bottom"
                                            title="Super Happy">
                                            <input type="radio" name="rating" class="super-happy"
                                                id="super-happy" value="5">
                                            <svg viewBox="0 0 24 24">
                                                <path
                                                    d="M12,17.5C14.33,17.5 16.3,16.04 17.11,14H6.89C7.69,16.04 9.67,17.5 12,17.5M8.5,11A1.5,1.5 0 0,0 10,9.5A1.5,1.5 0 0,0 8.5,8A1.5,1.5 0 0,0 7,9.5A1.5,1.5 0 0,0 8.5,11M15.5,11A1.5,1.5 0 0,0 17,9.5A1.5,1.5 0 0,0 15.5,8A1.5,1.5 0 0,0 14,9.5A1.5,1.5 0 0,0 15.5,11M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20M12,2C6.47,2 2,6.5 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                                            </svg>
                                        </label>
                                    </div>

                                </div>
                            </div>
                            <div class="text-danger mt-2 text-sm ratingerror"></div>
                        </div>
                        <div class="form_group mt-30">
                            <label class="label25">What do you like most?*</label>
                            <textarea class="form_textarea_1 bg-light" name="description" placeholder=""></textarea>
                            <div class="text-danger mt-2 text-sm revdescription"></div>
                        </div>

                        <div class="submit_btn mb-4 mt-3">
                            <button type="submit" class="main-btn color btn-hover" data-ripple="">Send
                                Review</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<input type="hidden" class="reqId" value="{{ $data->id }}" />

<!--footer-->
@include('layouts.footer')
<!---/footer-->
<script src="{{ asset('asset/js/bkashpayment.js') }}"></script>
<link rel="stylesheet" href="{{ asset('asset/css/paymentBkash.css') }}">
<!--proposal Bid model script-->
<script>
    const probidform = $('form#probid');
    probidform.on('submit', (e) => {
        e.preventDefault();

        $('.priceError').text('');
        $('.daysError').text('');
        $('.descriptionError').text('');

        const formprobid = document.getElementById('probid');
        const formData = new FormData(formprobid);
        const action = $(e.currentTarget).attr('action');
        formData.append('_token', '{{ csrf_token() }}');
        $.ajax({
            url: action,
            method: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                location.href = location.href;
            },
            error: function(error) {
                const errorResponse = error.responseJSON.errors;
                if (errorResponse.price) {
                    $('.priceError').text(errorResponse.price[0]);
                }
                if (errorResponse.days) {
                    $('.daysError').text(errorResponse.days[0]);
                }
                if (errorResponse.description) {
                    $('.descriptionError').text(errorResponse.description[0]);
                }

            }
        })
    })
</script>
<!--Proposal solution model script-->
<script>
    const propsolform = $('form#propsol');
    propsolform.on('submit', (e) => {
        e.preventDefault();

        $('.fileeror').text('');
        $('.descriptioneror').text('');

        const formprosolbid = document.getElementById('propsol');
        const formData = new FormData(formprosolbid);
        const action = $(e.currentTarget).attr('action');
        formData.append('_token', '{{ csrf_token() }}');
        $.ajax({
            url: action,
            method: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                location.href = location.href;
            },
            error: function(error) {
                const errorResponse = error.responseJSON.errors;
                if (errorResponse.file) {
                    $('.fileeror').text(errorResponse.file[0]);
                }
                if (errorResponse.description) {
                    $('.descriptioneror').text(errorResponse.description[0]);
                }

            }
        });
    });
</script>
<!--Review model script-->
<script>
    const reviewform = $('form#rev');
    reviewform.on('submit', (e) => {
        e.preventDefault();

        $('.ratingerror').text('');
        $('.revdescription').text('');

        const formrev = document.getElementById('rev');
        const formData = new FormData(formrev);
        const action = $(e.currentTarget).attr('action');
        formData.append('_token', '{{ csrf_token() }}');
        $.ajax({
            url: action,
            method: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                location.href = location.href;
            },
            error: function(error) {
                const errorResponse = error.responseJSON.errors;
                if (errorResponse.rating) {
                    $('.ratingerror').text(errorResponse.rating[0]);
                }
                if (errorResponse.description) {
                    $('.revdescription').text(errorResponse.description[0]);
                }

            }
        });
    });
</script>
