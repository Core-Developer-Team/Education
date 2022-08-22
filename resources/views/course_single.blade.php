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
                                src="https://www.youtube.com/embed/{{$playlist_data['items'][0]->snippet->resourceId->videoId}}"
                                title="YouTube video player" frameborder="0"
                                class="ft-plus-square product-bg-w bg-cyan br-10 mr-0 mainvid"
                                allow="accelerometer; autoplay; clipboard-write;  gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                        <div class="learning_all_items mt-35">
                            <div class="owl-carousel related_courses_slider owl-theme">
                                @foreach ($playlist_data['items'] as $key=>$item)
                                <div class="item lists">
                                    <div class="full-width">
                                        <div class="recent-items">
                                            <div class="posts-list">
                                                <div class="feed-shared-product-dt">
                                                    <div class="pdct-img crse-img-tt ">
                                                        <a>
                                                            <iframe
                                                                src="https://www.youtube.com/embed/{{$item->snippet->resourceId->videoId}}"
                                                                frameborder="0" class="d-none vid"></iframe>
                                                            <img class="ft-plus-square product-bg-w bg-cyan mr-0"
                                                                src="{{ $item->snippet->thumbnails->medium->url }}"
                                                                alt="">
                                                        </a>
                                                    </div>
                                                    <div class="author-dts pp-20">
                                                        <a href="course_detail_view.html"
                                                            class="job-heading pp-title">{{Str::limit($item->snippet->title,
                                                            20, $end = '....')}}</a>
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
                                    {{$playlist_data['items'][0]->snippet->description}}
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="full-width mt-30">
                        <div class="item-description">
                            <div class="jobtxt47">
                                <h4>Download file from here</h4>
                                <hr>
                                <a href="{{ $playlist->file }}" download>download here</a>
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
                                        <span class="item_price">$ {{$playlist->price}}</span>
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
                                        class="fa fa-video-camera"></i></span>{{count($playlist_data['items'])}}
                            </strong>
                            <span class="product_stats_label">Videos</span>
                        </div>
                    </div>
                    <div class="full-width mt-30">
                        <div class="user-profile">
                            <div class="author-info-dts">
                                <div class="media d-flex">
                                    <div class="job-left">
                                        <img class="ft-plus-square job-bg-circle bg-cyan mr-0"
                                            src="/storage/{{$playlist->user->image}}" alt="">
                                    </div>
                                    <div class="media-body">
                                        <a href="#" class="job-heading">{{$playlist->user->username}}</a>
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

            </div>
        </div>
    </div>
</div>


<!--footer-->
@include('layouts.footer')
<!---/footer-->