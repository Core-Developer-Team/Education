@section('title', 'home')
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
            <div class="owl-carousel evtcate_slider">
                @foreach ($categ as $cat)
                    <div class="item text-center">
                        <a href="{{ route('req.searchcat', ['name' => $cat->coursename]) }}" class="event-cate-links">
                            <div class="event-full-width">
                                <div class="event-cate-items">
                                    <h6>{{ $cat->coursename }}</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
            <!--side bar-->
            <aside class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-12 col-sm-12 col-12">
                <div class="full-width mt-10">
                    <div class="btn_1589">
                        <a href="" class="post-link-btn btn-hover" data-bs-toggle="modal"
                            data-bs-target=" @auth
#addrequest
@else
#loginlink @endauth ">Post
                            your problem</a>
                    </div>
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
                <div class="pl_item_search rrmt-30">
                    <form action="{{ route('req.search') }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-lg-10 col-md-8">
                                <div class="form_group">
                                    <input class="form_input_1" type="text" id="search"
                                        placeholder="Search within these results" name="search" required>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <button class="post-link-btn color btn-hover w-100 rmt-10"
                                    type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="filter_items">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="filter-section">
                                <div class="btn-4585">
                                    <a href="{{ route('request.latest') }}"
                                        class="fltr-btn @if (request()->getpathinfo() == '/latestreq' || request()->getpathinfo() == '/') fltr-active @endif">Newest</a>
                                    <a href="{{ route('request.trending') }}"
                                        class="fltr-btn @if (request()->getpathinfo() == '/trendingreq') fltr-active @endif">Trending</a>
                                    <a href="{{ route('req.weekly') }}"
                                        class="fltr-btn @if (request()->getpathinfo() == '/week') fltr-active @endif">Weekly</a>
                                </div>
                                <button class="flter-btn2 pull-bs-canvas-left">Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success mt-3">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if (session()->has('requpstatus'))
                    <div class="alert alert-success mt-3">
                        {{ session()->get('requpstatus') }}
                    </div>
                @endif
                @if (session()->has('reqstatus'))
                    <div class="alert alert-success mt-3">
                        {{ session()->get('reqstatus') }}
                    </div>
                @endif
                @forelse ($datas as $data)
                    <div class="full-width mt-4">
                        <div class="recent-items">
                            <div class="posts-list">
                                <div class="feed-shared-author-dt">
                                    <div class="author-left userimg">
                                        <img class="ft-plus-square job-bg-circle  bg-cyan mr-0"
                                            src="/storage/{{ $data->user->image }}" alt="">
                                        <div style="position: relative;margin-top: -10px;margin-left: 10px;"
                                            class="presence-entity__badge @if (Cache::has('user-is-online-' . $data->user_id)) badge__online @else badge__offline @endif">
                                            <span class="visually-hidden">
                                                Status is online
                                            </span>
                                        </div>
                                        <!--hover on image-->
                                        <div class="box imagehov shadow"
                                            style="width: auto; height:auto;  position: absolute; z-index: 1;">
                                            <div class="full-width">
                                                <div class="recent-items">
                                                    <div class="posts-list">
                                                        <div class="feed-shared-author-dt">
                                                            <div class="author-left">
                                                                <img class="ft-plus-square job-bg-circle bg-cyan"
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
                                    <div class="iconreq">
                                        <img class="ft-plus-square job-bg-circle bg-cyan mr-0"
                                            src="{{ $data->user->badge->image }}" style="width:20px; height:20px"
                                            title="{{ $data->user->badge->name }}">
                                    </div>
                                    <div class="author-dts">
                                        <a href="{{ route('req.showsingle', ['id' => $data->id]) }}"
                                            class="problems_title">{{ $data->requestname }}</a>
                                        <p class="notification-text font-username">
                                        <div class="userimg">
                                            <a href="{{ route('profile.show', ['id' => $data->user_id]) }}"
                                                class=""
                                                style="color: {{ $data->user->role->color->name }}">{{ $data->user->username }}
                                                &nbsp;
                                            </a>
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
                                        <img src="@if ($data->user->badge_id == 5 || $data->user->status==1) /storage/badges/verified.svg @endif"
                                            class="@if ($data->user->badge_id == 5 || $data->user->status==1) @else d-none @endif "
                                            alt="Verified" style="width: 17px;" title="Verified">
                                        <span class="job-loca"><i
                                                class="fas fa-location-arrow"></i>{{ $data->user->uni_name }}</span>
                                        </p>
                                        <span>{{ Str::limit($data->description, 150, $end = '.........') }} </span>
                                        <p class="notification-text font-small-4 pt-1">
                                            <span class="time-dt">{{ $data->created_at->diffForHumans() }}</span>
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
                                                <span class="job-badge ddcolor">৳ {{ $data->price }} </span>
                                                <span class="job-badge ttcolor">
                                                    @if (\Carbon\Carbon::parse($data->created_at)->diffInDays($data->days, false) <= 1)
                                                        @if (\Carbon\Carbon::parse($data->created_at)->diffInMinutes($data->days, false) < 60 &&
                                                            \Carbon\Carbon::parse($data->created_at)->diffInMinutes($data->days, false) >= 1)
                                                            {{ \Carbon\Carbon::parse($data->created_at)->diffInMinutes($data->days, false) }}
                                                            Minutes left
                                                        @elseif(\Carbon\Carbon::parse($data->created_at)->diffInMinutes($data->days, false) < 0)
                                                            @if ($data->reqsolution()->count() >= 1 && $data->reqsolution->request_id == $data->id)
                                                                Closed
                                                            @else
                                                                Unsolved
                                                            @endif
                                                        @else
                                                            {{ \Carbon\Carbon::parse($data->created_at)->diffInHours($data->days, false) }}
                                                            Hours left
                                                        @endif
                                                    @else
                                                        {{ \Carbon\Carbon::parse($data->created_at)->diffInDays($data->days, false) }}
                                                        days left
                                                    @endif
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="ellipsis-options post-ellipsis-options dropdown dropdown-account">
                                        <a href=""
                                            class="label-dker post_categories_reported mr-10 @if ($data->reqsolutionreport()->count() > 0 && $data->reqsolutionreport->request_id == $data->id) @else d-none @endif"><span
                                                class="label-dker post_categories_reported mr-10">Reported</span></a>
                                        <a href="" class="label-dker post_department_top_right mr-10 px-2"><span>
                                                @if ($data->user->department == 0)
                                                    bba
                                                @elseif($data->user->department == 1)
                                                    bse
                                                @elseif ($data->user->department == 2)
                                                    bcs
                                                @endif
                                            </span></a>
                                        <a href=""
                                            class="label-dker post_categories_top_right mr-20 ms-2"><span>{{ $data->coursename }}</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="post-meta">
                                <div class="job-actions">
                                    <div class="aplcnts_15">
                                        <i
                                            class="feather-users mr-2"></i><span>Applied</span><ins>{{ $data->reqbid->count() }}</ins>
                                        <i class="feather-eye mr-2"></i><span>Views</span><ins>{{ $data->view_count }}
                                        </ins>
                                    </div>
                                    <div class="action-btns-job d-flex justify-content-space">
                                        <a href="{{ route('req.showsingle', ['id' => $data->id]) }}"
                                            class="view-btn btn-hover">View Job</a>
                                        @if ($data->user_id == Auth()->id())
                                            <div class="@if ($data->reqsolution()->count() >= 1 && $data->reqsolution->request_id == $data->id) d-none @endif">
                                                <a href="{{ route('req.show', ['id' => $data->id]) }}" title="Edit"
                                                    class="px-3">
                                                    <button type="button" class="bm-btn btn-hover">
                                                        <i class="feather-edit"></i>
                                                    </button>
                                                </a>
                                                <button class="bm-btn btn-hover delete-confirm" data-bs-toggle="modal"
                                                    data-bs-target="#delreq" data-id="{{ $data->id }}"><i
                                                        class="fa-solid fa-trash-can"></i>
                                                </button>

                                            </div>
                                        @endif

                                        @isset($bid)
                                            @foreach ($bid as $item)
                                                @if ($item->request_id == $data->id && $item->status == 1)
                                                    <a href="#" title="Solved"
                                                        class="bm-btn bm-btn-hover-solve  ms-2 active"><i
                                                            class="fas fa-check"></i></a>
                                                @endif
                                            @endforeach
                                        @endisset

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-success mt-3">
                        Sorry! No data found
                    </div>

                @endforelse
                <div class="mt-3">
                    {{ $datas->links() }}
                </div>

            </main>

        </div>
    </div>
