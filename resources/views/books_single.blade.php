@section('title', 'Books_Single')
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
                            <a class="nav-link active">Book Details</a>
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
                    @if (session()->has('status'))
                        <div class="alert alert-success mt-3">
                            {{ session()->get('status') }}
                        </div>
                    @endif
                    @if (session()->has('success'))
                    <div class="fixed bg-green-600 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">
                        <p>{{ session()->get('success') }}</p>
                    </div>
                    @endif
                    <div class="prdct_dt_view">
                        <div class="pdct-img">
                            <img class="ft-plus-square product-bg-w bg-cyan br-10 mr-0" src="{{ $data->cover_pic }}"
                                alt="">
                        </div>
                        <div class="pdct-actions">
                            <i class="feather-eye mr-2"></i> <span>Views</span> {{ $data->view_count }}
                        </div>
                    </div>
                    <!--description section-->
                    <div class="full-width mt-30">
                        <div class="item-description">
                            <div class="jobtxt47">
                                <h4>Description</h4>
                            </div>
                            <div class="jobtxt47">
                                {{ $data->description }}
                            </div>
                        </div>
                    </div>
                    <!--/description section-->
                    <!--Reviews-->
                    <div class="full-width mt-30">
                        <div class="event-card mt-4">
                            <div class="jobdt99">
                                <div class="jbdes25">
                                    <div class="jobtxt47">
                                        <h4>Reviews</h4>
                                        <hr>
                                        <!--review Section-->

                                        <h3 class="mb-3">{{ $data->bookreview->count() }} Reviews
                                        </h3>
                                        @foreach ($reviews as $item)
                                            <div class="review-card mt-4">
                                                <div class="review-content">
                                                    <div class="review-head">
                                                        <div class="review-rating-stars">
                                                            @if ($item->rating == 1)
                                                                <div class="item-rating-stars">
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="feather-star color-gray-medium"></i>
                                                                    <i class="feather-star color-gray-medium"></i>
                                                                    <i class="feather-star color-gray-medium"></i>
                                                                    <i class="feather-star color-gray-medium"></i>
                                                                </div>
                                                            @elseif ($item->rating == 2)
                                                                <div class="item-rating-stars">
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="feather-star "></i>
                                                                    <i class="feather-star color-gray-medium"></i>
                                                                    <i class="feather-star color-gray-medium"></i>
                                                                    <i class="feather-star color-gray-medium"></i>
                                                                </div>
                                                            @elseif ($item->rating == 3)
                                                                <div class="item-rating-stars">
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="feather-star "></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="feather-star color-gray-medium"></i>
                                                                    <i class="feather-star color-gray-medium"></i>
                                                                </div>
                                                            @elseif ($item->rating == 4)
                                                                <div class="item-rating-stars">
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="feather-star "></i>
                                                                    <i class="feather-star "></i>
                                                                    <i class="feather-star "></i>
                                                                    <i class="feather-star color-gray-medium"></i>
                                                                </div>
                                                            @elseif ($item->rating == 5)
                                                                <div class="item-rating-stars">
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="feather-star "></i>
                                                                    <i class="feather-star "></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <span class="rating-time-posting"><i
                                                                class="feather-clock me-2"></i>{{ $item->created_at->diffForHumans() }}</span>
                                                    </div>
                                                    <div class="rating-by">
                                                        by:
                                                        <a href="#" class="ms-2">
                                                            <div class="ttlcnt15 invtbyuser">
                                                                <div class="invited_avtar_ee">
                                                                    <img class="ft-plus-square evnt-invite-circle bg-cyan me-0"
                                                                        src="/storage/{{ $item->user->image }}"
                                                                        alt="">
                                                                </div>
                                                                <span class="evntcunt"
                                                                    style="color: {{ $item->user->role->color->name }}">{{ $item->user->username }}</span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="rating_descp">
                                                        <p>{{ $item->description }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="m-5">
                                            {{ $reviews->links() }}
                                        </div>
                                        <hr>

                                        <!-- END review-list -->
                                        @if (Auth()->id() != $data->user_id && @$data->is_sold($data->id) == true)

                                            <!--review form-->
                                            <form method="POST"
                                                class="@foreach ($data->bookreview as $item) @if ($item->user_id == Auth()->id()) d-none @endif @endforeach"
                                                action="{{ route('books.storereview') }}">
                                                @if ($errors->any())
                                                    @foreach ($errors->all() as $error)
                                                        <div class="alert alert-danger mt-3">
                                                            {{ $error }}
                                                        </div>
                                                    @endforeach
                                                @endif
                                                @csrf
                                                <input type="hidden" name="book_user" value="{{ $data->user_id }}">
                                                <input type="hidden" name="book_id" value="{{ $data->id }}">
                                                <div class="mt-30">
                                                    <div class="rating-container">
                                                        <div class="rating-text">
                                                            <p>How satisfied are you with US?</p>
                                                        </div>
                                                        <div class="rating">
                                                            <div class="rating-form">
                                                                <label for="super-sad" data-toggle="tooltip"
                                                                    data-placement="bottom" title="Super Sad">
                                                                    <input type="radio" name="rating"
                                                                        class="super-sad" id="super-sad"
                                                                        value="1">
                                                                    <svg viewBox="0 0 24 24">
                                                                        <path
                                                                            d="M12,2C6.47,2 2,6.47 2,12C2,17.53 6.47,22 12,22A10,10 0 0,0 22,12C22,6.47 17.5,2 12,2M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20M16.18,7.76L15.12,8.82L14.06,7.76L13,8.82L14.06,9.88L13,10.94L14.06,12L15.12,10.94L16.18,12L17.24,10.94L16.18,9.88L17.24,8.82L16.18,7.76M7.82,12L8.88,10.94L9.94,12L11,10.94L9.94,9.88L11,8.82L9.94,7.76L8.88,8.82L7.82,7.76L6.76,8.82L7.82,9.88L6.76,10.94L7.82,12M12,14C9.67,14 7.69,15.46 6.89,17.5H17.11C16.31,15.46 14.33,14 12,14Z" />
                                                                    </svg>
                                                                </label>
                                                                <label for="sad" data-toggle="tooltip"
                                                                    data-placement="bottom" title="Sad">
                                                                    <input type="radio" name="rating"
                                                                        class="sad" id="sad" value="2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                        version="1.1" width="100%" height="100%"
                                                                        viewBox="0 0 24 24">
                                                                        <path
                                                                            d="M20,12A8,8 0 0,0 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12M22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2A10,10 0 0,1 22,12M15.5,8C16.3,8 17,8.7 17,9.5C17,10.3 16.3,11 15.5,11C14.7,11 14,10.3 14,9.5C14,8.7 14.7,8 15.5,8M10,9.5C10,10.3 9.3,11 8.5,11C7.7,11 7,10.3 7,9.5C7,8.7 7.7,8 8.5,8C9.3,8 10,8.7 10,9.5M12,14C13.75,14 15.29,14.72 16.19,15.81L14.77,17.23C14.32,16.5 13.25,16 12,16C10.75,16 9.68,16.5 9.23,17.23L7.81,15.81C8.71,14.72 10.25,14 12,14Z" />
                                                                    </svg>
                                                                </label>
                                                                <label for="neutral" data-toggle="tooltip"
                                                                    data-placement="bottom" title="Neutral">
                                                                    <input type="radio" name="rating"
                                                                        class="neutral" id="neutral"
                                                                        value="3">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                        version="1.1" width="100%" height="100%"
                                                                        viewBox="0 0 24 24">
                                                                        <path
                                                                            d="M8.5,11A1.5,1.5 0 0,1 7,9.5A1.5,1.5 0 0,1 8.5,8A1.5,1.5 0 0,1 10,9.5A1.5,1.5 0 0,1 8.5,11M15.5,11A1.5,1.5 0 0,1 14,9.5A1.5,1.5 0 0,1 15.5,8A1.5,1.5 0 0,1 17,9.5A1.5,1.5 0 0,1 15.5,11M12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22C6.47,22 2,17.5 2,12A10,10 0 0,1 12,2M9,14H15A1,1 0 0,1 16,15A1,1 0 0,1 15,16H9A1,1 0 0,1 8,15A1,1 0 0,1 9,14Z" />
                                                                    </svg>
                                                                </label>
                                                                <label for="happy" data-toggle="tooltip"
                                                                    data-placement="bottom" title="Happy">
                                                                    <input type="radio" name="rating"
                                                                        class="happy" id="happy" value="4">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                        version="1.1" width="100%" height="100%"
                                                                        viewBox="0 0 24 24">
                                                                        <path
                                                                            d="M20,12A8,8 0 0,0 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12M22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2A10,10 0 0,1 22,12M10,9.5C10,10.3 9.3,11 8.5,11C7.7,11 7,10.3 7,9.5C7,8.7 7.7,8 8.5,8C9.3,8 10,8.7 10,9.5M17,9.5C17,10.3 16.3,11 15.5,11C14.7,11 14,10.3 14,9.5C14,8.7 14.7,8 15.5,8C16.3,8 17,8.7 17,9.5M12,17.23C10.25,17.23 8.71,16.5 7.81,15.42L9.23,14C9.68,14.72 10.75,15.23 12,15.23C13.25,15.23 14.32,14.72 14.77,14L16.19,15.42C15.29,16.5 13.75,17.23 12,17.23Z" />
                                                                    </svg>
                                                                </label>
                                                                <label for="super-happy" data-toggle="tooltip"
                                                                    data-placement="bottom" title="Super Happy">
                                                                    <input type="radio" name="rating"
                                                                        class="super-happy" id="super-happy"
                                                                        value="5">
                                                                    <svg viewBox="0 0 24 24">
                                                                        <path
                                                                            d="M12,17.5C14.33,17.5 16.3,16.04 17.11,14H6.89C7.69,16.04 9.67,17.5 12,17.5M8.5,11A1.5,1.5 0 0,0 10,9.5A1.5,1.5 0 0,0 8.5,8A1.5,1.5 0 0,0 7,9.5A1.5,1.5 0 0,0 8.5,11M15.5,11A1.5,1.5 0 0,0 17,9.5A1.5,1.5 0 0,0 15.5,8A1.5,1.5 0 0,0 14,9.5A1.5,1.5 0 0,0 15.5,11M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20M12,2C6.47,2 2,6.5 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                                                                    </svg>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form_group mt-30">
                                                    <label class="label25">What do you like most?*</label>
                                                    <textarea class="form_textarea_1 bg-light" name="description" placeholder=""></textarea>
                                                </div>

                                                <div class="submit_btn">
                                                    <button type="submit" @disabled($errors->isNotEmpty())  class="main-btn color btn-hover"
                                                        data-ripple="">Send
                                                        Review</button>
                                                </div>
                                            </form>
                                            <!--end review form-->

                                        @endif
                                        <!--close comments section-->
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end Review section-->
                    <!--download book section-->
                    {{-- @if (@$data->is_sold($data->user_id, $data->id) == true)

                    <div class="full-width mt-30">
                        <div class="item-description">
                            <div class="jobtxt47">
                                <h4>download Book</h4>
                                <a href="{{ $data->book }}"
                                    download="{{ $data->book_name }}">{{ $data->book_name }}</a>
                                </div>
                            </div>
                        </div>
                    @endif --}}
                        <!--/download book section-->
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="event-card rmt-30">
                        <div class="product_license_dts">
                            <ul class="evnt_cogs_list">
                                <li>
                                    <div class="product_license_check">
                                        <div class="course-price">Regular Price</div>
                                        <span class="item_price">৳ {{ $data->price }}</span>
                                    </div>
                                </li>

                            </ul>

                            <div class="item_buttons">
                                {{-- <div class="purchase_form_btn">
                                    <form action="" method="get">
                                        <button class="buy-btn btn-hover" type="submit">Buy Now</button>
                                    </form>
                                </div> --}}
                                {{-- <input class="reqId" type="hidden" name="reqid"
                                value="{{ $data->id }}" > --}}
                                @if(auth()->id() != $data->user_id && auth()->user()->block != 1)
                                @if(!$data->isPurchase )
                                <div class="purchase_form_btn">
                                    <a href="javascript:void(0)"
                                    class="payNow "
                                    data-id="{{ $data->id }}"
                                    data-amount="{{ $data->price }}"
                                    data-resource="books"
                                    data-seller="{{ $data->user_id }}"
                                    >
                                    <input type="hidden" name="request_id" value="{{ $data->id }}">
                                        <button class="buy-btn btn-hover" type="submit">Buy Now</button>
                                    </a>
                                </div>
                                @else
                                <div class="purchase_form_btn">
                                    <a href="javascript:void(0)"
                                    >
                                        <button class="buy-btn btn-hover btn-success" type="button">Already Purchased</button>
                                    </a>
                                </div>
                                @endif
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="event-card mt-30">
                        <div class="product_total_stats">
                            <strong class="product_total_numberic">
                                <span class="product_stats_icon"><i class="feather-shopping-cart"></i></span>150
                            </strong>
                            <span class="product_stats_label">Students enrolled</span>
                        </div>
                    </div>
                    <div class="full-width mt-4">
                        <div class="user-profile">
                            <div class="username-dt dpbg-1">
                                <div class="usr-pic">
                                    <img src="/storage/{{ $data->user->image }}" alt="">
                                </div>
                            </div>
                            <div class="username-main-dt">
                                <h4 style="color: {{ $data->user->role->color->name }}">{{ $data->user->username }}
                                </h4>
                            </div>
                            <div class="user-info__sections">
                                <ul class="info__sections">
                                    <li>
                                        <div class="all-info__sections">
                                            <span class="all-info__left">Post Requests</span>
                                            <span class="all-info__right">{{ $data->user->request->count() }}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="all-info__sections">
                                            <span class="all-info__left">Tutorial</span>
                                            <span class="all-info__right">{{ $data->user->playlist->count() }}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="all-info__sections">
                                            <span class="all-info__left">Courses</span>
                                            <span class="all-info__right">{{ $data->user->course->count() }}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="profile-link">
                                <a href="{{ route('profile.show', ['id' => $data->user_id]) }}">View Detail</a>
                            </div>
                        </div>
                    </div>
                    <div class="full-width mt-30">
                        <div class="headtte14m">
                            <h4>Item Rating</h4>
                        </div>
                        <div class="item-rating-stars-dts">
                            @if ($data->rating == 0)
                                <div class="item-rating-stars">
                                    <i class="feather-star color-gray-medium"></i>
                                    <i class="feather-star color-gray-medium"></i>
                                    <i class="feather-star color-gray-medium"></i>
                                    <i class="feather-star color-gray-medium"></i>
                                    <i class="feather-star color-gray-medium"></i>
                                </div>
                            @elseif ($data->rating >= 1 && $data->rating < 2)
                                <div class="item-rating-stars">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="feather-star color-gray-medium"></i>
                                    <i class="feather-star color-gray-medium"></i>
                                    <i class="feather-star color-gray-medium"></i>
                                    <i class="feather-star color-gray-medium"></i>
                                </div>
                            @elseif ($data->rating >= 2 && $data->rating < 3)
                                <div class="item-rating-stars">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="feather-star color-gray-medium"></i>
                                    <i class="feather-star color-gray-medium"></i>
                                    <i class="feather-star color-gray-medium"></i>
                                </div>
                            @elseif ($data->rating >= 3 && $data->rating < 4)
                                <div class="item-rating-stars">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="feather-star color-gray-medium"></i>
                                    <i class="feather-star color-gray-medium"></i>
                                </div>
                            @elseif ($data->rating >= 4 && $data->rating < 5)
                                <div class="item-rating-stars">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="feather-star color-gray-medium"></i>
                                </div>
                            @elseif ($data->rating == 5)
                                <div class="item-rating-stars">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                            @endif
                            <p class="rating_text">{{ $data->rating }} average based on 5 ratings.</p>
                        </div>
                    </div>

                </div>
                <!--related Books-->
                <div class="col-lg-12 col-md-12">
                    <div class="learning_all_items mt-35">
                        <div class="owl_title">
                            <h4>Related Books</h4>
                            <a href="{{ route('books.index') }}">View All</a>
                        </div>
                        <div class="owl-carousel related_courses_slider owl-theme">
                            @foreach ($data->inRandomOrder()->limit(5)->get() as $item)
                                <div class="item">
                                    <div class="full-width">
                                        <div class="recent-items">
                                            <div class="posts-list">
                                                <div class="feed-shared-product-dt">
                                                    <div class="pdct-img crse-img-tt">
                                                        <a>
                                                            <img class="ft-plus-square product-bg-w bg-cyan mr-0"
                                                                src="{{ $item->cover_pic }}" alt="">
                                                            <div class="overlay-item">
                                                                <div class="badge-timer">
                                                                    {{ $item->created_at->diffForHumans() }}</div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="author-dts pp-20">
                                                        <a class="job-heading pp-title">{{ $item->title }}</a>
                                                        <p class="notification-text font-small-4">
                                                            by <a href="#" class="cmpny-dt blk-clr"
                                                                style="color: {{ $item->user->role->color->name }}">{{ $item->user->username }}</a>
                                                        </p>
                                                        <p class="notification-text font-small-4 pt-1 catey-group">
                                                            <a href="#"
                                                                class="catey-sub">{{ $item->Category }}</a>
                                                        </p>
                                                        <div class="ppdt-price-sales">
                                                            <div class="ppdt-price">
                                                                ৳ {{ $item->price }}
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
                                                        <a href="{{ route('books.showbook', ['id' => $item->id]) }}"
                                                            class="view-btn btn-hover">Detail
                                                            View</a>
                                                    </div>
                                                    <div class="action-btns-job">
                                                        <i class="fa fa-eye"></i>
                                                        {{ $item->view_count }}
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
                <!--/related Books-->
            </div>
        </div>
    </div>
</div>
<input type="hidden" class="reqId" value="{{ $data->id }}" />
<!--footer-->
@include('layouts.footer')
<!---/footer-->
<script src="{{ asset('asset/js/bkashpayment.js') }}"></script>
<link rel="stylesheet" href="{{ asset('asset/css/paymentBkash.css') }}">
