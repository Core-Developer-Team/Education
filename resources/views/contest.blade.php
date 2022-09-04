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
                        <div class="count-ttl">{{ $contestcount }}</div>
                        <div class="cate-post">Contests</div>
                    </div>
                </div>
                <div class="full-width mt-30 dstp-bnr-dt">
                    <div class="banner-item">
                        <div class="banner-img">
                            <img src="images/banners/banner-1.jpg" alt="">
                            <div class="banner-overlay">
                                <span>Learning Plateform</span>
                                <h4>Keep learning in the moments that matter.</h4>
                                <button class="main-btn color btn-hover"
                                    onclick="window.location.href='{{ route('course.index') }}'">See Courses</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-12">
                <div class="all-items rrmt-30">
                    <div class="product-items-list pl_item_search">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="my_connections_list mb-30">
                                    <div class="pp1_title">
                                        <h4>Contest</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="ppevent-card mb-30">
                                    <div class="eventc_dts">
                                        <div class="Create_eicon">
                                            <i class="fas fa-calendar-check"></i>
                                        </div>
                                        <h6>Create New Contest</h6>
                                        @if (session('status'))
                                        <div class="bg-primary p-4 rounded-lg mb-6 text-white text-center">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                        <a href="" class="create-ebtn btn-hover" data-bs-toggle="modal"
                                            data-bs-target=" @auth
                                        #addevent
