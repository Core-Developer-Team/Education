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
    <div class="main-background-cover breadcrumb-pt">
        <div class="banner-user" style="background-image:url(images/banners/bg-2.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="banner-item-dts">

                            <div class="banner-content">
                                <div class="banner-media">
                                    <div class="item-profile-img">
                                        <img src="/storage/{{$user->image}}" alt="User-Avatar"
                                            id="wizardPicturePreview">

                                    </div>
                                    <div class="banner-media-body">
                                        <h3 class="item-user-title">{{$user->username}}</h3>
                                        <div class="profile-rating-section">
                                            <div class="profile-rating">
                                                <p>Rating :</p>
                                                <div class="profile-stars">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star color-gray-medium"></i>
                                                </div>
                                                <span>(39 ratings)</span>
                                            </div>
                                        </div>
                                        <div class="item-total-link-group">
                                            <div class="item-total-product-links">
                                                <a href="{{route('profile.myreqs')}}"
                                                    class="myprofle-item-links">Requests<span
                                                        class="badge-alert">{{$user->request()->count()}}</span></a>
                                                <a href="{{route('profile.products')}}"
                                                    class="myprofle-item-links">Products<span
                                                        class="badge-alert">{{$user->product()->count()}}</span></a>
                                                <a href="{{route('profile.book')}}"
                                                    class="myprofle-item-links">Books<span
                                                        class="badge-alert">{{$user->book()->count()}}</span></a>
                                            </div>
                                        </div>
                                        <ul class="user-meta-btns">
                                            <li><a href="{{ route('profile.index') }}"
                                                    class="profile-edit-btn btn-hover"><i
                                                        class="feather-edit me-2"></i>Edit</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="custom-pl-tabs">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg">
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="ppcanvasNavbar"
                            aria-labelledby="ppcanvasNavbarLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="ppcanvasNavbarLabel">Profile</h5>
                                <button type="button" class="close-btn btn-color" data-bs-dismiss="offcanvas"
                                    aria-label="Close">
                                    <i class="feather-x"></i>
                                </button>
                            </div>
                            <div class="offcanvas-body">
                                <ul class="navbar-nav justify-content-start flex-grow-1 pe_5">
                                    <li class="nav-item">
                                        <a class="nav-link {{ (request()->is('profile_dashboard')) ? 'active' : '' }}"
                                            aria-current="page" href="{{route('profile.show')}}">
                                            <span class="nav-icon">
                                                <i class="feather-grid"></i>
                                            </span>
                                            Dashboard
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ (request()->is('profile_activity')) ? 'active' : '' }}"
                                            href="{{route('profile.activity')}}">
                                            <span class="nav-icon">
                                                <i class="feather-align-right"></i>
                                            </span>
                                            All Activity
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ (request()->is('profile_review')) ? 'active' : '' }}"
                                            href="{{route('profile.review')}}">
                                            <span class="nav-icon">
                                                <i class="feather-star"></i>
                                            </span>
                                            Reviews
                                        </a>
                                    </li>
                                    <li class="nav-item {{ (request()->is('profile_earning')) ? 'active' : '' }}">
                                        <a class="nav-link " aria-current="page" href="{{route('profile.earning')}}">
                                            <span class="nav-icon">
                                                <i class="feather-dollar-sign"></i>
                                            </span>
                                            Earning
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="dtpgusr12">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="pf-deferred-area">
                        <div class="pf-deferred-content">
                            <div class="pf-deferred-dashboard_header">
                                <h4>Dashboard</h4>
                                <p>Private to you</p>
                            </div>
                            <div class="pf-deferred-dashboard_card-section">
                                <div class="pf-deferred-dashboard_card-cate-section">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                            <a href="" class="pf-dashboard-section__card-item">
                                                <i class="feather-briefcase"></i>
                                                <h4 class="pv-dashboard-section__metric-title">Request</h4>
                                                <p class="pv-dashboard-section__metric-products-totle">
                                                    {{$user->request()->count()}} Posted Request</p>
                                            </a>
                                        </div>
                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                            <a href="" class="pf-dashboard-section__card-item">
                                                <i class="feather-shopping-cart"></i>
                                                <h4 class="pv-dashboard-section__metric-title">Products</h4>
                                                <p class="pv-dashboard-section__metric-products-totle">
                                                    {{$user->product()->count()}} Added Products
                                                </p>
                                            </a>
                                        </div>
                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                            <a href="" class="pf-dashboard-section__card-item">
                                                <i class="feather-book-open"></i>
                                                <h4 class="pv-dashboard-section__metric-title">Courses</h4>
                                                <p class="pv-dashboard-section__metric-products-totle">
                                                    {{$user->course()->count()}} Added Courses
                                                </p>
                                            </a>
                                        </div>
                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                            <a href="" class="pf-dashboard-section__card-item">
                                                <i class="feather-flag"></i>
                                                <h4 class="pv-dashboard-section__metric-title">Tutorial</h4>
                                                <p class="pv-dashboard-section__metric-products-totle">
                                                    {{$user->playlist()->count()}} Added Tutorial
                                                </p>
                                            </a>
                                        </div>
                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                            <a href="" class="pf-dashboard-section__card-item">
                                                <i class="feather-users"></i>
                                                <h4 class="pv-dashboard-section__metric-title">Books</h4>
                                                <p class="pv-dashboard-section__metric-products-totle">
                                                    {{$user->book()->count()}} Added Tutorial
                                                </p>
                                            </a>
                                        </div>
                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                            <a href="" class="pf-dashboard-section__card-item">
                                                <i class="feather-calendar"></i>
                                                <h4 class="pv-dashboard-section__metric-title">Resource</h4>
                                                <p class="pv-dashboard-section__metric-products-totle">
                                                    {{$user->resource()->count()}} Resource Created
                                                </p>
                                            </a>
                                        </div>
                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                            <a href="" class="pf-dashboard-section__card-item">
                                                <i class="feather-calendar"></i>
                                                <h4 class="pv-dashboard-section__metric-title">Proposal</h4>
                                                <p class="pv-dashboard-section__metric-products-totle">
                                                    {{$user->proposal()->count()}} Proposal Created
                                                </p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="event-card mt-4">
                        <div class="headtte14m">
                            <span><i class="feather-list"></i></span>
                            <h4>Activites</h4>
                        </div>
                        <div class="all-activities">
                            <div class="activities-items">
                                @foreach ($reqcomment as $item)
                                <div class="activities-noti-acts">
                                    <div class="activities-noti-list">
                                        <div class="comet-avatar pull-left">
                                            <a href="#"><img src="/storage/{{$item->user->image}}" alt=""></a>
                                        </div>
                                        <div class="activities-noti_text-sidebar">
                                            <div>
                                                <span class="user-popover"><a
                                                        href="#">{{$item->user->username}}</a></span>
                                                added comment on
                                                <a href="#" class="second-user-link">{{$item->request->requestname}}</a>
                                                Request
                                                <p class="activity-noti-time">
                                                    <span>{{$item->created_at->diffForHumans()}}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                @foreach ($reqbid as $item)
                                <div class="activities-noti-acts">
                                    <div class="activities-noti-list">
                                        <div class="comet-avatar pull-left">
                                            <a href="#"><img src="/storage/{{$item->user->image}}" alt=""></a>
                                        </div>
                                        <div class="activities-noti_text-sidebar">
                                            <div>
                                                <span class="user-popover"><a
                                                        href="#">{{$item->user->username}}</a></span>
                                                Bid on
                                                <a href="#" class="second-user-link">{{$item->request->requestname}}</a>
                                                Request
                                                <p class="activity-noti-time">
                                                    <span>{{$item->created_at->diffForHumans()}}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                @foreach ($reqsol as $item)
                                <div class="activities-noti-acts">
                                    <div class="activities-noti-list">
                                        <div class="comet-avatar pull-left">
                                            <a href="#"><img src="/storage/{{$item->user->image}}" alt=""></a>
                                        </div>
                                        <div class="activities-noti_text-sidebar">
                                            <div>
                                                <span class="user-popover"><a
                                                        href="#">{{$item->user->username}}</a></span>
                                                Gave solution on
                                                <a href="#" class="second-user-link">{{$item->request->requestname}}</a>
                                                Request
                                                <p class="activity-noti-time">
                                                    <span>{{$item->created_at->diffForHumans()}}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="event-card mt-4">
                        <div class="headtte14m">
                            <span><i class="feather-list"></i></span>
                            <h4>Reviews</h4>
                        </div>
                        <div class="all-activities">
                            <div class="activities-items">
                                @forelse ($review as $item)
                                <div class="review-card mt-4">
                                    <div class="review-content">
                                        <div class="review-head">
                                            <div class="review-rating-stars">
                                                @if($item->rating==1)
                                                <div class="item-rating-stars">
                                                    <i class="feather-star"></i>
                                                    <i class="feather-star color-gray-medium"></i>
                                                    <i class="feather-star color-gray-medium"></i>
                                                    <i class="feather-star color-gray-medium"></i>
                                                    <i class="feather-star color-gray-medium"></i>
                                                </div>
                                                @elseif ($item->rating==2)
                                                <div class="item-rating-stars">
                                                    <i class="feather-star"></i>
                                                    <i class="feather-star "></i>
                                                    <i class="feather-star color-gray-medium"></i>
                                                    <i class="feather-star color-gray-medium"></i>
                                                    <i class="feather-star color-gray-medium"></i>
                                                </div>
                                                @elseif ($item->rating==3)
                                                <div class="item-rating-stars">
                                                    <i class="feather-star"></i>
                                                    <i class="feather-star "></i>
                                                    <i class="feather-star"></i>
                                                    <i class="feather-star color-gray-medium"></i>
                                                    <i class="feather-star color-gray-medium"></i>
                                                </div>
                                                @elseif ($item->rating==4)
                                                <div class="item-rating-stars">
                                                    <i class="feather-star"></i>
                                                    <i class="feather-star "></i>
                                                    <i class="feather-star "></i>
                                                    <i class="feather-star "></i>
                                                    <i class="feather-star color-gray-medium"></i>
                                                </div>
                                                @elseif ($item->rating==5)
                                                <div class="item-rating-stars">
                                                    <i class="feather-star"></i>
                                                    <i class="feather-star "></i>
                                                    <i class="feather-star "></i>
                                                    <i class="feather-star"></i>
                                                    <i class="feather-star"></i>
                                                </div>
                                                @endif
                                            </div>
                                            <span class="rating-time-posting"><i class="feather-clock me-2"></i>{{
                                                $item->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="rating-by">
                                            by:
                                            <a href="#" class="ms-2">
                                                <div class="ttlcnt15 invtbyuser">
                                                    <div class="invited_avtar_ee">
                                                        <img class="ft-plus-square evnt-invite-circle bg-cyan me-0"
                                                            src="/storage/{{ $item->user->image }}" alt="">
                                                    </div>
                                                    <span class="evntcunt">{{ $item->user->username }}</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="rating_descp">
                                            <p>{{ $item->description }}</p>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="alert alert-success mt-3">
                                    No Feedback Yet!
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="event-card rmt-30">
                        <div class="product_total_stats">
                            <strong class="product_total_numberic">
                                <span class="product_stats_icon"><i class="feather-shopping-cart"></i></span>1791
                            </strong>
                            <span class="product_stats_label">Total Sales</span>
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