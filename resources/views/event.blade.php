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
                        <div class="count-ttl">{{$data->count()}}</div>
                        <div class="cate-post">Event</div>
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
                                    onclick="window.location.href='{{route('course.index')}}'">See Courses</button>
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
                                        <h4>Events</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="ppevent-card mb-30">
                                    <div class="eventc_dts">
                                        <div class="Create_eicon">
                                            <i class="fas fa-calendar-check"></i>
                                        </div>
                                        <h6>Create New Event</h6>
                                        <a href="" class="create-ebtn btn-hover" data-bs-toggle="modal" data-bs-target=" @auth
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
                                                    class="feather-check-circle me-2"></i>Going</a>
                                            <a class="nav-link" id="nav-interested-tab" data-bs-toggle="tab"
                                                href="#nav-interested" role="tab" aria-selected="false"><i
                                                    class="feather-star me-2"></i>Interested</a>
                                            <a class="nav-link" id="nav-invitations-tab" data-bs-toggle="tab"
                                                href="#nav-invitations" role="tab" aria-selected="false"><i
                                                    class="feather-mail me-2"></i>Invitations</a>
                                            <a class="nav-link" id="nav-hosting-tab" data-bs-toggle="tab"
                                                href="#nav-hosting" role="tab" aria-selected="false"><i
                                                    class="feather-home me-2"></i>Hosting</a>
                                            <a class="nav-link" id="nav-past-tab" data-bs-toggle="tab" href="#nav-past"
                                                role="tab" aria-selected="false"><i
                                                    class="feather-rotate-ccw me-2"></i>Past events</a>
                                        </div>
                                    </nav>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="nav-going" role="tabpanel"
                                        aria-labelledby="nav-going-tab">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="event_dt_title mb-25">
                                                    <h4>Going Events</h4>
                                                    <span class="event-count">1 Events</span>
                                                </div>
                                            </div>
                                            @foreach ($data as $item)

                                            <div class="col-lg-12 col-md-12">
                                                <div class="event-card">
                                                    <div class="evnt1523">
                                                        <h4 class="evntitle">{{$item->event_date}}
                                                        </h4>
                                                    </div>
                                                    <div class="ental5896">
                                                        <div class="evntlnk47">
                                                            <div class="ental485">
                                                                <a href="#">
                                                                    <div class="ental486">
                                                                        <img class="et-plus-square2 mr-0"
                                                                            src="{{$item->image}}" alt="">
                                                                    </div>
                                                                </a>
                                                                <div class="ental487">
                                                                    <span class="evntime">THIS SUNDAY AT
                                                                        {{$item->start_time}}
                                                                        UTC+{{$item->end_time}}</span>
                                                                    <a href="#" class="envttle14">{{$item->name}}</a>
                                                                    <span class="evntcate">Private</span>
                                                                    <div class="ttlcnt15">
                                                                        <span class="evntcunt">116 interested · 4
                                                                            going</span>
                                                                    </div>
                                                                </div>
                                                                <div class="ental488">
                                                                    <div class="evnticop me-3 dropdown">
                                                                        <a href="#" class="enptdwn" role="button"
                                                                            data-bs-toggle="dropdown"
                                                                            aria-expanded="false">
                                                                            <i class="feather-check-circle"></i>
                                                                            <span class="entxt">Going</span>
                                                                            <i class="fas fa-angle-down"></i>
                                                                        </a>
                                                                        <ul
                                                                            class="dropdown-menu dropdown-event dropdown-menu-end">
                                                                            <li class="media-list">
                                                                                <div
                                                                                    class="item channel_item event_item">
                                                                                    <i
                                                                                        class="feather-star icon_circle"></i>Interested
                                                                                </div>
                                                                                <div
                                                                                    class="item channel_item event_item active">
                                                                                    <i
                                                                                        class="feather-check-circle icon_circle"></i>Going
                                                                                </div>
                                                                                <div
                                                                                    class="item channel_item event_item">
                                                                                    <i
                                                                                        class="feather-x-circle icon_circle"></i>Not
                                                                                    Going
                                                                                </div>
                                                                            </li>
                                                                        </ul>
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
                                                    <h4>Interested Events</h4>
                                                    <span class="event-count">2 Events</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="event-card">
                                                    <div class="evnt1523">
                                                        <h4 class="evntitle">January 2021</h4>
                                                    </div>
                                                    <div class="ental5896">
                                                        <div class="evntlnk47">
                                                            <div class="ental485">
                                                                <a href="#">
                                                                    <div class="ental486">
                                                                        <img class="et-plus-square2 me-0"
                                                                            src="images/event-imgs/img-2.jpg" alt="">
                                                                    </div>
                                                                </a>
                                                                <div class="ental487">
                                                                    <span class="evntime">SUN, 28 FEB AT 03:30
                                                                        UTC+05:30</span>
                                                                    <a href="#" class="envttle14">Birthday Party</a>
                                                                    <span class="evntcate">Private</span>
                                                                    <div class="ttlcnt15">
                                                                        <span class="evntcunt">125 interested · 5
                                                                            going</span>
                                                                    </div>
                                                                </div>
                                                                <div class="ental488">
                                                                    <div class="evnticop me-3 dropdown">
                                                                        <a href="#" class="enptdwn" role="button"
                                                                            data-bs-toggle="dropdown"
                                                                            aria-expanded="false">
                                                                            <i class="feather-star"></i>
                                                                            <span class="entxt">Interested</span>
                                                                            <i class="fas fa-angle-down"></i>
                                                                        </a>
                                                                        <ul
                                                                            class="dropdown-menu dropdown-event dropdown-menu-end">
                                                                            <li class="media-list">
                                                                                <div
                                                                                    class="item channel_item event_item active">
                                                                                    <i
                                                                                        class="feather-star icon_circle"></i>Interested
                                                                                </div>
                                                                                <div
                                                                                    class="item channel_item event_item">
                                                                                    <i
                                                                                        class="feather-check-circle icon_circle"></i>Going
                                                                                </div>
                                                                                <div
                                                                                    class="item channel_item event_item">
                                                                                    <i
                                                                                        class="feather-x-circle icon_circle"></i>Not
                                                                                    Interested
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="evnticop dropdown">
                                                                        <a href="#" class="enptdwn epsttdwn"
                                                                            role="button" data-bs-toggle="dropdown"
                                                                            aria-expanded="false">
                                                                            <i class="fas fa-ellipsis-h"></i>
                                                                        </a>
                                                                        <ul
                                                                            class="dropdown-menu dropdown-event-optn dropdown-menu-end">
                                                                            <li class="media-list">
                                                                                <div class="item channel_item"><i
                                                                                        class="far fa-bookmark me-3"></i>Save
                                                                                </div>
                                                                                <div class="item channel_item notstactn"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#notiSettingModal">
                                                                                    <i
                                                                                        class="feather-settings me-3"></i>Notification
                                                                                    Setting
                                                                                </div>
                                                                                <div class="item channel_item addpageactn"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#addTopageModal">
                                                                                    <i class="feather-flag me-3"></i>Add
                                                                                    to Page
                                                                                </div>
                                                                                <div class="item channel_item exportbtn"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#exportModal"><i
                                                                                        class="feather-download me-3"></i>Export
                                                                                    Event</div>
                                                                                <div class="item channel_item reportbtn"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#reportModal"><i
                                                                                        class="feather-alert-octagon me-3"></i>Report
                                                                                    Event</div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="evntlnk47">
                                                            <div class="ental485">
                                                                <a href="#">
                                                                    <div class="ental486">
                                                                        <img class="et-plus-square2 me-0"
                                                                            src="images/event-imgs/img-3.jpg" alt="">
                                                                    </div>
                                                                </a>
                                                                <div class="ental487">
                                                                    <span class="evntime">WED, 03 MAR AT 11:30
                                                                        UTC+05:30</span>
                                                                    <a href="#" class="envttle14">Happy new year
                                                                        2021 party</a>
                                                                    <span class="evntcate">Public</span>
                                                                    <div class="ttlcnt15">
                                                                        <span class="evntcunt">352 interested · 25
                                                                            going</span>
                                                                    </div>
                                                                </div>
                                                                <div class="ental488">
                                                                    <div class="evnticop me-3 dropdown">
                                                                        <a href="#" class="enptdwn" role="button"
                                                                            data-bs-toggle="dropdown"
                                                                            aria-expanded="false">
                                                                            <i class="feather-star"></i>
                                                                            <span class="entxt">Interested</span>
                                                                            <i class="fas fa-angle-down"></i>
                                                                        </a>
                                                                        <ul
                                                                            class="dropdown-menu dropdown-event dropdown-menu-end">
                                                                            <li class="media-list">
                                                                                <div
                                                                                    class="item channel_item event_item active">
                                                                                    <i
                                                                                        class="feather-star icon_circle"></i>Interested
                                                                                </div>
                                                                                <div
                                                                                    class="item channel_item event_item">
                                                                                    <i
                                                                                        class="feather-check-circle icon_circle"></i>Going
                                                                                </div>
                                                                                <div
                                                                                    class="item channel_item event_item">
                                                                                    <i
                                                                                        class="feather-x-circle icon_circle"></i>Not
                                                                                    Interested
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="evnticop dropdown">
                                                                        <a href="#" class="enptdwn epsttdwn"
                                                                            role="button" data-bs-toggle="dropdown"
                                                                            aria-expanded="false">
                                                                            <i class="fas fa-ellipsis-h"></i>
                                                                        </a>
                                                                        <ul
                                                                            class="dropdown-menu dropdown-event-optn dropdown-menu-end">
                                                                            <li class="media-list">
                                                                                <div class="item channel_item"><i
                                                                                        class="far fa-bookmark me-3"></i>Save
                                                                                </div>
                                                                                <div class="item channel_item notstactn"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#notiSettingModal">
                                                                                    <i
                                                                                        class="feather-settings me-3"></i>Notification
                                                                                    Setting
                                                                                </div>
                                                                                <div class="item channel_item addpageactn"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#addTopageModal">
                                                                                    <i class="feather-flag me-3"></i>Add
                                                                                    to Page
                                                                                </div>
                                                                                <div class="item channel_item exportbtn"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#exportModal"><i
                                                                                        class="feather-download me-3"></i>Export
                                                                                    Event</div>
                                                                                <div class="item channel_item reportbtn"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#reportModal"><i
                                                                                        class="feather-alert-octagon me-3"></i>Report
                                                                                    Event</div>
                                                                            </li>
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
                                    <div class="tab-pane fade" id="nav-invitations" role="tabpanel"
                                        aria-labelledby="nav-invitations-tab">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="event_dt_title mb-25">
                                                    <h4>Invitations Events</h4>
                                                    <span class="event-count">1 Events</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="event-card">
                                                    <div class="evnt1523">
                                                        <h4 class="evntitle">January 2021</h4>
                                                    </div>
                                                    <div class="ental5896">
                                                        <div class="evntlnk47">
                                                            <div class="ental485">
                                                                <a href="#">
                                                                    <div class="ental486">
                                                                        <img class="et-plus-square2 me-0"
                                                                            src="images/event-imgs/img-2.jpg" alt="">
                                                                    </div>
                                                                </a>
                                                                <div class="ental487">
                                                                    <span class="evntime">SUN, 28 FEB AT 03:30
                                                                        UTC+05:30</span>
                                                                    <a href="#" class="envttle14">Birthday Party</a>
                                                                    <span class="evntcate">Private</span>
                                                                    <div class="ttlcnt15 invtbyuser">
                                                                        <div class="invited_avtar_ee">
                                                                            <img class="ft-plus-square evnt-invite-circle bg-cyan me-0"
                                                                                src="images/left-imgs/img-3.jpg" alt="">
                                                                        </div>
                                                                        <span class="evntcunt">Amritpal Singh
                                                                            invited you</span>
                                                                    </div>
                                                                </div>
                                                                <div class="ental488">
                                                                    <div class="evnticop me-3 dropdown">
                                                                        <a href="#" class="enptdwn noenptdwn"
                                                                            role="button">
                                                                            <i class="feather-star"></i>
                                                                            <span class="entxt">Interested</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="evnticop dropdown">
                                                                        <a href="#" class="enptdwn epsttdwn"
                                                                            role="button" data-bs-toggle="dropdown"
                                                                            aria-expanded="false">
                                                                            <i class="fas fa-ellipsis-h"></i>
                                                                        </a>
                                                                        <ul
                                                                            class="dropdown-menu dropdown-event-optn dropdown-menu-end">
                                                                            <li class="media-list">
                                                                                <div class="item channel_item"><i
                                                                                        class="far fa-bookmark me-3"></i>Save
                                                                                </div>
                                                                                <div class="item channel_item"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#cancelModal"><i
                                                                                        class="feather-eye-off me-3"></i>Ignore
                                                                                    Events</div>
                                                                                <div class="item channel_item addpageactn"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#addTopageModal">
                                                                                    <i class="feather-flag me-3"></i>Add
                                                                                    to Page
                                                                                </div>
                                                                                <div class="item channel_item exportbtn"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#exportModal"><i
                                                                                        class="feather-download me-3"></i>Export
                                                                                    Event</div>
                                                                                <div class="item channel_item reportbtn"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#reportModal"><i
                                                                                        class="feather-alert-octagon me-3"></i>Report
                                                                                    Event</div>
                                                                            </li>
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
                                    <div class="tab-pane fade" id="nav-hosting" role="tabpanel"
                                        aria-labelledby="nav-hosting-tab">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="event_dt_title mb-25">
                                                    <h4>My Hosting Events</h4>
                                                    <span class="event-count">1 Events</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="event-card">
                                                    <div class="evnt1523">
                                                        <h4 class="evntitle">January 2021</h4>
                                                    </div>
                                                    <div class="ental5896">
                                                        <div class="evntlnk47">
                                                            <div class="ental485">
                                                                <a href="#">
                                                                    <div class="ental486">
                                                                        <img class="et-plus-square2 mr-0"
                                                                            src="images/event-imgs/img-2.jpg" alt="">
                                                                    </div>
                                                                </a>
                                                                <div class="ental487">
                                                                    <span class="evntime">SUN, 28 FEB AT 03:30
                                                                        UTC+05:30</span>
                                                                    <a href="#" class="envttle14">Birthday Party</a>
                                                                    <span class="evntcate">Private</span>
                                                                    <div class="ttlcnt15 invtbyuser">
                                                                        <div class="invited_avtar_ee">
                                                                            <img class="ft-plus-square evnt-invite-circle bg-cyan me-0"
                                                                                src="images/left-imgs/img-1.jpg" alt="">
                                                                        </div>
                                                                        <span class="evntcunt">Hosted by me</span>
                                                                    </div>
                                                                </div>
                                                                <div class="ental488">
                                                                    <div class="evnticop me-3 dropdown">
                                                                        <a href="#" class="enptdwn noenptdwn ms-0"
                                                                            role="button">
                                                                            <span class="entxt">Details</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="evnticop dropdown">
                                                                        <a href="#" class="enptdwn epsttdwn"
                                                                            role="button" data-bs-toggle="dropdown"
                                                                            aria-expanded="false">
                                                                            <i class="fas fa-ellipsis-h"></i>
                                                                        </a>
                                                                        <ul
                                                                            class="dropdown-menu dropdown-event-optn dropdown-menu-end">
                                                                            <li class="media-list">
                                                                                <div class="item channel_item"><i
                                                                                        class="far fa-edit me-3"></i>Edit
                                                                                </div>
                                                                                <div class="item channel_item"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#deleteModal"><i
                                                                                        class="feather-trash-2 me-3"></i>Delete
                                                                                </div>
                                                                                <div class="item channel_item"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#addTopageModal">
                                                                                    <i class="feather-flag me-3"></i>Add
                                                                                    to Page
                                                                                </div>
                                                                                <div class="item channel_item"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#exportModal"><i
                                                                                        class="feather-download me-3"></i>Export
                                                                                    Event</div>
                                                                            </li>
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
                                    <div class="tab-pane fade" id="nav-past" role="tabpanel"
                                        aria-labelledby="nav-past-tab">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="event_dt_title mb-25">
                                                    <h4>Past Events</h4>
                                                    <span class="event-count">0 Events</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="no-events-icon">
                                                    <img src="images/calendar.svg" alt="">
                                                    <span>Events that you've attended will appear here</span>
                                                    <a href="discover_events.html"
                                                        class="evntbtn25 btn-hover mt-4">Discover New Events</a>
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
</div>
<!--Add Event Model-->
<div class="modal fade" id="addevent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container bg-white rounded">
                    <!--course Form-->
                    @if (session('status'))
                    <div class="bg-primary p-4 rounded-lg mb-6 text-white text-center">
                        {{ session('status') }}
                    </div>
                    @endif
                    <!--Proposal Form-->
                    <form class="form" method="POST" id="event" enctype="multipart/form-data"
                        action=" {{ route('event.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="name"
                                value="{{ old('name') }} ">
                            <div class="text-danger mt-2 text-sm name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" name="location" id="location" placeholder="location"
                                value="{{ old('location') }} ">
                            <div class="text-danger mt-2 text-sm location">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date">Event_Date</label>
                            <input type="date" class="form-control" name="event_date" id="date" placeholder="date"
                                value={{ old('event_date') }}>
                            <div class="text-danger mt-2 text-sm event_date">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="time">Start_Time</label>
                            <input type="time" class="form-control" name="start_time" id="time" placeholder="time"
                                value={{ old('start_time') }}>
                            <div class="text-danger mt-2 text-sm start_time">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="time">Event End_Time</label>
                            <input type="time" class="form-control" name="end_time" id="time" placeholder="time"
                                value={{ old('end_time') }}>
                            <div class="text-danger mt-2 text-sm end_time">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description"
                                rows="3">{{ old('description') }}</textarea>

                            <div class="text-danger mt-2 text-sm description">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" name="image" id="image" placeholder="Upload image"
                                value="{{ old('image') }}">

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