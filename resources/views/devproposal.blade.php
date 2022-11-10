@section('title', 'Proposals')
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
                        <a href="{{ route('prop.searchcat', ['name' => $cat->category]) }}" class="event-cate-links">
                            <div class="event-full-width">
                                <div class="event-cate-items">
                                    <h6>{{ $cat->category }}</h6>
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
                            data-bs-target="@auth @fullinfo
#addproposal
@else
#userinfolink
@endfullinfo
@else
#loginlink @endauth  ">Post
                            your Proposal</a>
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
                    <form action="{{ route('proposal.search') }}" method="post">
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
                                    <a href="{{ route('proposal.new') }}"
                                        class="fltr-btn @if (request()->getpathinfo() == '/latest_proposal' || request()->getpathinfo() == '/proposals') fltr-active @endif">Newest</a>
                                    <a href="{{ route('proposal.trending') }}"
                                        class="fltr-btn @if (request()->getpathinfo() == '/trending_proposal') fltr-active @endif">Trending</a>
                                    <a href="{{ route('proposal.week') }}"
                                        class="fltr-btn @if (request()->getpathinfo() == '/weekly_proposal') fltr-active @endif">Weekly</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (session('status'))
                    <div class="bg-primary mt-3 p-4 rounded-lg mb-6 text-white text-center">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="propsearch">
                    @forelse ($data as $item)
                        <div class="full-width mt-4">
                            <div class="recent-items">
                                <div class="posts-list">
                                    <div class="feed-shared-author-dt">
                                        <div class="author-left userimg">
                                            <img class="ft-plus-square job-bg-circle  bg-cyan mr-0"
                                                src="/storage/{{ $item->user->image }}" alt="">
                                            <div style="position: relative;margin-top: -10px;margin-left: 10px;"
                                                class="presence-entity__badge @if (Cache::has('user-is-online-' . $item->user_id)) badge__online @else badge__offline @endif">
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
                                                                    <img class="ft-plus-square job-bg-circle bg-cyan mr-0"
                                                                        src="/storage/{{ $item->user->image }}"
                                                                        alt="">
                                                                    <div
                                                                        class="@if (Cache::has('user-is-online-' . $item->user->id)) status-oncircle @else status-ofcircle @endif">
                                                                    </div>
                                                                </div>
                                                                <div class="author-dts">
                                                                    <p class="notification-text font-username">
                                                                        <a href="#"
                                                                            style="color: {{ $item->user->role->color->name }}">{{ $item->user->username }}
                                                                        </a><img src="{{ $item->user->badge->image }}"
                                                                            alt="" style="width: 20px;"
                                                                            title="{{ $item->user->badge->name }}">
                                                                        <span class="job-loca"><i
                                                                                class="fas fa-location-arrow"></i>{{ $item->user->uni_name }}</span>
                                                                    </p>

                                                                    <p class="notification-text font-small-4 pt-1">
                                                                        <span class="time-dt">Joined on
                                                                            {{ $item->user->created_at->format('d:M:y g:i A') }}</span>
                                                                    </p>
                                                                    <p class="notification-text font-small-4 pt-1">
                                                                        <span class="time-dt">Last Seen
                                                                            @if (Cache::has('user-is-online-' . $item->user->id))
                                                                                <span
                                                                                    class="text-success">Online</span>
                                                                            @else
                                                                                {{ Carbon\Carbon::parse($item->user->last_seen)->diffForHumans() }}
                                                                            @endif
                                                                        </span>
                                                                    </p>
                                                                    <p class="notification-text font-small-4 pt-1">
                                                                        <span class="time-dt">Total Solutions
                                                                            {{ $item->user->solutions }}</span>
                                                                    </p>
                                                                    <p class="notification-text font-small-4 pt-1">
                                                                        <span class="time-dt">Rating
                                                                            {{ $item->user->rating }}</span>
                                                                    </p>
                                                                    <p class="notification-text font-small-4 pt-1">
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
                                        <div class="iconreq">
                                            <img class="ft-plus-square job-bg-circle bg-cyan mr-0"
                                                src="{{ $item->user->badge->image }}" style="width:20px; height:20px"
                                                title="{{ $item->user->badge->name }}">
                                        </div>
                                        <div class="author-dts">
                                            <a href="{{ route('proposal.showproposal', ['id' => $item->id]) }}"
                                                class="problems_title">{{ $item->proposalname }}
                                            </a>
                                            <p class="notification-text font-username">
                                            <div class="userimg">
                                                <a href="{{ route('profile.show', ['id' => $item->user_id]) }}"
                                                    style="color: {{ $item->user->role->color->name }}">{{ $item->user->username }}
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
                                                                            src="/storage/{{ $item->user->image }}"
                                                                            alt="">
                                                                        <div
                                                                            class="@if (Cache::has('user-is-online-' . $item->user->id)) status-oncircle @else status-ofcircle @endif">
                                                                        </div>
                                                                    </div>
                                                                    <div class="author-dts">
                                                                        <p class="notification-text font-username">
                                                                            <a href="#"
                                                                                style="color: {{ $item->user->role->color->name }}">{{ $item->user->username }}
                                                                            </a><img
                                                                                src="{{ $item->user->badge->image }}"
                                                                                alt="" style="width: 20px;"
                                                                                title="{{ $item->user->badge->name }}">
                                                                            <span class="job-loca"><i
                                                                                    class="fas fa-location-arrow"></i>{{ $item->user->uni_name }}</span>
                                                                        </p>

                                                                        <p class="notification-text font-small-4 pt-1">
                                                                            <span class="time-dt">Joined on
                                                                                {{ $item->user->created_at->format('d:M:y g:i A') }}</span>
                                                                        </p>
                                                                        <p class="notification-text font-small-4 pt-1">
                                                                            <span class="time-dt">Last Seen
                                                                                @if (Cache::has('user-is-online-' . $item->user->id))
                                                                                    <span
                                                                                        class="text-success">Online</span>
                                                                                @else
                                                                                    {{ Carbon\Carbon::parse($item->user->last_seen)->diffForHumans() }}
                                                                                @endif
                                                                            </span>
                                                                        </p>
                                                                        <p class="notification-text font-small-4 pt-1">
                                                                            <span class="time-dt">Total Solutions
                                                                                {{ $item->user->solutions }}</span>
                                                                        </p>
                                                                        <p class="notification-text font-small-4 pt-1">
                                                                            <span class="time-dt">Rating
                                                                                {{ $item->user->rating }}</span>
                                                                        </p>
                                                                        <p class="notification-text font-small-4 pt-1">
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
                                            <img src="@if ($item->user->badge_id == 5 || $item->user->status == 1) /storage/badges/verified.svg @endif"
                                                class="ms-1 @if ($item->user->badge_id == 5 || $item->user->status == 1) @else d-none @endif "
                                                alt="Verified" style="width: 17px;" title="Verified">
                                            <span class="job-loca"><i
                                                    class="fas fa-location-arrow"></i>{{ $item->user->uni_name }}</span>
                                            </p>
                                            <span>{{ Str::limit($item->description, 80, $end = '.........') }}</span>
                                            <p class="notification-text font-small-4 pt-1">
                                                <span class="time-dt">{{ $item->updated_at->diffForHumans() }}</span>
                                            </p>
                                            <div class="jbopdt142">
                                                <div class="jbbdges10">
                                                    <span class="job-badge ddcolor">৳ {{ $item->price }}</span>
                                                    <span class="job-badge ttcolor">
                                                        @if (\Carbon\Carbon::parse(now())->diffInDays($item->days, false) <= 1)
                                                            @if (\Carbon\Carbon::parse(now())->diffInMinutes($item->days, false) < 60 &&
                                                                \Carbon\Carbon::parse(now())->diffInMinutes($item->days, false) >= 1)
                                                                {{ \Carbon\Carbon::parse(now())->diffInMinutes($item->days, false) }}
                                                                Minutes left
                                                            @elseif(\Carbon\Carbon::parse(now())->diffInMinutes($item->days, false) <= 0)
                                                                @if (\Carbon\Carbon::parse(now())->diffInSeconds($item->days, false) > 0)
                                                                    {{ \Carbon\Carbon::parse(now())->diffInSeconds($item->days, false) }}
                                                                    Seconds left
                                                                @else
                                                                    @if ($item->propsolution()->count() >= 1 && $item->propsolution->proposal_id == $item->id)
                                                                        Closed
                                                                    @else
                                                                        Unsolved
                                                                    @endif
                                                                @endif
                                                            @else
                                                                {{ \Carbon\Carbon::parse(now())->diffInHours($item->days, false) }}
                                                                Hours left
                                                            @endif
                                                        @else
                                                            {{ \Carbon\Carbon::parse(now())->diffInDays($item->days, false) }}
                                                            days left
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ellipsis-options post-ellipsis-options dropdown dropdown-account">
                                            <a href=""
                                                class="label-dker post_categories_reported mr-10 @if ($item->propsolreport()->count() > 0 && $item->propsolreport->proposal_id == $item->id && $item->propsolreport->status==1) @else d-none @endif"><span
                                                    class="label-dker post_categories_reported mr-10">Reported</span></a>
                                            <a href=""
                                                class="label-dker post_department_top_right mr-10 px-2 ms-2"><span>
                                                    {{ $item->user->department->name }}
                                                </span></a>
                                            <a href=""
                                                class="label-dker post_categories_top_right mr-20 ms-2"><span>{{ $item->category }}</span></a>
                                        </div>
                                    </div>

                                </div>
                                <div class="post-meta">
                                    <div class="job-actions">
                                        <div class="aplcnts_15">
                                            <i
                                                class="feather-users mr-2"></i><span>Applied</span><ins>{{ $item->proposalbid()->count() }}</ins>
                                            <i
                                                class="feather-eye mr-2"></i><span>Views</span><ins>{{ $item->view_count }}</ins>
                                        </div>
                                        <div class="action-btns-job d-flex justify-content-space">
                                            <a href="{{ route('proposal.showproposal', ['id' => $item->id]) }}"
                                                class="view-btn btn-hover">Detail</a>
                                            @if ($item->user_id == Auth()->id())
                                                <div
                                                    class="@if ($item->propsolution()->count() > 0) @if ($item->propsolution->proposal_id == $item->id) d-none @endif @endif">
                                                    <a href="" title="Edit" class="px-3">
                                                        <a href="{{ route('proposal.edit', ['id' => $item->id]) }}"
                                                            type="button" class="bm-btn btn-hover">
                                                            <i class="feather-edit"></i>
                                                        </a>
                                                    </a>
                                                    <button class="bm-btn btn-hover delete-confirm"
                                                        data-bs-toggle="modal" data-bs-target="#delreq"
                                                        data-id="{{ $item->id }}"><i
                                                            class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </div>
                                            @endif
                                                    @if ($item->propsolution()->count()>0 && $item->propsolution->proposal_id)
                                                        <a href="#" title="Solved"
                                                            class="bm-btn bm-btn-hover-solve  ms-2 active"><i
                                                                class="fas fa-check"></i></a>
                                                    @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                </div>
                <div class="alert alert-success mt-3">
                    Sorry! No data found
                </div>
                @endforelse
                <div class="mt-3">
                    {{ $data->links() }}
                </div>
            </main>
        </div>
    </div>
