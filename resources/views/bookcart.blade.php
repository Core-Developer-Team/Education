@include('layouts.header')

<header class="header clearfix">
    <div class="header-inner">
        @include('layouts.menu')
        <div class="overlay"></div>
    </div>
</header>


<div class="wrapper pt-0">
    <div class="breadcrumb-pt breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-title">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cart</li>
                            </ol>
                        </nav>
                        <h1 class="title_text">My Cart</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="refund-main-wrapper mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-8">
                    <div class="cart-content">
                        <div class="full-width">
                            <div class="cart_headtte14m item-setting-top">
                                <span class="color_bb"><i class="feather-shopping-cart"></i></span>
                                <h4>You have {{$data->count()}} items in your cart</h4>
                                <a href="#" class="view-link-btn btn-hover">Empty Cart</a>
                            </div>
                            <div class="item-cart-list">
                                <div class="main-form">
                                    <div class="jobs-list">
                                        @forelse ($data as $item)

                                        <div class="product-item">
                                            <div class="product-left">
                                                <a href="#"><img class="ft-plus-square product-bg-circle bg-cyan mr-0"
                                                        src="{{$item->book->cover_pic}}" alt=""></a>
                                            </div>
                                            <div class="product-body">
                                                <a href="#" class="job-heading pt-0">{{$item->book->book_name}}</a>
                                                <p class="notification-text font-small-4">
                                                    by : <a href="#"
                                                        class="cmpny-dt2">{{$item->book->user->username}}</a>
                                                </p>
                                                <div class="item-price524">
                                                    <span class="product-portfolio-price">$
                                                        {{$item->book->sum('price')}}</span>
                                                </div>
                                                <div class="portfolio_actions">
                                                    <a href="#" class="product-btn-action course-delete-link">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="alert alert-success">
                                            Sorry You don't have any Item yet
                                        </div>
                                        @endforelse

                                    </div>
                                </div>
                                <div class="cart-btns">
                                    <button class="continue-btn btn-hover">Contiue Shopping</button>
                                    <button class="main-save-btn ms-auto color btn-hover"><a href="{{
                                            route('bookorder.sell') }}">Secure
                                            Checkout</a> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="event-card rrmt-30">
                        <div class="cart-total-dt">
                            <h3 class="crt-heading font-size-s font-weight-normal">Your Cart Total</h3>
                            <h3 class="crt-heading font-size-xl font-weight-bolder">$55</h3>
                            <button class="buy-btn btn-hover" type="submit">Secure Checkout</button>
                            <p class="mb-0 mt-3 small">Price displayed excludes sales tax.</p>
                        </div>
                    </div>
                    <div class="secure-text mt-30">
                        <p><i class="fas fa-lock me-2"></i>Secure checkout</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('layouts.footer')