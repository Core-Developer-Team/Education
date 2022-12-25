@section('title', 'feedback')
@include('layouts.header')
<header class="header clearfix">
    <div class="header-inner">
        <!--Top Menu-->
        @include('layouts.menu')
        <!--/Top Menu-->
        <div class="overlay"></div>
    </div>
</header>

<div class="wrapper">
    <div class="container">
        <div class="row">
            <!--side bar-->
            <aside class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-12 col-sm-12 col-12">
                <div class="full-width mt-10">

                    @include('layouts.sidebar')
                    <div class="full-width mt-5">

                        <div class="manage-section mt-3">
                            <span class="manage-title">Today's Activity</span>
                        </div>
                        <ul class="info__sections">
                            <li>
                                <a class="all-info__sections">
                                    <span class="all-info__left"><i class="feather-grid me-2"></i>Request</span>
                                    <span class="all-info__right">{{ $t_req_count }}</span>
                                </a>
                            </li>
                            <li>
                                <a class="all-info__sections">
                                    <span class="all-info__left"><i class="feather-grid me-2"></i>Proposal</span>
                                    <span class="all-info__right">{{ $t_prop_count }}</span>
                                </a>
                            </li>

                            <li>
                                <a class="all-info__sections">
                                    <span class="all-info__left"><i class="feather-download me-2"></i>Request
                                        Solution</span>
                                    <span class="all-info__right">{{ $t_reqsolution_count }}</span>
                                </a>
                            </li>
                            <li>
                                <a class="all-info__sections">
                                    <span class="all-info__left"><i class="feather-download me-2"></i>Proposal
                                        Solution</span>
                                    <span class="all-info__right">{{ $t_propsolution_count }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>

            </aside>
            <!--/side bar-->
            <main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">

                @if (session()->has('status'))
                <div class="alert alert-success mt-3">
                    {{ session()->get('status') }}
                </div>
                @endif
                @if (auth()->user()->block != 1 )
                <div class="full-width mt-4 mb-4">
                    @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-success mt-3">
                        {{ $error }}
                    </div>
                    @endforeach
                    @endif
                    <div class="new-refund-request-card main-form  @foreach ($datas as $data) @if ($data->user_id == Auth()->id()) d-none @endif @endforeach ">
                        <form method="POST" class="" action="{{ route('feedback.store') }}">
                            @csrf
                            <div class="mt-30">
                                <div class="rating-container">
                                    <div class="rating-text">
                                        <p>How satisfied are you with US?</p>
                                    </div>
                                    <div class="rating">
                                        <div class="rating-form">
                                            <label for="super-sad" data-toggle="tooltip" data-placement="bottom" title="Super Sad">
                                                <input type="radio" name="rating" class="super-sad" id="super-sad" value="1">
                                                <svg viewBox="0 0 24 24">
                                                    <path d="M12,2C6.47,2 2,6.47 2,12C2,17.53 6.47,22 12,22A10,10 0 0,0 22,12C22,6.47 17.5,2 12,2M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20M16.18,7.76L15.12,8.82L14.06,7.76L13,8.82L14.06,9.88L13,10.94L14.06,12L15.12,10.94L16.18,12L17.24,10.94L16.18,9.88L17.24,8.82L16.18,7.76M7.82,12L8.88,10.94L9.94,12L11,10.94L9.94,9.88L11,8.82L9.94,7.76L8.88,8.82L7.82,7.76L6.76,8.82L7.82,9.88L6.76,10.94L7.82,12M12,14C9.67,14 7.69,15.46 6.89,17.5H17.11C16.31,15.46 14.33,14 12,14Z" />
                                                </svg>
                                            </label>
                                            <label for="sad" data-toggle="tooltip" data-placement="bottom" title="Sad">
                                                <input type="radio" name="rating" class="sad" id="sad" value="2">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="100%" height="100%" viewBox="0 0 24 24">
                                                    <path d="M20,12A8,8 0 0,0 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12M22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2A10,10 0 0,1 22,12M15.5,8C16.3,8 17,8.7 17,9.5C17,10.3 16.3,11 15.5,11C14.7,11 14,10.3 14,9.5C14,8.7 14.7,8 15.5,8M10,9.5C10,10.3 9.3,11 8.5,11C7.7,11 7,10.3 7,9.5C7,8.7 7.7,8 8.5,8C9.3,8 10,8.7 10,9.5M12,14C13.75,14 15.29,14.72 16.19,15.81L14.77,17.23C14.32,16.5 13.25,16 12,16C10.75,16 9.68,16.5 9.23,17.23L7.81,15.81C8.71,14.72 10.25,14 12,14Z" />
                                                </svg>
                                            </label>
                                            <label for="neutral" data-toggle="tooltip" data-placement="bottom" title="Neutral">
                                                <input type="radio" name="rating" class="neutral" id="neutral" value="3">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="100%" height="100%" viewBox="0 0 24 24">
                                                    <path d="M8.5,11A1.5,1.5 0 0,1 7,9.5A1.5,1.5 0 0,1 8.5,8A1.5,1.5 0 0,1 10,9.5A1.5,1.5 0 0,1 8.5,11M15.5,11A1.5,1.5 0 0,1 14,9.5A1.5,1.5 0 0,1 15.5,8A1.5,1.5 0 0,1 17,9.5A1.5,1.5 0 0,1 15.5,11M12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22C6.47,22 2,17.5 2,12A10,10 0 0,1 12,2M9,14H15A1,1 0 0,1 16,15A1,1 0 0,1 15,16H9A1,1 0 0,1 8,15A1,1 0 0,1 9,14Z" />
                                                </svg>
                                            </label>
                                            <label for="happy" data-toggle="tooltip" data-placement="bottom" title="Happy">
                                                <input type="radio" name="rating" class="happy" id="happy" value="4">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="100%" height="100%" viewBox="0 0 24 24">
                                                    <path d="M20,12A8,8 0 0,0 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12M22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2A10,10 0 0,1 22,12M10,9.5C10,10.3 9.3,11 8.5,11C7.7,11 7,10.3 7,9.5C7,8.7 7.7,8 8.5,8C9.3,8 10,8.7 10,9.5M17,9.5C17,10.3 16.3,11 15.5,11C14.7,11 14,10.3 14,9.5C14,8.7 14.7,8 15.5,8C16.3,8 17,8.7 17,9.5M12,17.23C10.25,17.23 8.71,16.5 7.81,15.42L9.23,14C9.68,14.72 10.75,15.23 12,15.23C13.25,15.23 14.32,14.72 14.77,14L16.19,15.42C15.29,16.5 13.75,17.23 12,17.23Z" />
                                                </svg>
                                            </label>
                                            <label for="super-happy" data-toggle="tooltip" data-placement="bottom" title="Super Happy">
                                                <input type="radio" name="rating" class="super-happy" id="super-happy" value="5">
                                                <svg viewBox="0 0 24 24">
                                                    <path d="M12,17.5C14.33,17.5 16.3,16.04 17.11,14H6.89C7.69,16.04 9.67,17.5 12,17.5M8.5,11A1.5,1.5 0 0,0 10,9.5A1.5,1.5 0 0,0 8.5,8A1.5,1.5 0 0,0 7,9.5A1.5,1.5 0 0,0 8.5,11M15.5,11A1.5,1.5 0 0,0 17,9.5A1.5,1.5 0 0,0 15.5,8A1.5,1.5 0 0,0 14,9.5A1.5,1.5 0 0,0 15.5,11M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20M12,2C6.47,2 2,6.5 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                                                </svg>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form_group mt-30">
                                <label class="label25">What do you like most?* <small class="text-info">max 300 chars</small></label>
                                <textarea class="form_textarea_1 bg-light" name="description" placeholder=""></textarea>
                            </div>

                            <div class="submit_btn">
                                <button type="submit" class="main-btn color btn-hover" data-ripple="">Send
                                    Feedback</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif

                <div class="full-width mt-4">
                    <div class="new-refund-request-card main-form">
                        <div class="mt-30">
                            <div class="rating-container">
                                <div class="rating-text">
                                    <p>Feedbacks( <span class="text-info"> {{$rating}}</span> )</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            @forelse ($datas as $item)
                            <div class="col-6">
                                <div class="review-card mt-4">
                                    <div class="review-content">
                                        <div class="review-head">
                                            <div class="review-rating-stars">
                                                @if ($item->rating == 1)
                                                <div class="item-rating-stars">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="feather-star color-gray-medium"></i>
                                                    <i class="feather-star color-gray-medium"></i>
                                                    <i class="feather-star color-gray-medium"></i>
                                                    <i class="feather-star color-gray-medium"></i>
                                                </div>
                                                @elseif ($item->rating == 2)
                                                <div class="item-rating-stars">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="feather-star color-gray-medium"></i>
                                                    <i class="feather-star color-gray-medium"></i>
                                                    <i class="feather-star color-gray-medium"></i>
                                                </div>
                                                @elseif ($item->rating == 3)
                                                <div class="item-rating-stars">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>

                                                    <i class="feather-star color-gray-medium"></i>
                                                    <i class="feather-star color-gray-medium"></i>
                                                </div>
                                                @elseif ($item->rating == 4)
                                                <div class="item-rating-stars">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="feather-star color-gray-medium"></i>
                                                </div>
                                                @elseif ($item->rating == 5)
                                                <div class="item-rating-stars">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>
                                                @endif
                                            </div>
                                            <span class="rating-time-posting"><i class="feather-clock me-2"></i>{{ $item->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="rating-by">
                                            by:

                                            <div class="ttlcnt15 invtbyuser ms-2">
                                                <div class="invited_avtar_ee userimg">
                                                    <img class="ft-plus-square evnt-invite-circle bg-cyan me-0" src="/storage/{{ $item->user->image }}" alt="">

                                                    <!--hover on image-->
                                                    <div class="box imagehov shadow" style="width: auto; height:auto;  position: absolute; z-index: 1;">
                                                        <div class="full-width">
                                                            <div class="recent-items">
                                                                <div class="posts-list">
                                                                    <div class="feed-shared-author-dt">
                                                                        <div class="author-left">
                                                                            <img class="ft-plus-square job-bg-circle bg-cyan" src="/storage/{{ $item->user->image }}" alt="">
                                                                            <div class="@if (Cache::has('user-is-online-' . $item->user->id)) status-oncircle @else status-ofcircle @endif">
                                                                            </div>
                                                                        </div>

                                                                        <div class="author-dts">
                                                                            <p class="notification-text font-username">
                                                                                <a href="{{ route('profile.show', ['id' => $item->user_id]) }}" style="color: {{ $item->user->role->color->name }}">{{ $item->user->username }}
                                                                                </a><img src="{{ $item->user->badge->image }}" alt="" style="width: 20px;" title="{{ $item->user->badge->name }}">
                                                                                <span class="job-loca"><i class="fas fa-location-arrow"></i>{{ $item->user->uni_name }}</span>
                                                                            </p>

                                                                            <p class="notification-text font-small-4 pt-1">
                                                                                <span class="time-dt">Joined on
                                                                                    {{ $item->user->created_at->format('d:M:y g:i A') }}</span>
                                                                            </p>
                                                                            <p class="notification-text font-small-4 pt-1">
                                                                                <span class="time-dt">Last Seen
                                                                                    @if (Cache::has('user-is-online-' . $item->user->id))
                                                                                    <span class="text-success">Online</span>
                                                                                    @else
                                                                                    {{ Carbon\Carbon::parse($item->user->last_seen)->diffForHumans() }}
                                                                                    @endif
                                                                                </span>
                                                                            </p>
                                                                            <p class="notification-text font-small-4 pt-1">
                                                                                <span class="time-dt">Total
                                                                                    Solutions
                                                                                    {{ $item->user->solutions }}</span>
                                                                            </p>
                                                                            <p class="notification-text font-small-4 pt-1">
                                                                                <span class="time-dt">Rating
                                                                                    {{ $item->user->rating }}</span>
                                                                            </p>
                                                                            <p class="notification-text font-small-4 pt-1">
                                                                                <span class="time-dt">{{ $item->user->badge->name }}</span>
                                                                            </p>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end hover-->
                                                </div>
                                                <div class="iconreq">
                                                    <img class="ft-plus-square job-bg-circle bg-cyan mr-0"
                                                        src="{{ $item->user->badge->image }}" style="width:10px; height:10px"
                                                        title="{{ $item->user->badge->name }}">
                                                </div>
                                                <span class="evntcunt userimg" style="color: {{ $item->user->role->color->name }}">{{ $item->user->username }}
                                                    <!--hover on image-->
                                                    <div class="box imagehov shadow" style="width: auto; height:auto;  position: absolute; z-index: 1;">
                                                        <div class="full-width">
                                                            <div class="recent-items">
                                                                <div class="posts-list">
                                                                    <div class="feed-shared-author-dt">
                                                                        <div class="author-left">
                                                                            <img class="ft-plus-square job-bg-circle bg-cyan" src="/storage/{{ $item->user->image }}" alt="">
                                                                            <div class="@if (Cache::has('user-is-online-' . $item->user->id)) status-oncircle @else status-ofcircle @endif">
                                                                            </div>
                                                                        </div>

                                                                        <div class="author-dts">
                                                                            <p class="notification-text font-username">
                                                                                <a href="{{ route('profile.show', ['id' => $item->user_id]) }}" style="color: {{ $item->user->role->color->name }}">{{ $item->user->username }}
                                                                                </a><img src="{{ $item->user->badge->image }}" alt="" style="width: 20px;" title="{{ $item->user->badge->name }}">
                                                                                <span class="job-loca"><i class="fas fa-location-arrow"></i>{{ $item->user->uni_name }}</span>
                                                                            </p>

                                                                            <p class="notification-text font-small-4 pt-1">
                                                                                <span class="time-dt">Joined on
                                                                                    {{ $item->user->created_at->format('d:M:y g:i A') }}</span>
                                                                            </p>
                                                                            <p class="notification-text font-small-4 pt-1">
                                                                                <span class="time-dt">Last Seen
                                                                                    @if (Cache::has('user-is-online-' . $item->user->id))
                                                                                    <span class="text-success">Online</span>
                                                                                    @else
                                                                                    {{ Carbon\Carbon::parse($item->user->last_seen)->diffForHumans() }}
                                                                                    @endif
                                                                                </span>
                                                                            </p>
                                                                            <p class="notification-text font-small-4 pt-1">
                                                                                <span class="time-dt">Total
                                                                                    Solutions
                                                                                    {{ $item->user->solutions }}</span>
                                                                            </p>
                                                                            <p class="notification-text font-small-4 pt-1">
                                                                                <span class="time-dt">Rating
                                                                                    {{ $item->user->rating }}</span>
                                                                            </p>
                                                                            <p class="notification-text font-small-4 pt-1">
                                                                                <span class="time-dt">{{ $item->user->badge->name }}</span>
                                                                            </p>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end hover-->
                                                </span>
                                            </div>

                                        </div>
                                        <div class="rating_descp">
                                            <p>{{ $item->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            @endforelse
                            <div class="mt-3">
                                {{ $datas->links() }}
                            </div>
                        </div>
                    </div>
                </div>

            </main>

        </div>
    </div>
</div>
</div>

<!--footer-->
@include('layouts.footer')
<!---/footer-->
