@section('title', 'notifications')
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
    <div class="main-setting">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-12">
                    <div class="event-card mb-0">
                        <div class="noti-item-left">
                            <h4 class="all-noti-title-left">Notifications</h4>
                            <p class="all-noti-des-left">You’re all caught up! Check back later for new notifications
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-8 col-md-12">
                    <div class="event-card rrmt-30">
                        <div class="headtte14m item-setting-top">
                            <span class="color_bb"><i class="feather-bell"></i></span>
                            <h4>All Notifications</h4>
                            <span class="pull-refresh ms-3 btn-hover" title="refresh">
                                <i class="feather-refresh-cw"></i>
                            </span>
                        </div>
                        <div class="notification-block">
                            @foreach (auth()->user()->notifications as $notification)
                                {{ $notification->markAsRead() }}
                                <div class="nt-card pl-24">
                                    <div class="nt-card__left-rail">

                                        <a href="#">
                                            <div class="ivm-image-view-model">
                                                <div class="presence-entity presence-entity--size-4">
                                                    <img title="View Jassica William’s profile"
                                                        src="/storage/{{ $notification->data['image'] }}" loading="lazy"
                                                        alt=""
                                                        class="presence-entity__image nt-view-attr__img--centered">
                                                    <div
                                                        class="presence-entity__badge @if (Cache::has('user-is-online-' . $notification->data['user_id'])) badge__online @else badge__offline @endif">
                                                        <span class="visually-hidden">
                                                            Status is online
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="display-flex flex-column flex-grow-1 mt-1 mr-3">
                                        <a class="nt-card__headline t-black t-normal"
                                            href="{{ route($notification->data['link'], ['id' => $notification->data['request_id']]) }}">
                                            <span><strong>
                                                    @if ($notification->notifiable_id == $notification->data['user_id'])
                                                        You
                                                    @else
                                                        {{ $notification->data['name'] }}
                                                    @endif
                                                </strong>
                                                {{ $notification->data['mesg'] }} </span>
                                        </a>
                                    </div>
                                    <div class="display-flex flex-column text-align-right align-self-flex-start">
                                        <p class="nt-card__time-ago">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </p>

                                    </div>
                                </div>
                            @endforeach

                        </div>

                    </div>
                </div>
                <div class="col-xl-3 col-lg-12">
                    <div class="full-width mb-30 dstp-bnr-dt ">
                        <div class="banner-item">
                            <div class="banner-img">
                                <img src="images/banners/banner-1.jpg" alt="">
                                <div class="banner-overlay">
                                    <span>Learning Plateform</span>
                                    <h4>Keep learning in the moments that matter.</h4>
                                    <button class="main-btn color btn-hover"> <a href="{{ route('course.index') }}">See
                                            Courses </a> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="full-width dstp-bnr-dt">
                        <div class="banner-item">
                            <div class="banner-img">
                                <img src="images/banners/banner-2.jpg" alt="">
                                <div class="banner-overlay">
                                    <span>Digital Marketplace</span>
                                    <h4 class="prtf-size">295 WordPress Themes &amp; Website Templates From $5</h4>
                                    <button class="main-btn color btn-hover"> <a href="{{ route('product.index') }}">See
                                            Products</a> </button>

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
