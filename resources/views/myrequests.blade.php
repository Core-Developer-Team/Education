@section('title','my_Requests')
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
                <div class="item text-center">
                    <a href="#" class="event-cate-links">
                        <div class="event-full-width">
                            <div class="event-cate-items">
                                <h6>Data Structure 1</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="item text-center">
                    <a href="#" class="event-cate-links">
                        <div class="event-full-width">
                            <div class="event-cate-items">
                                <h6>Artificial Intelligence</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="item text-center">
                    <a href="#" class="event-cate-links">
                        <div class="event-full-width">
                            <div class="event-cate-items">
                                <h6>Web Programming</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="item text-center">
                    <a href="#" class="event-cate-links">
                        <div class="event-full-width">
                            <div class="event-cate-items">
                                <h6>Computer Architecture</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="item text-center">
                    <a href="#" class="event-cate-links">
                        <div class="event-full-width">
                            <div class="event-cate-items">
                                <h6>Data Structure 2</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="item text-center">
                    <a href="#" class="event-cate-links">
                        <div class="event-full-width">
                            <div class="event-cate-items">
                                <h6>Software Engineering</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="item text-center">
                    <a href="#" class="event-cate-links">
                        <div class="event-full-width">
                            <div class="event-cate-items">
                                <h6>Discrete Mathematics</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="item text-center">
                    <a href="#" class="event-cate-links">
                        <div class="event-full-width">
                            <div class="event-cate-items">
                                <h6>Green Computing</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="item text-center">
                    <a href="#" class="event-cate-links">
                        <div class="event-full-width">
                            <div class="event-cate-items">
                                <h6>Computer Networks</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="item text-center">
                    <a href="#" class="event-cate-links">
                        <div class="event-full-width">
                            <div class="event-cate-items">
                                <h6>Electrical Circuits</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="item text-center">
                    <a href="#" class="event-cate-links">
                        <div class="event-full-width">
                            <div class="event-cate-items">
                                <h6>Theory of Computation</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="item text-center">
                    <a href="#" class="event-cate-links">
                        <div class="event-full-width">
                            <div class="event-cate-items">
                                <h6>Electronics</h6>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!--side bar-->
            <aside class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-12 col-sm-12 col-12">
                <div class="full-width mt-10">
                    <div class="btn_1589">
                        <a href="" class="post-link-btn btn-hover" data-bs-toggle="modal" data-bs-target=" @auth
            #addrequest
            @else
            #loginlink
            @endauth ">Post your problem</a>
                    </div>
                    @include('layouts.sidebar')
                    <!--/side bar-->
                    <main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                        <div class="pl_item_search rrmt-30">
                            <form action="{{ route('req.search') }}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-lg-10 col-md-8">
                                        <div class="form_group">
                                            <input class="form_input_1" type="text"
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
                        @if(session()->has('reqstatus'))
                        <div class="alert alert-success mt-3">
                            {{ session()->get('reqstatus') }}
                        </div>
                        @endif
                        @forelse ($datas as $data)
                        <div class="full-width mt-4">
                            <div class="recent-items">
                                <div class="posts-list">
                                    <div class="feed-shared-author-dt">
                                        <div class="author-left">
                                            <a href="#"><img class="ft-plus-square job-bg-circle bg-cyan mr-0"
                                                    src="/storage/{{ $data->user->image }}" alt=""></a>
                                        </div>

                                        <div class="iconreq">
                                            <img class="ft-plus-square job-bg-circle bg-cyan mr-0"
                                                src="{{ $data->user->badge->image }}" style="width:30px; height:30px"
                                                alt="">
                                        </div>

                                        <div class="author-dts">
                                            <a href="" class="problems_title">{{$data->requestname}}
                                            </a>
                                            <p class="notification-text font-username">
                                                <a href="#" class="text-danger">{{$data->user->username}}
                                                </a><img src="images/badges/verified.svg" class="d-none" alt="Verified"
                                                    style="width: 15px;" title="Verified">
                                                <span class="job-loca"><i
                                                        class="fas fa-location-arrow"></i>{{$data->user->uni_name}}</span>
                                            </p>
                                            <span>{{ Str::limit($data->description, 150, $end = '.........') }}</span>
                                            <p class="notification-text font-small-4 pt-1">
                                                <span class="time-dt">{{ $data->created_at->diffForHumans() }}</span>
                                            </p>
                                            <div class="jbopdt142">
                                                <div class="jbbdges10">
                                                    <span class="job-badge ffcolor"> @if ($data->tag == 1)
                                                        Offline
                                                        @else
                                                        Online
                                                        @endif</span>
                                                    <span class="job-badge ddcolor">৳ {{$data->price}} </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ellipsis-options post-ellipsis-options dropdown dropdown-account">
                                            <!--          <a href=""
                                                class="label-dker post_categories_reported mr-10"><span>Reported</span></a> -->
                                            <a href=""
                                                class="label-dker post_categories_top_right mr-20"><span>{{$data->coursename}}</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="post-meta">
                                    <div class="job-actions">
                                        <div class="aplcnts_15">
                                            <i
                                                class="feather-users mr-2"></i><span>Applied</span><ins>{{$data->reqbid->count()}}</ins>
                                            <i
                                                class="feather-eye mr-2"></i><span>Views</span><ins>{{$data->view_count}}</ins>
                                        </div>
                                        <div class="action-btns-job">
                                            <a href="{{ route('req.showsingle', ['id' => $data->id]) }}"
                                                class="view-btn btn-hover">View Req</a>
                                            @isset($bid)

                                            @foreach ($bid as $item)
                                            @if ($item->request_id==$data->id && $item->status==1)
                                            <a href="#" title="Solved" class="bm-btn bm-btn-hover-solve  ms-2 active"><i
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
                    <form class="form" method="POST" id="req" enctype="multipart/form-data"
                        action="{{ route('req.insert') }}">
                        @csrf
                        <div class="form-group">
                            <label for="requestname">Request Name</label>
                            <input type="text" class="form-control " name="requestname" id="requestname"
                                value="{{ old('requestname') }}" placeholder="Request Name">
                            <div class="text-danger mt-2 text-sm requestnameError"></div>
                        </div>
                        <div class="form-group">
                            <label for="price">Request Price</label>
                            <input type="number" class="form-control " name="price" id="price"
                                value="{{ old('price') }}" placeholder="Request Name">
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
                            <textarea class="form-control" name="description"
                                rows="3">{{ old('description') }}</textarea>
                            <div class="text-danger mt-2 text-sm descriptionError"></div>
                        </div>
                        <div class="form-group pt-2">
                            <label for="file">Image/PDF</label>
                            <input type="file" class="form-control" name="file" id="file" value="{{ old('file') }}"
                                placeholder="Upload image or pdf">
                            <div class="text-danger mt-2 text-sm fileError"></div>
                        </div>
                        <div class="form-group pt-2">
                            <label for="tag">Course/Category Name</label>
                            <select name="tag" id="tag" value="{{ old('tag') }}" class="form-control">
                                <option selected disabled>Select Tag</option>
                                <option value="0">Offline</option>
                                <option value="1">Online</option>
                            </select>
                            <div class="text-danger mt-2 text-sm tagError"></div>
                        </div>
                        <button type="submit" class="post-link-btn btn-hover mt-2" name="submit" value="Submit"> Submit
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