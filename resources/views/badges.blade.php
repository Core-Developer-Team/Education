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
    <div class="breadcrumb-pt breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-title">
                      
                        <h1 class="title_text">All Badges</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="badge-main-wrapper mt-5">
        <div class="ach_page__badges__item__list">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-lg-12 col-md-12">
                        <div class="text-center process-title mb-3">
                            <div class="item-subtitle">Badges</div>
                        </div>
                    </div>
                    @foreach ($badges as $badge)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="ach_page__badges__item">
                            <img src="{{$badge->image}}" alt="">
                            <h3>{{$badge->name}}</h3>
                            <p>{{$badge->description}}</p>
                        </div>
                    </div> 
                    @endforeach
               
                </div>
            </div>
        </div>
        <div class="badge_page__hr">
            <svg version="1.1" id="line_2" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="800px" height="5px"
                xml:space="preserve">
                <path class="path2" fill="#efefef" stroke-width="3" stroke="#efefef" d="M0 0 l1120 0" />
            </svg>
        </div>
      
    </div>
</div>

<!--footer-->
@include('layouts.footer')
<!---/footer-->
