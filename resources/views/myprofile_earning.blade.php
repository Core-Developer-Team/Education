@section('title', 'Earning')
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
        <div class="banner-user" style="background-image:url(/storage/{{ $user->cover_img }});">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="banner-item-dts">

                            <div class="banner-content">
                                <div class="banner-media">
                                    <div class="item-profile-img">
                                        <div style="margin-top: 10px; margin-left:4px; width:15px; height:15px;"
                                            class="@if (Cache::has('user-is-online-' . $user->id)) status-oncircle @else status-ofcircle @endif">
                                        </div>
                                        <img src="/storage/{{ $user->image }}" alt="User-Avatar"
                                            style="width: 100px; height:100px">

                                    </div>

                                    <div class="banner-media-body">
                                        <h3 class="item-user-title">{{ $user->username }}</h3>
                                        <div class="profile-rating-section">
                                            <div class="profile-rating">
                                                <p>Rating :</p>
                                                @if ($user->rating >= 0.0 && $user->rating<1.0)
                                                    <div class="profile-stars">
                                                        <i class="fas fa-star color-gray-medium"></i>
                                                        <i class="fas fa-star color-gray-medium"></i>
                                                        <i class="fas fa-star color-gray-medium"></i>
                                                        <i class="fas fa-star color-gray-medium"></i>
                                                        <i class="fas fa-star color-gray-medium"></i>
                                                    </div>
                                                @elseif ($user->rating >= 1 && $user->rating < 2)
                                                    <div class="profile-stars">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star color-gray-medium"></i>
                                                        <i class="fas fa-star color-gray-medium"></i>
                                                        <i class="fas fa-star color-gray-medium"></i>
                                                        <i class="fas fa-star color-gray-medium"></i>
                                                    </div>
                                                @elseif ($user->rating >= 2 && $user->rating < 3)
                                                    <div class="profile-stars">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star color-gray-medium"></i>
                                                        <i class="fas fa-star color-gray-medium"></i>
                                                        <i class="fas fa-star color-gray-medium"></i>
                                                    </div>
                                                @elseif ($user->rating >= 3 && $user->rating < 4)
                                                    <div class="profile-stars">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star color-gray-medium"></i>
                                                        <i class="fas fa-star color-gray-medium"></i>
                                                    </div>
                                                @elseif ($user->rating >= 4 && $user->rating < 5)
                                                    <div class="profile-stars">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star color-gray-medium"></i>
                                                    </div>
                                                @elseif ($user->rating == 5)
                                                    <div class="profile-stars">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                @endif
                                                <span>({{ $user->rating }} average based on 5 ratings.)</span>
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
                <div class="col-xl-4 col-lg-4 col-md-12">
                    <div class="earning_steps">
                        <p>Sales earnings this month (March), after micko fees, &amp; before taxes:</p>
                        <h2>$1146.78</h2>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12">
                    <div class="earning_steps">
                        <p>Your balance:</p>
                        <h2>$1146.78</h2>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12">
                    <div class="earning_steps">
                        <p>Total value of your sales, before taxes:</p>
                        <h2>$95895.54</h2>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12">
                    <div class="full-width">
                        <div class="explore-heading">
                            <h4>Your Top Countries</h4>
                        </div>
                        <ul class="country_list">
                            <li>
                                <div class="country_item">
                                    <div class="country_item_left">
                                        <span>United States</span>
                                    </div>
                                    <div class="country_item_right">
                                        <span>$48</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="country_item">
                                    <div class="country_item_left">
                                        <span>Bulgaria</span>
                                    </div>
                                    <div class="country_item_right">
                                        <span>$35</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="country_item">
                                    <div class="country_item_left">
                                        <span>Dominica</span>
                                    </div>
                                    <div class="country_item_right">
                                        <span>$25</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="country_item">
                                    <div class="country_item_left">
                                        <span>Italy</span>
                                    </div>
                                    <div class="country_item_right">
                                        <span>$18</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="country_item">
                                    <div class="country_item_left">
                                        <span>Korea, Republic of</span>
                                    </div>
                                    <div class="country_item_right">
                                        <span>$18</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="country_item">
                                    <div class="country_item_left">
                                        <span>Malaysia</span>
                                    </div>
                                    <div class="country_item_right">
                                        <span>$10</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="country_item">
                                    <div class="country_item_left">
                                        <span>Netherlands</span>
                                    </div>
                                    <div class="country_item_right">
                                        <span>$8</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="country_item">
                                    <div class="country_item_left">
                                        <span>Thailand</span>
                                    </div>
                                    <div class="country_item_right">
                                        <span>$5</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-12">
                    <div class="date_selector rrmt-30">
                        <div class="sorting-earing-select">
                            <select class="sorting-select">
                                <option value="total-sales" selected>Total Sales</option>
                                <option value="referrals">Referrals</option>
                                <option value="item-sales">Item Sales</option>
                            </select>
                        </div>
                        <div class="date_list152">
                            <a href="#">All Time</a> /
                            <a href="#">2020</a> /
                            <a href="#">April</a>
                        </div>
                    </div>
                    <div class="main-table mt-30">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Item Sales Count</th>
                                        <th scope="col">Earning</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="#">1, Wednesday</a></td>
                                        <td>3</td>
                                        <td>$120.50</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">2, Thursday</a></td>
                                        <td>2</td>
                                        <td>$84.00</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">4, Saturday</a></td>
                                        <td>4</td>
                                        <td>$150.50</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">5, Sunday</a></td>
                                        <td>3</td>
                                        <td>$102.24</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">6, Monday</a></td>
                                        <td>2</td>
                                        <td>$80.50</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">7, Tuesday</a></td>
                                        <td>3</td>
                                        <td>$70.50</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">8, Wednesday</a></td>
                                        <td>5</td>
                                        <td>$130.00</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">9, Thursday</a></td>
                                        <td>3</td>
                                        <td>$95.50</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">10, Friday</a></td>
                                        <td>4</td>
                                        <td>$152.50</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">11, Saturday</a></td>
                                        <td>3</td>
                                        <td>$100.40</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">12, Sunday</a></td>
                                        <td>2</td>
                                        <td>$60.14</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>Total</td>
                                        <td>34</td>
                                        <td>$1146.78</td>
                                    </tr>
                                </tfoot>
                            </table>
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
