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
                        <a href="" class="post-link-btn btn-hover" data-bs-toggle="modal"
                            data-bs-target=" 
                        @auth
                        #addresource
@else
#loginlink
                        @endauth">Add
                            Resource</a>
                    </div>
                    <ul class="info__sections">
                        <li>
                            <a href="{{ route('req.index') }}" class="all-info__sections">
                                <span class="all-info__left"><i class="feather-archive me-2"></i>All
                                    Requests</span>
                                <span class="all-info__right">{{ $req_count }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('feedback.store') }}" class="all-info__sections">
                                <span class="all-info__left"><i class="feather-user me-2"></i>Feedback</span>
                                <span class="all-info__right">{{ $feed_count }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile.mysol') }}" class="all-info__sections">
                                <span class="all-info__left"><i class="feather-check-square me-2"></i>My
                                    Solutions</span>
                                <span class="all-info__right">{{ $mysol }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('req.myrequests') }}" class="all-info__sections">
                                <span class="all-info__left"><i class="feather-help-circle me-2"></i>My Questions</span>
                                <span class="all-info__right">{{ $myques }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('resource.index') }}" class="all-info__sections">
                                <span class="all-info__left"><i class="feather-file-plus me-2"></i>Resources and
                                    notes</span>
                                <span class="all-info__right">{{ $res }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('event.index') }}" class="all-info__sections">
                                <span class="all-info__left"><i class="feather-user me-2"></i>events</span>
                                <span class="all-info__right">{{ $event }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('req.prevyear') }}" class="all-info__sections">
                                <span class="all-info__left"><i class="feather-package me-2"></i>Previous Year Ques
                                    Solutions</span>
                                <span class="all-info__right">0</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('req.allsolution') }}" class="all-info__sections">
                                <span class="all-info__left"><i class="feather-check-circle me-2"></i>All Solved
                                    Problems</span>
                                <span class="all-info__right">0</span>
                            </a>
                        </li>
                        <li>
                            <a href="" class="all-info__sections">
                                <span class="all-info__left"><i
                                        class="feather-alert-triangle me-2"></i>Reported</span>
                                <span class="all-info__right">0</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('proposal.index') }}" class="all-info__sections">
                                <span class="all-info__left"><i class="feather-terminal me-2"></i>Developer
                                    Proposals</span>
                                <span class="all-info__right">{{ $prop }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('offlinetopic.show') }}" class="all-info__sections">
                                <span class="all-info__left"><i class="feather-message-square me-2"></i>Community
                                    Discussion</span>
                                <span class="all-info__right">{{ $offline }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="" class="all-info__sections">
                                <span class="all-info__left"><i class="feather-bookmark me-2"></i>Trending</span>
                                <span class="all-info__right">0</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="full-width mt-4 dstp-bnr-dt">
                    <div class="banner-item">
                        <div class="banner-img">
                            <img src="images/banners/banner-1.jpg" alt="">
                            <div class="banner-overlay">
                                <span>Learning Plateform</span>
                                <h4>Keep learning in the moments that matter.</h4>
                                <button class="main-btn color btn-hover"
                                    onclick="window.location.href='{{ route('course.index') }}'">See
                                    Courses</button>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
            <!--/side bar-->
            <main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                <div class="pl_item_search rrmt-30">
                    <form action="{{ route('res.search') }}" method="post">
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
                <div class="filter_items">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="filter-section">
                                <div class="btn-4585">
                                    <button onclick="window.location='{{ route('res.latest') }}'"
                                        class="fltr-btn fltr-active">Newest</button>
                                    <button onclick="window.location=''" class="fltr-btn">Trending</button>
                                    <button onclick="window.location='{{ route('res.week') }}'"
                                        class="fltr-btn">Weekly</button>
                                </div>
                                <button class="flter-btn2 pull-bs-canvas-left">Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
                @if (session('status'))
                    <div class="bg-primary p-4 rounded-lg mb-6 text-white text-center">
                        {{ session('status') }}
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
                                                                <a href="#"><img
                                                                        class="ft-plus-square job-bg-circle bg-cyan mr-0"
                                                                        src="/storage/{{ $data->user->image }}"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="author-dts">
                                                                <p class="notification-text font-username">
                                                                    <a href="#"
                                                                        class="text-danger">{{ $data->user->username }}
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
                                                                    <span class="time-dt">Total Solutions
                                                                        {{ $data->user->solutions }}</span>
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
                                        <a href="" class="problems_title">{{ $data->name }}
                                        </a>
                                        <p class="notification-text font-username">
                                            <a href="#" class="text-danger">{{ $data->user->username }}
                                            </a><img src="images/badges/verified.svg" class="d-none" alt="Verified"

                                                style="width: 15px;" title="Verified">
                                            <span class="job-loca"><i
                                                    class="fas fa-location-arrow"></i>{{ $data->user->uni_name }}</span>
                                        </p>
                                        <span>{{ Str::limit($data->description, 150, $end = '.........') }}</span>
                                        <p class="notification-text font-small-4 pt-1">
                                            <span class="time-dt">{{ $data->created_at->diffForHumans() }}</span>
                                        </p>
                                    </div>
                                    <div class="ellipsis-options post-ellipsis-options dropdown dropdown-account">
                                        <a href=""
                                            class="label-dker post_categories_reported mr-10 d-none"><span>Reported</span></a>
                                        <span class="job-badge ddcolor">৳ {{ $data->price }} </span>
                                        <a href=""
                                            class="label-dker post_categories_top_right mr-20"><span>{{ $data->category }}</span></a>

                                    </div>
                                </div>
                            </div>
                            <div class="post-meta">
                                <div class="job-actions">
                                    <div class="aplcnts_15">
                                        <i class="feather-users mr-2"></i><span>Applied</span><ins>0</ins>
                                        <i
                                            class="feather-eye mr-2"></i><span>Views</span><ins>{{ $data->view_count }}</ins>
                                    </div>
                                    <div class="action-btns-job">
                                        <a href="{{ route('resource.showresource', ['id' => $data->id]) }}"
                                            class="view-btn btn-hover">Detail</a>
                                        <a href="" title="Edit" class="bm-btn btn-hover d-none"><i
                                                class="feather-edit"></i></a>
                                        <span class="bm-btn btn-hover ms-2 d-none" data-bs-toggle="modal" title="Delete"
                                            data-bs-target="#deleteJobModal"><i class="feather-trash-2"></i></span>
                                        <a href="#" title="Solved"
                                            class="bm-btn bm-btn-hover-solve ms-2 d-none active"><i
                                                class="fas fa-check"></i></a>
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
                <div class="mt-5">
                    {{ $datas->links() }}
                </div>

            </main>

        </div>
    </div>
</div>

<!--Add Resource Model-->
<div class="modal fade" id="addresource" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Resource</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container bg-white rounded">
                    <!--Resource Form-->
                    <form action="{{ route('resource.store') }}" class="form p-3" id="res" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Resource Name</label>
                            <input type="text" name="name" class="form-control" id="name">
                            <div class="text-danger mt-2 text-sm name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price">Resource Price</label>
                            <input type="number" name="price" class="form-control" id="price">
                            <div class="text-danger mt-2 text-sm price">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category">Resource Category</label>
                            <input type="text" name="category" class="form-control" id="category">
                            <div class="text-danger mt-2 text-sm category">
                            </div>
                        </div>
                        <div class="form-group pt-2">
                            <label for="chooseFile" class="custom-file-label">Select File</label>
                            <input type="file" name="file" class="form-control"
                                accept="image/*,.doc,.docx,.pdf,.pptx,.zip,.rar" id="chooseFile">
                            <div class="text-danger mt-2 text-sm file"></div>
                        </div>

                        <div class="form-group pt-2">
                            <label for="desc">Description</label>
                            <textarea id="desc" class="form-control" name="description" rows="3"></textarea>
                            <div class="text-danger mt-2 text-sm description"></div>
                        </div>

                        <button type="submit" name="submit" class="post-link-btn btn-hover mt-2">Upload</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!--footer-->
@include('layouts.footer')
<!---/footer-->
<!--Resoure model script-->
<script>
    const resForm = $('form#res');
    resForm.on('submit', (e) => {
        e.preventDefault();
        const formres = document.getElementById('res');
        const formData = new FormData(formres);
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
                if (errorResponse.name) {
                    $('.name').text(errorResponse.name[0]);
                }
                if (errorResponse.price) {
                    $('.price').text(errorResponse.price[0]);
                }
                if (errorResponse.category) {
                    $('.category').text(errorResponse.category[0]);
                }
                if (errorResponse.file) {
                    $('.file').text(errorResponse.file[0]);
                }
                if (errorResponse.description) {
                    $('.description').text(errorResponse.description[0]);
                }
            }
        })
    })
</script>
