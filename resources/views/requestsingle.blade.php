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
                                <li class="breadcrumb-item"><a href="{{route('req.index')}}">Requests</a></li>
                            </ol>
                        </nav>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-tabs">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="">Request Details</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="event-content-main">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-lg-12 col-md-12">
                    <div class="full-width">
                        <div class="recent-items">
                            <div class="posts-list">
                                <div class="feed-job-dt">
                                    <div class="joblftdt5">
                                        <div class="author-left main_img_view">
                                            <a href="#"><img class="ft-plus-square main-job-bg-circle bg-cyan me-0"
                                                    src="/storage/{{$data->user->image}}" alt=""></a>
                                        </div>
                                        <div class="iconreq">
                                            <img class="ft-plus-square job-bg-circle bg-cyan mr-0"
                                                src="{{ $data->user->badge->image }}" style="width:30px; height:30px"
                                                alt="">
                                        </div>
                                        <div class="author-dts">
                                            <h4 class="job-view-heading job-center">{{$data->requestname}}</h4>
                                            <p class="notification-text font-small-4 job-center">
                                                <a href="#" class="cmpny-dt">{{$data->user->username}}</a>
                                                <span class="job-loca"><i class="fas fa-location-arrow"></i><ins
                                                        class="state-name">{{$data->user->uni_name}}</span>
                                            </p>
                                            <p class="notification-text font-small-4 pt-2 job-center">
                                                <span class="time-dt">{{ $data->updated_at->diffForHumans()
                                                    }}</span>
                                            </p>
                                            <div class="jbopdt142">
                                                <div class="jbbdges10">
                                                    <span class="job-badge ffcolor">@if ($data->tag == 1)
                                                        Offline
                                                        @else
                                                        Online
                                                        @endif</span>
                                                    <span class="job-badge ddcolor">$ {{$data->price}}</span>
                                                </div>
                                                <div class="aplcnts_15 job-center applcntres ml-3">
                                                    <i
                                                        class="feather-users ms-2"></i><span>Applicants</span><ins>{{$data->reqbid->count()}}</ins>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="action-btns-job job-center resmargin">

                                        @if (!(auth()->id() == $data->user_id))
                                        <a href="#"
                                            class="apply_job_btn ps-4 view-btn btn-hover  @if ($data->reqbid()->where('user_id', Auth()->id())->count() >= 1) d-none @endif"
                                            data-bs-toggle="modal" data-bs-target="#addbid">Bid Now</a>
                                        <a href="#"
                                            class="apply_job_btn ps-4 view-btn btn-hover @if ($data->reqsolution()->where('user_id', Auth()->id())->count() >= 1) d-none @endif"
                                            data-bs-toggle="modal" data-bs-target="#addsolution">Solution</a>

                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9 col-md-12">
                    @if (session('bidstatus'))
                    <div class="bg-danger p-4 rounded-lg mb-6 text-white text-center">
                        {{ session('bidstatus') }}
                    </div>
                    @endif
                    @if (session('solstatus'))
                    <div class="bg-danger p-4 rounded-lg mb-6 text-white text-center">
                        {{ session('solstatus') }}
                    </div>
                    @endif
                    @if (session('cstatus'))
                    <div class="bg-danger p-4 rounded-lg mb-6 text-white text-center">
                        {{ session('cstatus') }}
                    </div>
                    @endif
                    <!--allbids-->
                    @if (auth()->id() == $data->user_id)
                    <div class="event-card mt-4">
                        <div class="jobdt99">
                            <div class="jbdes25">
                                <div class="jobtxt47">
                                    <h4>All Bids</h4>
                                    <hr>
                                    @forelse ($data->reqbid()->orderBy('updated_at','DESC')->get() as $bids)
                                    <div class="joblftdt5">
                                        <div class="author-left main_img_view">
                                            <a href="#"><img class="ft-plus-square main-job-bg-circle bg-cyan me-0"
                                                    src="/storage/{{$data->user->image}}"
                                                    style="width: 50px;height: 50px;" alt=""></a>
                                        </div>

                                        <div class="author-dts">
                                            <h4 class="job-view-heading job-center">{{ $bids->user->username }}</h4>
                                            <p class="notification-text font-small-4 job-center">
                                            <p>{{ $bids->description }}</p>
                                            </p>
                                            <p class="notification-text font-small-4 pt-2 job-center">
                                                <span class="time-dt"> Bid on {{ $bids->updated_at->diffForHumans()
                                                    }}</span>
                                            </p>
                                            <div class="jbopdt142">
                                                <div class="jbbdges10">
                                                    <form method="GET"
                                                        action="{{ route('chat.index', ['reqid'=>$data->id,'toid'=>$bids->id]) }}">
                                                        @csrf
                                                        <button type="submit"
                                                            class="apply_job_btn ps-4 view-btn btn-hover">Chat
                                                            Now</button>
                                                        <span class="job-badge ffcolor">$ {{$bids->price}}</span>
                                                    </form>
                                                </div>
                                                <div class="aplcnts_15 job-center applcntres ml-3">
                                                    <i class="feather-users ms-2"></i> Do On
                                                    <ins>{{$bids->days}}</ins><span>Days</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    @empty
                                    <div>No bid Yet</div>
                                    @endforelse
                                </div>

                            </div>
                        </div>
                    </div>
                    @endif
                    <!--description-->
                    <div class="event-card mt-4">
                        <div class="jobdt99">
                            <div class="jbdes25">
                                <div class="jobtxt47">
                                    <h4>Description</h4>
                                    {{$data->description}}
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--Solution-->
                    @if (auth()->id() == $data->user_id)
                    <div class="event-card mt-4">
                        <div class="jobdt99">
                            <div class="jbdes25">
                                <div class="jobtxt47">
                                    <h4>Solution</h4>
                                    @if (auth()->id() == $data->user_id)
                                    <a href="" class="label-dker post_categories_reported mr-10"><span>Report</span></a>
                                    @endif
                                    @forelse ($data->reqsolution()->orderBy('updated_at','DESC')->get() as $item)
                                    <div
                                        class="d-sm-flex align-items-center rounded border-none mt-3 p-3 justify-content-between mb-4">
                                        <div class="rounded-circle d-flex">
                                            <img src="/storage/{{ $item->user->image }}" class="rounded-circle"
                                                style="width: 50px;height: 50px;" alt="" srcset="">
                                            <div class="ps-4 pt-0">
                                                <p class="h2">{{ $item->user->username }}</p>
                                                <p> <small>Created on
                                                        {{ $item->created_at->diffForHumans() }}</small>
                                                </p>
                                                <p>{{ $item->description }}</p>
                                                <div class="jobtxt47">
                                                    <hr>
                                                    <h4>Download file from here</h4>

                                                    <a href="{{ $data->file }}" download="{{ $data->file }}">{{
                                                        $data->file
                                                        }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    @endforelse
                                </div>

                            </div>
                        </div>
                    </div>
                    @endif
                    <!--file-->
                    <div class="event-card mt-4">
                        <div class="jobdt99">
                            <div class="jbdes25">
                                <div class="jobtxt47">
                                    <h4>Download file from here</h4>
                                    <hr>
                                    <a href="{{ $data->file }}" download="{{ $data->filename }}">{{ $data->filename
                                        }}</a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--Comments-->
                    <div class="event-card mt-4">
                        <div class="jobdt99">
                            <div class="jbdes25">
                                <div class="jobtxt47">
                                    <h4>Comments</h4>
                                    <hr>
                                    <!--comment Section-->
                                    <div class="pt-5">

                                        <h3 class="mb-3">{{ $data->reqcomment->count() }} Comments
                                        </h3>
                                        @forelse ($data->reqcomment()->orderBy('updated_at','DESC')->get() as $item)
                                        <div
                                            class="d-sm-flex align-items-center rounded border-none mt-3 p-3 justify-content-between mb-4">
                                            <div class="rounded-circle d-flex">
                                                <img src="/storage/{{ $item->user->image }}" class="rounded-circle"
                                                    style="width: 50px;height: 50px;" alt="" srcset="">
                                                <div class="ps-4 pt-0">
                                                    <p class="h2">{{ $item->user->username }}</p>
                                                    <p> <small>Created on
                                                            {{ $item->created_at->diffForHumans() }}</small>
                                                    </p>
                                                    <p>{{ $item->comment }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        @endforelse


                                        <!-- END comment-list -->

                                        <div class="comment-form-wrap pt-5">
                                            <h3 class="mb-5">Leave a comment</h3>
                                            <form method="POST" action="{{ route('reqcomment.store') }}"
                                                class="p-5 bg-light">
                                                @csrf
                                                <input type="hidden" name="request_id" value="{{ $data->id }}">
                                                <div class="form-group">
                                                    <label for="message">Message</label>
                                                    <textarea name="comment" id="message" cols="30" rows="10"
                                                        class="form-control  @error('comment') border-danger @enderror"
                                                        required></textarea>
                                                    @error('comment')
                                                    <div class="text-danger mt-2 text-sm">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-3">
                                                    <input type="submit" value="Post Comment" name="submit" class="btn">
                                                </div>

                                            </form>


                                        </div>
                                    </div>
                                    <!--close comments section-->
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">

                    <div class="full-width mt-4">
                        <div class="user-profile">
                            <div class="username-dt dpbg-1">
                                <div class="usr-pic">
                                    <img src="/storage/{{$data->user->image}}" alt="">
                                </div>
                            </div>
                            <div class="username-main-dt">
                                <h4>{{$data->user->username}}</h4>
                            </div>
                            <div class="user-info__sections">
                                <ul class="info__sections">
                                    <li>
                                        <div class="all-info__sections">
                                            <span class="all-info__left">Post Requests</span>
                                            <span class="all-info__right">{{$data->user->request->count()}}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="all-info__sections">
                                            <span class="all-info__left">Tutorial</span>
                                            <span class="all-info__right">{{$data->user->playlist->count()}}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="all-info__sections">
                                            <span class="all-info__left">Courses</span>
                                            <span class="all-info__right">{{$data->user->course->count()}}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="profile-link">
                                <a href="">View Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Bid Model-->
<div class="modal fade" id="addbid" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Request Bid</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container bg-white rounded">
                    <!--bid Form-->
                    <form class="form p-3" method="POST" id="reqbid" action="{{ route('reqbid.store') }}">
                        @csrf
                        <input type="hidden" name="request_id" value="{{ $data->id }}">
                        <input type="hidden" name="user_id" value="{{ Auth()->id() }}" required>
                        <div class="form-group pt-2 pb-2">
                            <label for="price">Enter Your Amount</label>
                            <input type="number" class="form-control" name="price" id="price" placeholder="$"
                                value="{{ old('price') }}">
                            <div class="text-danger mt-2 text-sm priceError"></div>
                        </div>
                        <div class="form-group pt-2 pb-2">
                            <label for="days">In how much days you'll done it</label>
                            <input type="number" class="form-control" name="days" id="days" placeholder=""
                                value="{{ old('days') }}">
                            <div class="text-danger mt-2 text-sm daysError"></div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description"
                                rows="3"> {{ old('description') }}</textarea>
                            <div class="text-danger mt-2 text-sm descriptionError"></div>
                        </div>
                        <hr>
                        <button type="submit" class="apply_job_btn ps-4 view-btn btn-hover"
                            name="submit">submit</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<!--solution Model-->
<div class="modal fade" id="addsolution" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Request Solution</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container bg-white rounded">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <!--sol Form-->
                    <form class="form p-3 form-prevent-mul" method="POST" id="reqsol"
                        action="{{ route('reqsol.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="request_id" value="{{ $data->id }}">
                        <input type="hidden" name="user_id" value="{{ Auth()->id() }}" required>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description"
                                rows="3"> {{ old('description') }}</textarea>
                            <div class="text-danger mt-2 text-sm descriptioneror"></div>
                        </div>
                        <div class="form-group">
                            <label for="description">File/Image</label>
                            <input type="file" class="form-control" id="description" name="file"
                                value=" {{ old('file') }}">
                            <div class="text-danger mt-2 text-sm fileeror"></div>
                        </div>
                        <hr>
                        <button type="submit" class="apply_job_btn ps-4 view-btn btn-hover btn-prevent-mul"
                            name="submit"> submit</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<!--footer-->
@include('layouts.footer')
<!---/footer-->
<!--req Bid model script-->
<script>
    const reqbidform = $('form#reqbid');
    reqbidform.on('submit', (e) => {
        e.preventDefault();
        const formreqbid = document.getElementById('reqbid');
        const formData = new FormData(formreqbid);
        const action = $(e.currentTarget).attr('action');
        formData.append('_token', '{{ csrf_token() }}');
        $.ajax({
            url: action,
            method: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                location.href = location.href;
            },
            error: function(error) {
                const errorResponse = error.responseJSON.errors;
                if (errorResponse.price) {
                    $('.priceError').text(errorResponse.price[0]);
                }
                if (errorResponse.days) {
                    $('.daysError').text(errorResponse.days[0]);
                }
                if (errorResponse.description) {
                    $('.descriptionError').text(errorResponse.description[0]);
                }
               
            }
        })
    })
</script>
<!--req solution model script-->
<script>
    const reqsolform = $('form#reqsol');
    reqsolform.on('submit', (e) => {
        e.preventDefault();
        const formsolbid = document.getElementById('reqsol');
        const formData = new FormData(formsolbid);
        const action = $(e.currentTarget).attr('action');
        formData.append('_token', '{{ csrf_token() }}');
        $.ajax({
            url: action,
            method: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                location.href = location.href;
            },
            error: function(error) {
                const errorResponse = error.responseJSON.errors;
                if (errorResponse.file) {
                    $('.fileeror').text(errorResponse.file[0]);
                }
                if (errorResponse.description) {
                    $('.descriptioneror').text(errorResponse.description[0]);
                }
               
            }
        });
    });
</script>