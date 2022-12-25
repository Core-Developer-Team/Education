@section('title','Courses')
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
            <div class="col-xl-3 col-lg-4 col-md-12">
                <div class="full-width">
                    <div class="btn_1589">
                        @if(auth()->check() == false || auth()->user()->block != 1)
                        <a href="" class="post-link-btn btn-hover" data-bs-toggle="modal"
                        data-bs-target="@auth @fullinfo
#addcourse
@else
#userinfolink
@endfullinfo
@else
#loginlink
                        @endauth">Add Course</a>
                        @endif
                    </div>
                    <div class="posted_1590">
                        <div class="count-ttl"> {{ $playlist->count()}}</div>
                        <div class="cate-post">Added Courses</div>
                    </div>
                    <div class="manage-section">
                        <span class="manage-title">Manage My Courses</span>
                    </div>
                    <ul class="info__sections">
                        <li>
                            <a href="" class="all-info__sections">
                                <span class="all-info__left"><i class="feather-grid me-2"></i>My Courses</span>
                                <span class="all-info__right">{{
                                    $playlist->where('user_id',Auth()->id())->count()}}</span>
                            </a>
                        </li>

                        <li>
                            <a  class="all-info__sections">
                                <span class="all-info__left"><i class="feather-download me-2"></i>Purchased</span>
                                <span class="all-info__right">0</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <div class="full-width mt-5">

                    <div class="manage-section mt-3">
                        <span class="manage-title">Today's Activity</span>
                    </div>
                    <ul class="info__sections">
                        <li>
                            <a class="all-info__sections">
                                <span class="all-info__left"><i class="feather-grid me-2"></i>Request</span>
                                <span class="all-info__right">{{$t_req_count}}</span>
                            </a>
                        </li>
                        <li>
                            <a  class="all-info__sections">
                                <span class="all-info__left"><i class="feather-grid me-2"></i>Proposal</span>
                                <span class="all-info__right">{{$t_prop_count}}</span>
                            </a>
                        </li>

                        <li>
                            <a  class="all-info__sections">
                                <span class="all-info__left"><i class="feather-download me-2"></i>Request Solution</span>
                                <span class="all-info__right">{{$t_reqsolution_count}}</span>
                            </a>
                        </li>
                        <li>
                            <a  class="all-info__sections">
                                <span class="all-info__left"><i class="feather-download me-2"></i>Proposal Solution</span>
                                <span class="all-info__right">{{$t_propsolution_count}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-12">

                <div class="filter_items">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="filter-section">
                                <div class="btn-4585">
                                    <a href="{{route('course.latest')}}" class="fltr-btn  @if (request()->getpathinfo() == '/course_latest' || request()->getpathinfo() == '/course') fltr-active @endif">Newest</a>
                                    <a href="{{route('course.trending')}}" class="fltr-btn @if (request()->getpathinfo() == '/course_trending') fltr-active @endif">Trending</a>
                                    <a href="{{route('course.week')}}" class="fltr-btn @if (request()->getpathinfo() == '/course_weekly') fltr-active @endif">Weekly</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                @if (session()->has('success'))
                <div class="fixed bg-green-600 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">
                    <p>{{ session()->get('success') }}</p>
                </div>
                @endif
                <div class="all-items">
                    <div class="product-items-list">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="learning_all_items mt-30">
                                    <div class="owl_title">
                                        <h4>Free</h4>
                                        <a href="{{ route('course.freecourse', ['id'=>0]) }}">View All</a>
                                    </div>
                                    <div class="owl-carousel learning_slider owl-theme">
                                        @forelse ($playlists_json as $key => $items)
                                        @foreach ($items['playlists']['items'] as $key=>$item)
                                        @if ($key==0)
                                        @if($items['type']==0)
                                        <div class="item">
                                            <div class="full-width">
                                                <div class="recent-items">
                                                    <div class="posts-list">
                                                        <div class="feed-shared-product-dt">
                                                            <div class="pdct-img crse-img-tt">
                                                                <a >
                                                                    <img class="ft-plus-square product-bg-w bg-cyan me-0"
                                                                        src="{{ $item->snippet->thumbnails->medium->url }}"
                                                                        alt="">
                                                                    <div class="overlay-item">
                                                                        <div class="badge-level trnd-clr">free
                                                                        </div>
                                                                        <div class="badge-timer">
                                                                            {{\Carbon\Carbon::parse($item->snippet->publishedAt)->diffForHumans()}}
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="author-dts pp-20">
                                                                <a
                                                                    class="job-heading pp-title">{{
                                                                    Str::limit($item->snippet->title, 50, $end = '....')
                                                                    }}</a>
                                                                <p class="notification-text font-small-4">
                                                                    by <a href="#"
                                                                    class="cmpny-dt blk-clr" style="color: {{$items['color']}}">{{$items['user']}}</a>
                                                                </p>
                                                                <p
                                                                    class="notification-text font-small-4 pt-1 catey-group">

                                                                    <i class="fa fa-tag"></i> {{$items['category']}}
                                                                </p>
                                                                <div class="ppdt-price-sales">
                                                                    <div class="ppdt-price">
                                                                        ৳ {{$items['price']}}
                                                                    </div>
                                                                    <div class="ppdt-sales">
                                                                        0 Sales
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="post-meta">
                                                        <div class="job-actions">
                                                            <div class="aplcnts_15">
                                                                <a href="{{ route('course.showcourse', ['id'=>$items['id']]) }}"
                                                                    class="view-btn btn-hover">Detail View</a>
                                                            </div>
                                                            <div class="action-btns-job">
                                                                <i class="feather-eye mr-2"></i>
                                                                {{$items['view_count']}}

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @endif

                                        @endforeach
                                        @empty
                                        <div class="alert alert-success">
                                            <strong>Sorry! No Data Found </strong>
                                        </div>
                                        @endforelse
                                        <div class="mt-3">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="learning_all_items mt-30">
                                    <div class="owl_title">
                                        <h4>Paid</h4>
                                        <a href="{{ route('course.freecourse', ['id'=>1]) }}">View All</a>
                                    </div>
                                    <div class="owl-carousel learning_slider owl-theme">
                                        @forelse ($playlists_json as $key => $items)
                                        @foreach ($items['playlists']['items'] as $key=>$item)
                                        @if ($key==0)
                                        @if($items['type']==1)
                                        <div class="item">
                                            <div class="full-width">
                                                <div class="recent-items">
                                                    <div class="posts-list">
                                                        <div class="feed-shared-product-dt">
                                                            <div class="pdct-img crse-img-tt">
                                                                <a >
                                                                    <img class="ft-plus-square product-bg-w bg-cyan me-0"
                                                                        src="{{ $item->snippet->thumbnails->medium->url }}"
                                                                        alt="">
                                                                    <div class="overlay-item">
                                                                        <div class="badge-level trnd-clr">Paid
                                                                        </div>
                                                                        <div class="badge-timer">
                                                                            {{\Carbon\Carbon::parse($item->snippet->publishedAt)->diffForHumans()}}
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="author-dts pp-20">
                                                                <a
                                                                    class="job-heading pp-title">{{
                                                                    Str::limit($item->snippet->title, 50, $end = '....')
                                                                    }}</a>
                                                                <p class="notification-text font-small-4">
                                                                    by <a href="#"
                                                                    class="cmpny-dt blk-clr" style="color: {{$items['color']}}">{{$items['user']}}</a>
                                                                </p>
                                                                <p
                                                                    class="notification-text font-small-4 pt-1 catey-group">

                                                                    <i class="fa fa-tag"></i> {{$items['category']}}
                                                                </p>
                                                                <div class="ppdt-price-sales">
                                                                    <div class="ppdt-price">
                                                                        ৳ {{$items['price']}}
                                                                    </div>
                                                                    <div class="ppdt-sales">
                                                                        0 Sales
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="post-meta">
                                                        <div class="job-actions">
                                                            <div class="aplcnts_15">
                                                                <a href="{{ route('course.showcourse', ['id'=>$items['id']]) }}"
                                                                    class="view-btn btn-hover">Detail View</a>
                                                            </div>
                                                            <div class="action-btns-job">
                                                                <i class="feather-eye mr-2"></i>
                                                                {{$items['view_count']}}

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @endif

                                        @endforeach
                                        @empty
                                        <div class="alert alert-success">
                                            <strong>Sorry! No Data Found </strong>
                                        </div>
                                        @endforelse
                                        <div class="mt-3">

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
</div>

<!--Add Course Model-->
<div class="modal fade" id="addcourse" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="container bg-white rounded">
                    <!--course Form-->
                    <form action="{{ route('course.get') }}" class="form p-3" id="corse" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group pt-2">
                            <label for="playlists_id">Playlist_Url</label>
                            <input type="text" id="playlists_id" class="form-control" placeholder="Playlist URL" name="playlists_id"
                                value="{{ old('playlists_id') }}">
                            <div class="text-danger mt-2 text-sm playlistserror">
                            </div>
                        </div>
                        <div class="form-group pt-2">
                            <label for="category">Category</label>
                            <input type="text" id="category" class="form-control" placeholder="Category" name="Category"
                                value="{{ old('Category') }}">
                            <div class="text-danger mt-2 text-sm categoryerror">
                            </div>
                        </div>
                        <div class="form-group pt-2">
                            <label for="file">File</label>
                            <input type="file" class="form-control" name="file"  accept=".doc,.docx,.pdf,.pptx,.zip,.rar" id="file" value="{{ old('file') }}"
                                placeholder="Upload image or pdf">
                            <div class="text-danger mt-2 text-sm fileError"></div>
                        </div>
                        <div class="form-group pt-2">
                            <label for="type">Course Type</label>
                            <select name="type" id="type" value="{{ old('type') }}" class="form-control">
                                <option selected disabled>Select type</option>
                                <option value="0">free</option>
                                <option value="1">Paid</option>
                            </select>
                            <div class="text-danger mt-2 text-sm type"></div>
                        </div>
                        <div id="price">

                        </div>
                        <button type="submit" @disabled($errors->isNotEmpty()) name="submit" class="post-link-btn btn-hover mt-3">Upload</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!--footer-->
@include('layouts.footer')
<!---/footer-->
<script>
    $('#type').change(function() {
        let value = `<div class="form-group pt-2"> <label for="price">Price</label><input type="number" required class="form-control" name="price"value="{{ old('price') }}"><div class="text-danger mt-2 text-sm price"></div></div>`;
        if ($('#type').val() == '1') {
            $('#price').append(value);
        } else {
            $('#price').empty();
        }
    });
</script>