</div>

<!--Add Proposal Model-->
<div class="modal fade" id="addproposal" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Proposal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container bg-white rounded">
                    <!--book Form-->
                    <form class="form p-3" method="POST" id="proposal" enctype="multipart/form-data"
                        action="{{ route('proposal.get') }}">
                        @csrf

                        <div class="form-group">
                            <label for="proposalname">Project Name</label>
                            <input type="text" class="form-control" name="proposalname" id="proposalname"
                                value="{{ old('proposalname') }}" placeholder="Proposal Name">
                            <div class="text-danger mt-2 text-sm proposalname"></div>
                        </div>
                        <div class="form-group pt-2">
                            <label for="price">Project Price</label>
                            <input type="number" class="form-control" name="price" id="price"
                                value="{{ old('price') }}" placeholder="project price">
                            <div class="text-danger mt-2 text-sm price"></div>
                        </div>
                        <div class="form-group">
                            <label for="days">In How much days</label>
                            <input type="datetime-local" class="form-control " name="days" id="days"
                                value="{{ old('days') }}" placeholder="No of Days">
                            <div class="text-danger mt-2 text-sm dayError"></div>
                        </div>
                        <div class="form-group pt-2">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            <div class="text-danger mt-2 text-sm description"></div>
                        </div>
                        <div class="form-group">
                            <label for="category">Project category</label>
                            <input type="text" class="form-control" name="category" id="category"
                                value="{{ old('category') }}" placeholder="Proposal category">
                            <div class="text-danger mt-2 text-sm category"></div>
                        </div>
                        <div class="form-group pt-2">
                            <label for="file">Image/PDF</label>
                            <input type="file" class="form-control" name="file" accept="image/*,.pdf"
                                id="file" value="{{ old('file') }}"
                                placeholder="Upload image or
                                pdf">
                            <div class="text-danger mt-2 text-sm file"></div>
                        </div>
                        <input type="submit" class="btn btn-primary bg-primary mt-3 w-100" name="submit"
                            value="Submit">
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!--delete Model-->
<div class="modal fade" id="delreq" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <p>Do you really want to delete this Proposal? </p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.proposal.delete') }}" method="post">
                    @csrf
                    <input type="hidden" name="proposal_id" value="" id="proposal_id">
                    <button type="submit" class="btn btn-danger mt-3">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--footer-->
@include('layouts.footer')
<!---/footer-->
<script>
    $(document).on("click", ".delete-confirm", function() {
        var reqId = $(this).data('id');
        $(".modal-footer #proposal_id").val(reqId);
        $('#delreq').modal('show');
    });
</script>

<!--Ajax Search-->
<script type="text/javascript">
    $('#search').on('keyup', function() {
        $value = $(this).val();
        $.ajax({
            type: 'get',
            url: '{{ URL::to('livepropsearch') }}',
            data: {
                'search': $value
            },
            success: function(data) {
                $('.propsearch').html(data);
            }

        });
    })
</script>
