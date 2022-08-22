@include('layouts.header')
<header class="header clearfix">
    <div class="header-inner">
        <!--Top Menu-->
        @include('layouts.menu')
        <!--/Top Menu-->
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
                            <a class="nav-link active" href="">Product Details</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="event-content-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="prdct_dt_view">
                        <div class="pdct-img">
                            <img class="ft-plus-square product-bg-w bg-cyan br-10 mr-0" src="{{ $data->cover_pic }}"
                                alt="">
                        </div>
                        <div class="pdct-actions">
                            <i class="feather-eye mr-2"></i> <span>Views</span> {{$data->view_count}}
                        </div>
                    </div>
                    <div class="full-width mt-30">
                        <div class="item-description">
                            <div class="jobtxt47">
                                <h4>Description</h4>
                            </div>
                            <div class="jobtxt47">
                                {{$data->description}}
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="event-card rmt-30">
                        <div class="product_license_dts">
                            <ul class="evnt_cogs_list">
                                <li>
                                    <div class="product_license_check">
                                        <div class="course-price">Regular Price</div>
                                        <span class="item_price">$ {{$data->price}}</span>
                                    </div>
                                </li>
                              
                            </ul>
                           
                            <div class="item_buttons">
                                <form action="{{ route('bookorder.store', ['bid'=>$data->id]) }}" method="post">
                                    @csrf
                                    <div class="purchase_form_btn">
                                        <button class="add-cart-btn btn-hover" type="submit"><i
                                                class="feather-shopping-cart mr-2"></i>Add to Cart</button>
                                    </div>
                                </form>
                                <div class="purchase_form_btn">
                                    <form action="{{ route('bookorder.index')}}" method="get">
                                        <button class="buy-btn btn-hover" type="submit">Buy Now</button>
                                    </form>
                                </div>
                            </div>
                          
                        </div>
                    </div>

                    <div class="full-width mt-30">
                        <div class="user-profile">
                            <div class="author-info-dts">
                                <div class="media d-flex">
                                    <div class="job-left">
                                        <img class="ft-plus-square job-bg-circle bg-cyan mr-0"
                                            src="/storage/{{$data->user->image}}" alt="">
                                    </div>
                                    <div class="media-body">
                                        <a href="#" class="job-heading">{{$data->user->username}}</a>
                                        <p class="notification-text font-small-4">
                                            <span class="job-loca">Since: 2019</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-link">
                                <a href="#">View Products</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="learning_all_items mt-35">
                        <div class="owl_title">
                            <h4>Related Products</h4>
                            <a href="{{route('books.index')}}">View All</a>
                        </div>
                        <div class="owl-carousel related_courses_slider owl-theme">
                            @foreach ($data->inRandomOrder()->limit(5)->get() as $item)
                            <div class="item">
                                <div class="full-width">
                                    <div class="recent-items">
                                        <div class="posts-list">
                                            <div class="feed-shared-product-dt">
                                                <div class="pdct-img crse-img-tt">
                                                    <a href="course_detail_view.html">
                                                        <img class="ft-plus-square product-bg-w bg-cyan mr-0"
                                                            src="{{$item->cover_pic}}" alt="">
                                                        <div class="overlay-item">
                                                            <div class="badge-level trnd-clr">Trending</div>
                                                            <div class="badge-timer">
                                                                {{$item->created_at->diffForHumans()}}</div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="author-dts pp-20">
                                                    <a href="course_detail_view.html"
                                                        class="job-heading pp-title">{{$item->name}}</a>
                                                    <p class="notification-text font-small-4">
                                                        by <a href="#"
                                                            class="cmpny-dt blk-clr">{{$item->user->username}}</a>
                                                    </p>
                                                    <p class="notification-text font-small-4 pt-1 catey-group">
                                                        <a href="#" class="catey-dt">Web Development</a>
                                                        <a href="#" class="catey-sub">Python</a>
                                                    </p>
                                                    <div class="ppdt-price-sales">
                                                        <div class="ppdt-price">
                                                            $ {{$item->price}}
                                                        </div>
                                                        <div class="ppdt-sales">
                                                            72 Learners
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="post-meta">
                                            <div class="job-actions">
                                                <div class="aplcnts_15">
                                                    <a href="{{ route('books.showbook', ['id' => $item->id]) }}"
                                                        class="view-btn btn-hover">Detail
                                                        View</a>
                                                </div>
                                                <div class="action-btns-job">
                                                    <a href="#" class="crt-btn crt-btn-hover mr-2"><i
                                                            class="feather-shopping-cart"></i></a>
                                                    <a href="#" class="bm-btn bm-btn-hover active"><i
                                                            class="feather-bookmark"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--footer-->
@include('layouts.footer')
<!---/footer-->