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
                        <a href="" class="post-link-btn btn-hover" data-bs-toggle="modal" data-bs-target=" 
                        @auth
                        #addproposal
@else
#loginlink
                        @endauth  ">Post your Proposal</a>
                    </div>
                    @include('layouts.sidebar')
                    <!--/side bar-->
                    <main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                        <div class="pl_item_search rrmt-30">
                            <form action="{{ route('proposal.search') }}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-lg-10 col-md-8">
                                        <div class="form_group">
                                            <input class="form_input_1" type="text"
                                                placeholder="Search within these results" name="search">
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
                                            <button class="fltr-btn fltr-active">Newest</button>
                                            <button class="fltr-btn">Trending</button>
                                            <button class="fltr-btn">Weekly</button>
                                        </div>
                                        <button class="flter-btn2 pull-bs-canvas-left">Filter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (session('status'))
                        <div class="bg-primary mt-3 p-4 rounded-lg mb-6 text-white text-center">
                            {{ session('status') }}
                        </div>
                        @endif

                        @forelse ($data as $item)
                        <div class="full-width mt-4">
                            <div class="recent-items">
                                <div class="posts-list">
                                    <div class="feed-shared-author-dt">
                                        <div class="author-left">
                                            <a href="#"><img class="ft-plus-square job-bg-circle bg-cyan mr-0"
                                                    src="/storage/{{$item->user->image}}" alt=""></a>
                                        </div>
                                        <div class="author-dts">
                                            <a href="job_detail_view.html" class="problems_title">{{ $item->proposalname
                                                }}
                                            </a>
                                            <p class="notification-text font-username">
                                                <a href="#" class="text-danger">{{ $item->user->username }} </a><img
                                                    src="images/badges/verified.svg" alt="Verified" style="width: 15px;"
                                                    title="Verified">
                                                <span class="job-loca"><i class="fas fa-location-arrow"></i>{{
                                                    $item->user->uni_name }}</span>
                                            </p>
                                            <span>{{ Str::limit($item->description, 80, $end = '.........') }}</span>
                                            <p class="notification-text font-small-4 pt-1">
                                                <span class="time-dt">{{ $item->updated_at->diffForHumans() }}</span>
                                            </p>
                                            <div class="jbopdt142">
                                                <div class="jbbdges10">
                                                    <span class="job-badge ffcolor">Online</span>
                                                    <span class="job-badge ddcolor">৳ {{$item->price}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ellipsis-options post-ellipsis-options dropdown dropdown-account">
                                            <a href=""
                                                class="label-dker post_categories_reported mr-10"><span>Reported</span></a>
                                            <a href="" class="label-dker post_categories_top_right mr-20"><span>Course
                                                    Name</span></a>

                                        </div>
                                    </div>
                                </div>
                                <div class="post-meta">
                                    <div class="job-actions">
                                        <div class="aplcnts_15">
                                            <i
                                                class="feather-users mr-2"></i><span>Applied</span><ins>{{$item->proposalbid()->count()}}</ins>
                                            <i
                                                class="feather-eye mr-2"></i><span>Views</span><ins>{{$item->view_count}}</ins>
                                        </div>
                                        <div class="action-btns-job">
                                            <a href="{{ route('proposal.showproposal', ['id' => $item->id]) }}"
                                                class="view-btn btn-hover">Detail</a>
                                            <a href="my_job_detail_edit.html" title="Edit" class="bm-btn btn-hover"><i
                                                    class="feather-edit"></i></a>
                                            <span class="bm-btn btn-hover ms-2" data-bs-toggle="modal" title="Delete"
                                                data-bs-target="#deleteJobModal"><i class="feather-trash-2"></i></span>
                                            @isset($bid)
                                            @foreach ($bid as $bidd)
                                            @if ($bidd->proposal_id==$item->id && $bidd->status==1)
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
                            {{ $data->links() }}
                        </div>
                    </main>
                </div>
        </div>
    </div>

    <!--Add Proposal Model-->
    <div class="modal fade" id="addproposal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
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
                                    value="{{ old('proposalname') }}" placeholder="Request Name">
                                <div class="text-danger mt-2 text-sm proposalname"></div>
                            </div>
                            <div class="form-group pt-2">
                                <label for="price">Project Price</label>
                                <input type="number" class="form-control" name="price" id="price"
                                    value="{{ old('price') }}" placeholder="project price">
                                <div class="text-danger mt-2 text-sm price"></div>
                            </div>
                            <div class="form-group pt-2">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description"
                                    rows="3">{{ old('description') }}</textarea>
                                <div class="text-danger mt-2 text-sm description"></div>
                            </div>
                            <div class="form-group pt-2">
                                <label for="file">Image/PDF</label>
                                <input type="file" class="form-control" name="file" id="file" value="{{ old('file') }}"
                                    placeholder="Upload image or
                                pdf">
                                <div class="text-danger mt-2 text-sm file"></div>
                            </div>
                            <hr>
                            <input type="submit" class="btn" name="submit" value="Submit">
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--footer-->
    @include('layouts.footer')
    <!---/footer-->