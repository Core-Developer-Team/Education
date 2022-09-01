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
                        <a href="" class="post-link-btn btn-hover" data-bs-toggle="modal"
                            data-bs-target=" @auth
                        #addbook
@else
#loginlink
                        @endauth ">Add
                            New Book</a>
                    </div>
                    <div class="posted_1590">
                        <div class="count-ttl">{{ $data->count() }}</div>
                        <div class="cate-post">Added Books</div>
                    </div>
                    <div class="manage-section">
                        <span class="manage-title">Manage By Shop</span>
                    </div>
                    <ul class="info__sections">
                        <li>
                            <a href="" class="all-info__sections">
                                <span class="all-info__left"><i class="feather-grid me-2"></i>My books</span>
                                <span
                                    class="all-info__right">{{ $data->where('user_id', Auth()->id())->count() }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="" class="all-info__sections">
                                <span class="all-info__left"><i class="feather-download me-2"></i>Purchased</span>
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
                                    onclick="window.location.href='{{ route('course.index') }}'">See Courses</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-12">
                <div class="pl_item_search rrmt-30">
                    <form action="{{ route('book.search') }}" method="post">
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
                                    <a href="{{ route('book.latest') }}" class="fltr-btn fltr-active">Newest</a>
                                    <a href="" class="fltr-btn">Trending</a>
                                    <a href="{{ route('book.week') }}" class="fltr-btn">Weekly</a>
                                </div>
                                <button class="flter-btn2 pull-bs-canvas-left">Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="all-items">
                    <div class="product-items-list">
                        <div class="row">
                            @forelse ($data as $item)
                                <div class="col-xl-4 col-lg-6 col-md-6">
                                    <div class="full-width mt-4">
                                        <div class="recent-items">
                                            <div class="posts-list">
                                                <div class="feed-shared-product-dt">
                                                    <div class="pdct-img">
                                                        <a href="product_detail_view.html"><img
                                                                class="ft-plus-square product-bg-w bg-cyan me-0"
                                                                src="{{ $item->cover_pic }}" alt="">
                                                            <div class="overlay-item">
                                                                <div class="badge-timer">
                                                                    {{ $item->created_at->diffForHumans() }}
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="author-dts pp-20">
                                                        <a href="product_detail_view.html"
                                                            class="job-heading pp-title">{{ $item->book_name }}</a>

                                                        <div class="ppdt-price-sales">
                                                            <div class="ppdt-price">
                                                                $ {{ $item->price }}
                                                            </div>
                                                            <div class="ppdt-sales">
                                                                314 Sales
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
                                                       <i class="fas fa-eye"></i> {{$item->view_count}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                          
                            @endforelse
                            <div class="mt-3">
                                {{ $data->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Add Book Model-->
<div class="modal fade" id="addbook" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Book for Sell or Rent</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container bg-white rounded">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <!--book Form-->
                    <form action="{{ route('books.store') }}" class="form p-3" id="bok" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="price">Book_Price</label>
                            <input type="number" id="price" class="form-control" name="price"
                                value="{{ old('price') }}">
                            <div class="text-danger mt-2 text-sm priceerror"></div>
                        </div>
                        <div class="form-group pt-2">
                            <label for="category">Category</label>
                            <input type="text" id="category" class="form-control" name="Category"
                                value="{{ old('Category') }}">
                            <div class="text-danger mt-2 text-sm categoryerror">
                            </div>
                        </div>
                        <div class="form-group pt-2">
                            <label for="cover-pic">Book_Cover_Image</label>
                            <input type="file" id="cover-pic" class="form-control" accept="image/*"
                                name="cover_pic" value="{{ old('cover-pic') }}">
                            <div class="text-danger mt-2 text-sm cover_picError"></div>
                        </div>
                        <div class="form-group pt-2">
                            <label for="book">Upload_Book</label>
                            <input type="file" id="book" class="form-control" name="book"
                                accept="image/*,.doc,.docx,.pdf,.pptx" value="{{ old('book') }}">
                            <div class="text-danger mt-2 text-sm bookError"></div>
                        </div>
                        <div class="form-group pt-2">
                            <label for="desc">Description</label>
                            <textarea id="desc" class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
                            <div class="text-danger mt-2 text-sm description"></div>
                        </div>
                        <hr>
                        <button type="submit" name="submit" value="submit"
                            class="post-link-btn btn-hover mt-2">Upload</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!--footer-->
@include('layouts.footer')
<!---/footer-->
