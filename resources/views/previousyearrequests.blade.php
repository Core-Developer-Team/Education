@section('title', 'Previous_Year_Ques')
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
                    <div class="btn_1589">
                        @if(auth()->check() == false || auth()->user()->block != 1)
                        <a href="" class="post-link-btn btn-hover" data-bs-toggle="modal"
                            data-bs-target="@auth @fullinfo
#addquestion
@else
#userinfolink
@endfullinfo
@else
#loginlink @endauth ">Post your Question</a>
@endif
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
                                    <input class="form_input_1" type="text" placeholder="Search within these results"
                                        name="search" required>
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
                                            <a href="#"><img class="ft-plus-square job-bg-circle bg-cyan mr-0"
                                                    src="/storage/{{ $data->user->image }}" alt=""></a>
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
                                        <div class="iconreq">
                                            <img class="ft-plus-square job-bg-circle bg-cyan mr-0"
                                                src="{{ $data->user->badge->image }}" style="width:30px; height:30px"
                                                alt="">
                                        </div>
                                        <div class="author-dts">
                                            <a class="problems_title">{{ $data->quesname }}</a>
                                            <p class="notification-text font-username">
                                            <div class="userimg">
                                                <a href="#" class="text-success">{{ $data->user->username }}
                                                    &nbsp;
                                                </a><img src="images/badges/verified.svg" class="d-none"
                                                    alt="Verified" style="width: 17px;" title="Verified">
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
                                            <span class="job-loca"><i
                                                    class="fas fa-location-arrow"></i>{{ $data->user->uni_name }}</span>
                                            </p>
                                            <span>{{ Str::limit($data->description, 150, $end = '.........') }}</span>
                                            <p class="notification-text font-small-4 pt-1">
                                                <span class="time-dt">{{ $data->created_at->diffForHumans() }}</span>
                                            </p>
                                            <div class="jbopdt142">
                                                <div class="jbbdges10">
                                                    <span class="job-badge ddcolor">??? {{ $data->price }} </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ellipsis-options post-ellipsis-options dropdown dropdown-account">
                                            <a href=""
                                                class="label-dker post_department_top_right mr-10"><span>{{ $data->user->department->name }}</span></a>
                                            <a href=""
                                                class="label-dker post_categories_top_right mr-20"><span>{{ $data->coursename }}</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="post-meta">
                                    <div class="job-actions">
                                        <div class="aplcnts_15">
                                            <i
                                                class="feather-eye mr-2"></i><span>Views</span><ins>6</ins>
                                        </div>
                                        <div class="action-btns-job d-flex justify-content-space">
                                            <a href="{{ route('ques.single', ['id' => $data->id]) }}"
                                                class="view-btn btn-hover">View Job</a>
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

<!--question Model-->
<div class="modal fade" id="addquestion" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Previous year Ques</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <div class="container bg-white rounded">
                    <!--Request Form-->
                    <form class="form form-prevent" method="POST" id="ques" enctype="multipart/form-data"
                        action="{{ route('ques.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="quesname">Question Name</label>
                            <input type="text" class="form-control" name="quesname" id="quesname"
                                placeholder="Question Name" value="{{ old('quesname') }}">
                            <div class="text-danger mt-2 text-sm quesnameError"></div>
                        </div>
                        <div class="form-group">
                            <label for="price">Question Price</label>
                            <input type="number" class="form-control" name="price" id="price"
                                value="{{ old('price') }}" placeholder="???">
                            <div class="text-danger mt-2 text-sm priceError"></div>
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
                        <button type="submit" class="post-link-btn btn-hover mt-3 btn-prevent" name="submit"
                            value="Submit"> <i class="spinner fa fa-spinner fa-spin" style="display: none;"></i>
                            Submit
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
<!--footer-->
@include('layouts.footer')
<!---/footer-->
