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
                            <a class="nav-link active" href="">Course Details</a>
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
                    <div class="prdct_dt_view">
                        <div class="pdct-img">
                            <iframe width="560" height="315"
                                src="https://www.youtube.com/embed/{{ $playlist_data['items'][0]->snippet->resourceId->videoId }}"
                                title="YouTube video player" frameborder="0"
                                class="ft-plus-square product-bg-w bg-cyan br-10 mr-0 mainvid"
                                allow="accelerometer; autoplay; clipboard-write;  gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                        <div class="learning_all_items mt-35">
                            <div class="owl-carousel related_courses_slider owl-theme">
                                @foreach ($playlist_data['items'] as $key => $item)
                                    <div class="item lists">
                                        <div class="full-width">
                                            <div class="recent-items">
                                                <div class="posts-list">
                                                    <div class="feed-shared-product-dt">
                                                        <div class="pdct-img crse-img-tt ">
                                                            <a>
                                                                <iframe
                                                                    src="https://www.youtube.com/embed/{{ $item->snippet->resourceId->videoId }}"
                                                                    frameborder="0" class="d-none vid"></iframe>
                                                                <img class="ft-plus-square product-bg-w bg-cyan mr-0"
                                                                    src="{{ $item->snippet->thumbnails->medium->url }}"
                                                                    alt="">
                                                            </a>
                                                        </div>
                                                        <div class="author-dts pp-20">
                                                            <a href="course_detail_view.html"
                                                                class="job-heading pp-title">{{ Str::limit($item->snippet->title, 20, $end = '....') }}</a>
                                                            <div class="dex d-none">
                                                                {{ $item->snippet->description }}
                                                            </div>
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
                    <div class="full-width mt-30">
                        <div class="item-description">
                            <div class="jobtxt47">
                                <h4>Description</h4>
                                <div class="desc">
                                    {{ $playlist_data['items'][0]->snippet->description }}
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--file-->
                    @if (!$playlist->file == '')
                        <div class="full-width mt-30">
                            <div class="item-description">
                                <div class="jobtxt47">
                                    <h4>Download file from here</h4>
                                    <hr>
                                    <a href="{{ $playlist->file }}" download>download here</a>
                                </div>

                            </div>
                        </div>
                    @endif
                    <!--Reviews-->
                    <div class="full-width mt-30">
                        <div class="event-card mt-4">
                            <div class="jobdt99">
                                <div class="jbdes25">
                                    <div class="jobtxt47">
                                        <h4>Reviews</h4>
                                        <hr>
                                        <!--review Section-->

                                        <h3 class="mb-3">{{ $playlist->coursereview->count() }} Reviews
                                        </h3>
                                        @foreach ($reviews as $item)
                                            <div class="review-card mt-4">
                                                <div class="review-content">
                                                    <div class="review-head">
                                                        <div class="review-rating-stars">
                                                            @if ($item->rating == 1)
                                                                <div class="item-rating-stars">
                                                                    <i class="feather-star"></i>
                                                                    <i class="feather-star color-gray-medium"></i>
                                                                    <i class="feather-star color-gray-medium"></i>
                                                                    <i class="feather-star color-gray-medium"></i>
                                                                    <i class="feather-star color-gray-medium"></i>
                                                                </div>
                                                            @elseif ($item->rating == 2)
                                                                <div class="item-rating-stars">
                                                                    <i class="feather-star"></i>
                                                                    <i class="feather-star "></i>
                                                                    <i class="feather-star color-gray-medium"></i>
                                                                    <i class="feather-star color-gray-medium"></i>
                                                                    <i class="feather-star color-gray-medium"></i>
                                                                </div>
                                                            @elseif ($item->rating == 3)
                                                                <div class="item-rating-stars">
                                                                    <i class="feather-star"></i>
                                                                    <i class="feather-star "></i>
                                                                    <i class="feather-star"></i>
                                                                    <i class="feather-star color-gray-medium"></i>
                                                                    <i class="feather-star color-gray-medium"></i>
                                                                </div>
                                                            @elseif ($item->rating == 4)
                                                                <div class="item-rating-stars">
                                                                    <i class="feather-star"></i>
                                                                    <i class="feather-star "></i>
                                                                    <i class="feather-star "></i>
                                                                    <i class="feather-star "></i>
                                                                    <i class="feather-star color-gray-medium"></i>
                                                                </div>
                                                            @elseif ($item->rating == 5)
                                                                <div class="item-rating-stars">
                                                                    <i class="feather-star"></i>
                                                                    <i class="feather-star "></i>
                                                                    <i class="feather-star "></i>
                                                                    <i class="feather-star"></i>
                                                                    <i class="feather-star"></i>
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

                                        <!--review form-->
                                        <form method="POST" action="{{ route('course.storereview') }}">
                                            @if ($errors->any())
                                                @foreach ($errors->all() as $error)
                                                    <div class="alert alert-danger mt-3">
                                                        {{ $error }}
                                                    </div>
                                                @endforeach
                                            @endif
                                            @csrf
                                            <input type="hidden" name="course_id" value="{{ $playlist->id }}">
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
                                                                    class="super-sad" id="super-sad" value="1">
                                                                <svg viewBox="0 0 24 24">
                                                                    <path
                                                                        d="M12,2C6.47,2 2,6.47 2,12C2,17.53 6.47,22 12,22A10,10 0 0,0 22,12C22,6.47 17.5,2 12,2M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20M16.18,7.76L15.12,8.82L14.06,7.76L13,8.82L14.06,9.88L13,10.94L14.06,12L15.12,10.94L16.18,12L17.24,10.94L16.18,9.88L17.24,8.82L16.18,7.76M7.82,12L8.88,10.94L9.94,12L11,10.94L9.94,9.88L11,8.82L9.94,7.76L8.88,8.82L7.82,7.76L6.76,8.82L7.82,9.88L6.76,10.94L7.82,12M12,14C9.67,14 7.69,15.46 6.89,17.5H17.11C16.31,15.46 14.33,14 12,14Z" />
                                                                </svg>
                                                            </label>
                                                            <label for="sad" data-toggle="tooltip"
                                                                data-placement="bottom" title="Sad">
                                                                <input type="radio" name="rating" class="sad"
                                                                    id="sad" value="2">
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
                                                                <input type="radio" name="rating" class="neutral"
                                                                    id="neutral" value="3">
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
                                                                <input type="radio" name="rating" class="happy"
                                                                    id="happy" value="4">
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
                                                <button type="submit" class="main-btn color btn-hover"
                                                    data-ripple="">Send
                                                    Review</button>
                                            </div>
                                        </form>
                                        <!--end review form-->

                                        <!--close comments section-->
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end Review section-->
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="event-card rmt-30">
                        <div class="product_license_dts">
                            <ul class="evnt_cogs_list">
                                <li>
                                    <div class="product_license_check">
                                        <div class="course-price">Regular Price</div>
                                        <span class="item_price">$ {{ $playlist->price }}</span>
                                    </div>
                                </li>
                            </ul>
                            <div class="item_buttons">
                                <div class="purchase_form_btn">
                                    <button class="buy-btn btn-hover" type="submit">Buy Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="event-card mt-30">
                        <div class="product_total_stats">
                            <strong class="product_total_numberic">
                                <span class="product_stats_icon"><i
                                        class="fa fa-video-camera"></i></span>{{ count($playlist_data['items']) }}
                            </strong>
                            <span class="product_stats_label">Videos</span>
                        </div>
                    </div>
                    <div class="full-width mt-4">
                        <div class="user-profile">
                            <div class="username-dt dpbg-1">
                                <div class="usr-pic">
                                    <img src="/storage/{{ $playlist->user->image }}" alt="">
                                </div>
                            </div>
                            <div class="username-main-dt">
                                <h4 style="color: {{ $playlist->user->role->color->name }}">
                                    {{ $playlist->user->username }}</h4>
                            </div>
                            <div class="user-info__sections">
                                <ul class="info__sections">
                                    <li>
                                        <div class="all-info__sections">
                                            <span class="all-info__left">Post Requests</span>
                                            <span
                                                class="all-info__right">{{ $playlist->user->request->count() }}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="all-info__sections">
                                            <span class="all-info__left">Tutorial</span>
                                            <span
                                                class="all-info__right">{{ $playlist->user->playlist->count() }}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="all-info__sections">
                                            <span class="all-info__left">Courses</span>
                                            <span
                                                class="all-info__right">{{ $playlist->user->course->count() }}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="profile-link">
                                <a href="{{ route('profile.show', ['id' => $playlist->user_id]) }}">View Detail</a>
                            </div>
                        </div>
                    </div>
                    <div class="full-width mt-30">
                        <div class="headtte14m">
                            <h4>Course Rating</h4>
                        </div>
                        <div class="item-rating-stars-dts">
                            <div class="item-rating-stars-dts">
                                @if ($playlist->rating == 0)
                                    <div class="item-rating-stars">
                                        <i class="feather-star color-gray-medium"></i>
                                        <i class="feather-star color-gray-medium"></i>
                                        <i class="feather-star color-gray-medium"></i>
                                        <i class="feather-star color-gray-medium"></i>
                                        <i class="feather-star color-gray-medium"></i>
                                    </div>
                                @elseif ($playlist->rating >= 1 && $playlist->rating < 2)
                                    <div class="item-rating-stars">
                                        <i class="feather-star"></i>
                                        <i class="feather-star color-gray-medium"></i>
                                        <i class="feather-star color-gray-medium"></i>
                                        <i class="feather-star color-gray-medium"></i>
                                        <i class="feather-star color-gray-medium"></i>
                                    </div>
                                @elseif ($playlist->rating >= 2 && $playlist->rating < 3)
                                    <div class="item-rating-stars">
                                        <i class="feather-star"></i>
                                        <i class="feather-star"></i>
                                        <i class="feather-star color-gray-medium"></i>
                                        <i class="feather-star color-gray-medium"></i>
                                        <i class="feather-star color-gray-medium"></i>
                                    </div>
                                @elseif ($playlist->rating >= 3 && $playlist->rating < 4)
                                    <div class="item-rating-stars">
                                        <i class="feather-star"></i>
                                        <i class="feather-star"></i>
                                        <i class="feather-star"></i>
                                        <i class="feather-star color-gray-medium"></i>
                                        <i class="feather-star color-gray-medium"></i>
                                    </div>
                                @elseif ($playlist->rating >= 4 && $playlist->rating < 5)
                                    <div class="item-rating-stars">
                                        <i class="feather-star"></i>
                                        <i class="feather-star"></i>
                                        <i class="feather-star"></i>
                                        <i class="feather-star"></i>
                                        <i class="feather-star color-gray-medium"></i>
                                    </div>
                                @elseif ($playlist->rating == 5)
                                    <div class="item-rating-stars">
                                        <i class="feather-star"></i>
                                        <i class="feather-star"></i>
                                        <i class="feather-star"></i>
                                        <i class="feather-star"></i>
                                        <i class="feather-star"></i>
                                    </div>
                                @endif
                                <p class="rating_text">{{ $playlist->rating }} average based on 5 ratings.</p>
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