@else
#loginlink
                                        @endauth ">Create</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="event_tab_links mt-2">
                                    <nav>
                                        <div class="nav nav-tabs" role="tablist">
                                            <a class="nav-link active" id="nav-going-tab" data-bs-toggle="tab"
                                                href="#nav-going" role="tab" aria-selected="true"><i
                                                    class="feather-check-circle me-2"></i>Todays</a>
                                            <a class="nav-link" id="nav-interested-tab" data-bs-toggle="tab"
                                                href="#nav-interested" role="tab" aria-selected="false"><i
                                                    class="feather-arrow-left-circle me-2"></i>Upcomming</a>
                                            <a class="nav-link" id="nav-invitations-tab" data-bs-toggle="tab"
                                                href="#nav-invitations" role="tab" aria-selected="false"><i
                                                    class="feather-check-circle me-2"></i>Expires</a>
                                        </div>
                                    </nav>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="nav-going" role="tabpanel"
                                        aria-labelledby="nav-going-tab">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="event_dt_title mb-25">
                                                    <h4> Contests</h4>
                                                    <span class="event-count">{{$data->count()}} Contests</span>
                                                </div>
                                            </div>
                                            @foreach ($data as $item)
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="event-card mt-5">
                                                        <div class="evnt1523">
                                                            <h4 class="evntitle">
                                                                {{ $item->event_date->format('d:m:Y') }}
                                                            </h4>
                                                        </div>
                                                        <div class="ental5896">
                                                            <div class="evntlnk47">
                                                                <div class="ental485">
                                                                    <a href="#">
                                                                        <div class="ental486">
                                                                            <img class="et-plus-square2 mr-0"
                                                                                src="{{ $item->image }}"
                                                                                alt="">
                                                                        </div>
                                                                    </a>
                                                                    <div class="ental487">
                                                                        <span class="evntime">At
                                                                            {{ $item->start_time->format('g:i A') }}
                                                                            To
                                                                            {{ $item->end_time->format('g:i A') }}</span>
                                                                        <a href="#"
                                                                            class="envttle14">{{ $item->name }}</a>
                                                                        <div class="ttlcnt15">
                                                                            <span
                                                                                class="evntcunt">{{ $item->description }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="pt-5 pb-5">
                                                {{ $data->links() }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-interested" role="tabpanel"
                                        aria-labelledby="nav-interested-tab">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="event_dt_title mb-25">
                                                    <h4> Contest</h4>
                                                    <span class="event-count">{{$upcoming->count()}} Contest</span>
                                                </div>
                                            </div>
                                            @foreach ($upcoming as $next)
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="event-card mt-5">
                                                        <div class="evnt1523">
                                                            <h4 class="evntitle">
                                                                {{ $next->event_date->format('d:m:Y') }}
                                                            </h4>
                                                        </div>
                                                        <div class="ental5896">
                                                            <div class="evntlnk47">
                                                                <div class="ental485">
                                                                    <a href="#">
                                                                        <div class="ental486">
                                                                            <img class="et-plus-square2 mr-0"
                                                                                src="{{ $next->image }}"
                                                                                alt="">
                                                                        </div>
                                                                    </a>
                                                                    <div class="ental487">
                                                                        <span class="evntime">At
                                                                            {{ $next->start_time->format('g:i A') }}
                                                                            To
                                                                            {{ $next->end_time->format('g:i A') }}</span>
                                                                        <a href="#"
                                                                            class="envttle14">{{ $next->name }}</a>
                                                                        <div class="ttlcnt15">
                                                                            <span
                                                                                class="evntcunt">{{ $next->description }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="pt-5 pb-5">
                                                {{ $upcoming->links() }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-invitations" role="tabpanel"
                                        aria-labelledby="nav-invitations-tab">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="event_dt_title mb-25">
                                                    <h4> Contest</h4>
                                                    <span class="event-count">{{$expires->count()}} Contest</span>
                                                </div>
                                            </div>
                                            @foreach ($expires as $expire)
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="event-card mt-5">
                                                        <div class="evnt1523">
                                                            <h4 class="evntitle">
                                                                {{ $expire->event_date->format('d:m:Y') }}
                                                            </h4>
                                                        </div>
                                                        <div class="ental5896">
                                                            <div class="evntlnk47">
                                                                <div class="ental485">
                                                                    <a href="#">
                                                                        <div class="ental486">
                                                                            <img class="et-plus-square2 mr-0"
                                                                                src="{{ $expire->image }}"
                                                                                alt="">
                                                                        </div>
                                                                    </a>
                                                                    <div class="ental487">
                                                                        <span class="evntime">At
                                                                            {{ $expire->start_time->format('g:i A') }}
                                                                            To
                                                                            {{ $expire->end_time->format('g:i A') }}</span>
                                                                        <a href="#"
                                                                            class="envttle14">{{ $expire->name }}</a>
                                                                        <div class="ttlcnt15">
                                                                            <span
                                                                                class="evntcunt">{{ $expire->description }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="pt-5 pb-5">
                                                {{ $expires->links() }}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Add Event Model-->
<div class="modal fade" id="addevent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Contest</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container bg-white rounded">
                    <!--event Form-->
                   
                    <!--event Form-->
                    <form class="form" method="POST" id="contest" enctype="multipart/form-data"
                        action="{{route('contest.store')}}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="name" value="{{ old('name') }} ">
                            <div class="text-danger mt-2 text-sm name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" name="location" id="location"
                                placeholder="location" value="{{ old('location') }} ">
                            <div class="text-danger mt-2 text-sm location">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date">Event_Date</label>
                            <input type="date" class="form-control" name="event_date" id="date"
                                placeholder="date" value={{ old('event_date') }}>
                            <div class="text-danger mt-2 text-sm event_date">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="time">Start_Time</label>
                            <input type="time" class="form-control" name="start_time" id="time"
                                placeholder="time" value={{ old('start_time') }}>
                            <div class="text-danger mt-2 text-sm start_time">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="time">Event End_Time</label>
                            <input type="time" class="form-control" name="end_time" id="time"
                                placeholder="time" value={{ old('end_time') }}>
                            <div class="text-danger mt-2 text-sm end_time">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>

                            <div class="text-danger mt-2 text-sm description">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" name="image" id="image"
                                placeholder="Upload image" value="{{ old('image') }}">

                            <div class="text-danger mt-2 text-sm image">
                            </div>
                        </div>
                        <hr>
                        <button type="submit" name="submit" class="btn mt-4">
                            Add
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!--footer-->
@include('layouts.footer')
<!---/footer-->