</div>
</div>
@auth

    @if (Session::has('announcements'))
        <!--announcement model-->
        <div class="modal fade" id="announcement" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Announcement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="ttlcnt15">
                            <span class="evntcunt">
                                {{ session()->get('announcements')->description }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endauth

<!--Request Model-->
<div class="modal fade" id="addrequest" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <div class="container bg-white rounded">
                    <!--Request Form-->
                    <form class="form form-prevent" method="POST" id="req" enctype="multipart/form-data"
                        action="{{ route('req.insert') }}">
                        @csrf
                        <div class="form-group">
                            <label for="requestname">Request Name</label>
                            <input type="text" class="form-control " name="requestname" id="requestname"
                                placeholder="Request Name" value="{{ old('requestname') }}">
                            <div class="text-danger mt-2 text-sm requestnameError"></div>
                        </div>
                        <div class="form-group">
                            <label for="price">Request Price</label>
                            <input type="number" class="form-control" name="price" id="price"
                                value="{{ old('price') }}" placeholder="৳">
                            <div class="text-danger mt-2 text-sm priceError"></div>
                        </div>
                        <div class="form-group">
                            <label for="days">In How much days</label>
                            <input type="datetime-local" class="form-control " name="days" id="days"
                                value="{{ old('days') }}" placeholder="No of Days">
                            <div class="text-danger mt-2 text-sm dayError"></div>
                        </div>
                        <div class="form-group pt-2">
                            <label for="coursename">Course/Category Name</label>
                            <input type="text" class="form-control" name="coursename" id="coursename"
                                value="{{ old('coursename') }}" placeholder="course or category name">
                            <div class="text-danger mt-2 text-sm coursenameError"></div>
                        </div>
                        <div class="form-group pt-2">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
                            <div class="text-danger mt-2 text-sm descriptionError"></div>
                        </div>
                        <div class="form-group pt-2">
                            <label for="file">Image/PDF</label>
                            <input type="file" class="form-control" name="file" id="file"
                                value="{{ old('file') }}" accept="image/*,.pdf,.zip,.rar"
                                placeholder="Upload image or pdf">

                            <div class="text-danger mt-2 text-sm fileError"></div>
                        </div>
                        <div class="form-group pt-2">
                            <label for="tag">Request Type</label>
                            <select name="tag" id="tag" value="{{ old('tag') }}" class="form-control">
                                <option selected disabled>Select Tag</option>
                                <option value="0">Offline</option>
                                <option value="1">Online</option>
                            </select>
                            <div class="text-danger mt-2 text-sm tagError"></div>
                        </div>
                        <button type="submit" class="post-link-btn btn-hover mt-2 btn-prevent" name="submit"
                            value="Submit"> <i class="spinner fa fa-spinner fa-spin" style="display: none;"></i>
                            Submit
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
<!--delete Model-->
<div class="modal fade" id="delreq" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <p>Do you really want to delete these Request? </p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('req.destroy') }}" method="post">
                    @csrf
                    <input type="hidden" name="req_id" value="" id="req_id">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--footer-->
@include('layouts.footer')
<!---/footer-->
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('#announcement').modal('show');
        }, 2000);
        $('#annclose').onclick = function() {
            $('#announcement').modal('hide');
        }
    });
</script>

<script>
    $(document).on("click", ".delete-confirm", function() {
        var reqId = $(this).data('id');
        $(".modal-footer #req_id").val(reqId);
        $('#delreq').modal('show');
    });
</script>
