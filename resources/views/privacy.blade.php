@section('title','Privacy')
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
    <div class="help-hero-search">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-8">
                    <div class="hero-banner">
                        <div class="hero-greeting-banner text-center">
                            <h3 class="hero-greeting">Privacy Policy</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="refund-main-wrapper mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="item-setting-tabs p-0 mb-0">
                        <div class="policy-articles">
                           {!!$policy->description!!}
                            <div class="last-change-policy">Last updated on: {{$policy->updated_at->diffForHumans()}}</div>
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
