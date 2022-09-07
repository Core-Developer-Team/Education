@section('title','my_Products')
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
                        <div class="count-ttl">{{$product->count()}}</div>
                        <div class="cate-post">Added Products</div>
                    </div>
                    <div class="manage-section">
                        <span class="manage-title">Manage By Shop</span>
                    </div>
                    <ul class="info__sections">
                        <li>
                            <a href="" class="all-info__sections">
                                <span class="all-info__left"><i class="feather-grid me-2"></i>My Products</span>
                                <span class="all-info__right">{{$product->count()}}</span>
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
            </div>
            <div class="col-xl-9 col-lg-8 col-md-12">
                <div class="filter_items mt-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="filter-section mt-0">
                                <div class="btn-8585  rrmt-30">
                                    <a href="" class="afltr-btn afltr-active">My Products</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="all-items">
                    <div class="product-items-list">
                        <div class="row">
                            @forelse ($product as $item)
                            <div class="col-lg-12">
                                <div class="full-width mt-30">
                                    <div class="recent-items my_portfolio_list">
                                        <div class="jobs-list">

                                           
                                            <div class="product-item ">
                                                <div class="product-left">
                                                    <a ><img
                                                            class="ft-plus-square product-bg-circle bg-cyan mr-0"
                                                            src="{{$item->cover_pic}}" alt=""></a>
                                                </div>
                                                <div class="product-body">
                                                    <a 
                                                        class="job-heading pt-0">{{$item->name}}</a>
                                                    <p class="notification-text font-small-4">
                                                        <a href="#" class="cmpny-dt2">{{$item->user->username}}</a>
                                                    </p>
                                                    <div class="item-price524">
                                                        <span class="product-portfolio-price">$ {{$item->price}}<ins
                                                                class="ppdtotal-sales">0 Sales</ins></span>
                                                    </div>

                                                </div>
                                            </div>
                                       
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                                            
                            @endforelse
                            <div class="mt-35">
                                {{$product->links()}}
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