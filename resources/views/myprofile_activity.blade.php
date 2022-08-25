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
        <div class="banner-user" style="background-image:url({{ asset('images/banners/bg-2.jpg') }});">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="banner-item-dts">

                            <div class="banner-content">
                                <div class="banner-media">
                                    <div class="item-profile-img">
                                        <img src="/storage/{{ $user->image }}" alt="User-Avatar"
                                            style="width: 100px; height:100px">

                                    </div>
                                    <div class="banner-media-body">
                                        <h3 class="item-user-title">{{ $user->username }}</h3>
                                        <div class="item-username">{{ $user->email }}</div>
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
                                                <a href=" @if (request()->route('id') == Auth()->id()) {{ route('profile.myreqs', ['id' => Auth()->id()]) }} 
                                                @else
                                                {{ route('profile.myreqs', ['id' => request()->route('id')]) }} @endif "
                                                    class="myprofle-item-links">Requests<span
                                                        class="badge-alert">{{ $user->request()->count() }}</span></a>
                                                <a href=" @if (request()->route('id') == Auth()->id()) {{ route('profile.products', ['id' => Auth()->id()]) }}
                                                @else
                                                {{ route('profile.products', ['id' => request()->route('id')]) }} @endif "
                                                    class="myprofle-item-links">Products<span
                                                        class="badge-alert">{{ $user->product()->count() }}</span></a>
                                                <a href=" @if (request()->route('id') == Auth()->id()) {{ route('profile.book', ['id' => Auth()->id()]) }}
                                                @else
                                                {{ route('profile.book', ['id' => request()->route('id')]) }} @endif "
                                                    class="myprofle-item-links">Books<span
                                                        class="badge-alert">{{ $user->book()->count() }}</span></a>
                                            </div>
                                        </div>
                                        @if (request()->route('id') == Auth()->id())
                                            <ul class="user-meta-btns">
                                                <li><a href="{{ route('profile.index') }}"
                                                        class="profile-edit-btn btn-hover"><i
                                                            class="feather-edit me-2"></i>Edit</a></li>
                                            </ul>
                                        @endif
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
                                        <a class="nav-link {{ request()->is('profile_dashboard') ? 'active' : '' }}"
                                            aria-current="page"
                                            href=" @if (request()->route('id') == Auth()->id()) {{ route('profile.show', ['id' => Auth()->id()]) }}
                                             @else
                                             {{ route('profile.show', [request()->route('id')]) }} @endif
                                             ">
                                            <span class="nav-icon">
                                                <i class="feather-grid"></i>
                                            </span>
                                            Dashboard
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('profile_activity') ? 'active' : '' }}"
                                            href=" @if (request()->route('id') == Auth()->id()) {{ route('profile.activity', ['id' => Auth()->id()]) }}
                                            @else
                                            {{ route('profile.activity', [request()->route('id')]) }} @endif ">
                                            <span class="nav-icon">
                                                <i class="feather-align-right"></i>
                                            </span>
                                            All Activity
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('profile_review') ? 'active' : '' }}"
                                            href=" @if (request()->route('id') == Auth()->id()) {{ route('profile.review', ['id' => Auth()->id()]) }}
                                            @else
                                            {{ route('profile.review', ['id' => request()->route('id')]) }} @endif ">
                                            <span class="nav-icon">
                                                <i class="feather-star"></i>
                                            </span>
                                            Reviews
                                        </a>
                                    </li>
                                    @if (request()->route('id') == Auth()->id())
                                        <li class="nav-item {{ request()->is('profile_earning') ? 'active' : '' }}">
                                            <a class="nav-link " aria-current="page"
                                                href=" @if (request()->route('id') == Auth()->id()) {{ route('profile.earning', ['id' => Auth()->id()]) }}
                                                @else
                                                {{ route('profile.earning', ['id' => request()->route('id')]) }} @endif ">
                                                <span class="nav-icon">
                                                    <i class="feather-dollar-sign"></i>
                                                </span>
                                                Earning
                                            </a>
                                        </li>
                                    @endif
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
                <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">

                    <div class="tab-content" id="event-tabContent">
                        <div class="tab-pane fade show active" id="nav-all" role="tabpanel"
                            aria-labelledby="nav-all-tab">
                            <div class="rcntacttle">
                                <span>Recent Activity</span>
                            </div>
                            @foreach ($reqcomment as $item)
                                <div class="full-width mb-30">
                                    <div class="recent-items">
                                        <div class="activities-noti-acts">
                                            <div class="activities-noti-list">
                                                <div class="comet-avatar pull-left">
                                                    <a href="#"><img src="/storage/{{ $item->user->image }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="activities-noti_text-sidebar">
                                                    <div>
                                                        <span class="user-popover"><a
                                                                href="#">{{ $item->user->username }}</a></span>
                                                        added comment on {{ $_GET['id'] }}
                                                        <a href="#"
                                                            class="second-user-link">{{ $item->request->requestname }}</a>
                                                        Request
                                                        <p class="activity-noti-time">
                                                            <span>{{ $item->created_at->diffForHumans() }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @foreach ($propbid as $item)
                                <div class="full-width mb-30">
                                    <div class="recent-items">
                                        <div class="activities-noti-acts">
                                            <div class="activities-noti-list">
                                                <div class="comet-avatar pull-left">
                                                    <a href="#"><img src="/storage/{{ $item->user->image }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="activities-noti_text-sidebar">
                                                    <div>
                                                        <span class="user-popover"><a
                                                                href="#">{{ $item->user->username }}</a></span>
                                                        Bid on
                                                        <a href="#"
                                                            class="second-user-link">{{ $item->proposal->proposalname }}</a>
                                                        Proposal
                                                        <p class="activity-noti-time">
                                                            <span>{{ $item->created_at->diffForHumans() }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @foreach ($propsol as $item)
                                <div class="full-width mb-30">
                                    <div class="recent-items">
                                        <div class="activities-noti-acts">
                                            <div class="activities-noti-list">
                                                <div class="comet-avatar pull-left">
                                                    <a href="#"><img src="/storage/{{ $item->user->image }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="activities-noti_text-sidebar">
                                                    <div>
                                                        <span class="user-popover"><a
                                                                href="#">{{ $item->user->username }}</a></span>
                                                        Gave solution on
                                                        <a href="#"
                                                            class="second-user-link">{{ $item->proposal->proposalname }}</a>
                                                        Proposal
                                                        <p class="activity-noti-time">
                                                            <span>{{ $item->created_at->diffForHumans() }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @foreach ($reqbid as $item)
                            <div class="full-width mb-30">
                                <div class="recent-items">
                                    <div class="activities-noti-acts">
                                        <div class="activities-noti-list">
                                            <div class="comet-avatar pull-left">
                                                <a href="#"><img src="/storage/{{ $item->user->image }}"
                                                        alt=""></a>
                                            </div>
                                            <div class="activities-noti_text-sidebar">
                                                <div>
                                                    <span class="user-popover"><a
                                                            href="#">{{ $item->user->username }}</a></span>
                                                    Bid on
                                                    <a href="#"
                                                        class="second-user-link">{{ $item->request->requestname }}</a>
                                                    Request
                                                    <p class="activity-noti-time">
                                                        <span>{{ $item->created_at->diffForHumans() }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @foreach ($reqsol as $item)
                            <div class="full-width mb-30">
                                <div class="recent-items">
                                    <div class="activities-noti-acts">
                                        <div class="activities-noti-list">
                                            <div class="comet-avatar pull-left">
                                                <a href="#"><img src="/storage/{{ $item->user->image }}"
                                                        alt=""></a>
                                            </div>
                                            <div class="activities-noti_text-sidebar">
                                                <div>
                                                    <span class="user-popover"><a
                                                            href="#">{{ $item->user->username }}</a></span>
                                                    Gave solution on
                                                    <a href="#"
                                                        class="second-user-link">{{ $item->request->requestname }}</a>
                                                    Request
                                                    <p class="activity-noti-time">
                                                        <span>{{ $item->created_at->diffForHumans() }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        </div>
                    </div>

                </main>
                <aside class="col col-xl-3 order-xl-1 col-lg-6 order-lg-1 col-md-6 col-sm-12 col-12">

                    <div class="event-card rrmt-30">
                        <div class="headtte14m">
                            <span><i class="feather-info"></i></span>
                            <h4>Info</h4>
                        </div>
                        <div class="evntdt99">
                            <div class="mndtlist">
                                <div class="evntflldt4 flxcntr">
                                    <div class="hhttd14s">
                                        <i class="feather-user"></i>
                                    </div>
                                    <div class="ttlpple">
                                        @if ($user->gender == 0)
                                            <span>Male</span>
                                        @elseif($user->gender == 1)
                                            <span>Female</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="mndtlist">
                                <div class="evntflldt4 flxcntr">
                                    <div class="hhttd14s">
                                        <i class="fas fa-location-arrow"></i>
                                    </div>
                                    <div class="ttlpple">
                                        <span>{{ $user->uni_name }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
                <aside class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="event-card rrmt-30">
                        <div class="product_total_stats">
                            <strong class="product_total_numberic">
                                <span class="product_stats_icon"><i class="feather-shopping-cart"></i></span>0
                            </strong>
                            <span class="product_stats_label">Total Sales</span>
                        </div>
                    </div>

                </aside>
            </div>
        </div>
    </div>
</div>

<!--footer-->
@include('layouts.footer')
<!---/footer-->
