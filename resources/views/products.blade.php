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

                    <div class="posted_1590">
                        <div class="count-ttl">{{$books->count() + $products->count()}}</div>
                        <div class="cate-post">Products and Books</div>
                    </div>
                    <div class="manage-section">
                        <span class="manage-title">Manage My Learning</span>
                    </div>
                    <ul class="info__sections">
                        <li>
                            <a href="my_courses.html" class="all-info__sections">
                                <span class="all-info__left"><i class="feather-grid me-2"></i>My books</span>
                                <span class="all-info__right">{{$books->where('user_id',Auth()->id())->count()}}</span>
                            </a>
                        </li>
                        <li>
                            <a href="my_courses.html" class="all-info__sections">
                                <span class="all-info__left"><i class="feather-grid me-2"></i>My Products</span>
                                <span
                                    class="all-info__right">{{$products->where('user_id',Auth()->id())->count()}}</span>
                            </a>
                        </li>

                        <li>
                            <a href="purchased_courses.html" class="all-info__sections">
                                <span class="all-info__left"><i class="feather-download me-2"></i>Purchased</span>
                                <span class="all-info__right">0</span>
                            </a>
                        </li>
                    </ul>
                </div>



            </div>
            <div class="col-xl-9 col-lg-8 col-md-12">
                <div class="pl_item_search mt-30 mt-lg-0">
                    <form action="{{ route('marketplace.search') }}" method="post">
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
                                <button class="post-link-btn color btn-hover w-100 rmt-10" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="all-items">
                    <div class="product-items-list">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="learning_all_items mt-30">
                                    <div class="owl_title">
                                        <h4>Books</h4>
                                        <a href="{{route('books.index')}}">View All</a>
                                    </div>
                                    <div class="owl-carousel learning_slider owl-theme">

                                        @forelse ($books->take(6) as $book)
                                        <div class="item">
                                            <div class="full-width">
                                                <div class="recent-items">
                                                    <div class="posts-list">
                                                        <div class="feed-shared-product-dt">
                                                            <div class="pdct-img crse-img-tt">
                                                                <a href="course_detail_view.html">
                                                                    <img class="ft-plus-square product-bg-w bg-cyan me-0"
                                                                        src="{{$book->cover_pic}}" alt="">
                                                                    <div class="overlay-item">
                                                                        <div class="badge-timer">
                                                                            {{$book->created_at->diffForHumans()}}</div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="author-dts pp-20">
                                                                <a href="course_detail_view.html"
                                                                    class="job-heading pp-title">{{$book->book_name}}</a>
                                                                <p class="notification-text font-small-4">
                                                                    by <a href="#"
                                                                        class="cmpny-dt blk-clr">{{$book->user->username}}</a>
                                                                </p>

                                                                <div class="ppdt-price-sales">
                                                                    <div class="ppdt-price">
                                                                        $ {{$book->price}}
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
                                                                <a href="{{ route('books.showbook', ['id' => $book->id]) }}"
                                                                    class="view-btn btn-hover">Detail View</a>
                                                            </div>
                                                            <div class="action-btns-job">
                                                                <i class="fa fa-eye"></i>
                                                                {{$book->view_count}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                               
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-items-list">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="learning_all_items">
                                    <div class="owl_title">
                                        <h4>Products</h4>
                                        <a href="{{route('product.index')}}">View All</a>
                                    </div>
                                    <div class="owl-carousel newest_slider owl-theme">
                                        @forelse ($products->take(6) as $product)
                                        <div class="item">
                                            <div class="full-width">
                                                <div class="recent-items">
                                                    <div class="posts-list">
                                                        <div class="feed-shared-product-dt">
                                                            <div class="pdct-img crse-img-tt">
                                                                <a href="course_detail_view.html">
                                                                    <img class="ft-plus-square product-bg-w bg-cyan me-0"
                                                                        src="{{$product->cover_pic}}" alt="">
                                                                    <div class="overlay-item">
                                                                        <div class="badge-timer">
                                                                            {{$product->created_at->diffForHumans()}}
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="author-dts pp-20">
                                                                <a href="course_detail_view.html"
                                                                    class="job-heading pp-title">{{$product->name}}</a>
                                                                <p class="notification-text font-small-4">
                                                                    by <a href="#"
                                                                        class="cmpny-dt blk-clr">{{$product->user->username}}</a>
                                                                </p>

                                                                <div class="ppdt-price-sales">
                                                                    <div class="ppdt-price">
                                                                        $ {{$product->price}}
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
                                                                <a href="{{ route('product.showproduct', ['id' => $product->id]) }}"
                                                                    class="view-btn btn-hover">Detail View</a>
                                                            </div>
                                                            <div class="action-btns-job">
                                                                <i class="fa fa-eye"></i>
                                                                {{$product->view_count}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                    
                                        @endforelse


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



<!--footer-->
@include('layouts.footer')
<!---/footer-->