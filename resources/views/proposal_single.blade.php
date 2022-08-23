@include('layouts.header')

<header class="header clearfix">
    <div class="header-inner">
        @include('layouts.menu')
        <div class="overlay"></div>
    </div>
</header>


<div class="wrapper pt-0">

    <div class="page-tabs">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="">Proposal Details</a>
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
                                        <div class="author-dts">
                                            <h4 class="job-view-heading job-center">{{$data->proposalname}}</h4>
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
                                                        class="feather-users ms-2"></i><span>Applicants</span><ins>{{$data->proposalbid()->count()}}</ins>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="action-btns-job job-center resmargin">
                                        @if (!(auth()->id() == $data->user_id))
                                        <a href="#"
                                            class="apply_job_btn ps-4 view-btn btn-hover  @if ($data->proposalbid()->where('user_id', Auth()->id())->count() >= 1) d-none @endif"
                                            data-bs-toggle="modal" data-bs-target="#addproposalbid">Bid Now</a>
                                        <a href="#"
                                            class="apply_job_btn ps-4 view-btn btn-hover @if ($data->propsolution()->where('user_id', Auth()->id())->count() >= 1) d-none @endif"
                                            data-bs-toggle="modal" data-bs-target="#addsolution">Solution</a>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9 col-md-12">
                    @if (session('status'))
                    <div class="bg-danger p-4 rounded-lg mb-6 text-white text-center">
                        {{ session('status') }}
                    </div>
                    @endif
                    @if (session('solstatus'))
                    <div class="bg-danger p-4 rounded-lg mb-6 text-white text-center">
                        {{ session('solstatus') }}
                    </div>
                    @endif
                    <!--All Bids-->
                    @if (auth()->id() == $data->user_id)
                    <div class="event-card mt-4">
                        <div class="jobdt99">
                            <div class="jbdes25">
                                <div class="jobtxt47">
                                    <h4>All Bids</h4>
                                    <hr>
                                    @forelse ($data->proposalbid()->orderBy('updated_at','DESC')->get() as $bids)
                                    <div
                                        class="d-sm-flex align-items-center rounded border-none mt-3 p-3 justify-content-between mb-4">
                                        <div class="">
                                            <div class="rounded-circle d-flex">
                                                <img src="/storage/{{ $bids->user->image }}" class="rounded-circle"
                                                    style="width: 50px;height: 50px;" alt="" srcset="">
                                                <div class="ps-4 pt-3">
                                                    <p class="h3">{{ $bids->user->username }}</p>
                                                    <p> <small>Bid on
                                                            {{ $bids->created_at->diffForHumans() }}</small>
                                                    </p>
                                                    <p>{{ $bids->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <span class="job-badge ddcolor">${{$bids->price}}</span>

                                            <button class="btn">Reply</button>
                                        </div>
                                    </div>
                                    <hr>
                                    @empty
                                    <div class="bg-danger mt-4 p-4 rounded-lg mb-6 text-white text-center">
                                        Sorry No Bid Yet
                                    </div>
                                    @endforelse
                                </div>

                            </div>
                        </div>
                    </div>
                    @endif
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
                                    @forelse ($data->propsolution()->orderBy('updated_at','DESC')->get() as $item)
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

                                                    <a href="{{ $data->file }}" download>Download here</a>
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
                    <!--file-->
                    <div class="event-card mt-4">
                        <div class="jobdt99">
                            <div class="jbdes25">
                                <div class="jobtxt47">
                                    <h4>Download file from here</h4>
                                    <hr>
                                    <a href="{{ $data->file }}" download>Download here</a>
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
                                            <span class="all-info__left">Post Proposal</span>
                                            <span class="all-info__right">{{$data->user->proposal->count()}}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="all-info__sections">
                                            <span class="all-info__left">Products</span>
                                            <span class="all-info__right">{{$data->user->product->count() + $data->user->book->count()}}</span>
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
                                <a href="{{ route('profile.show', ['id'=>$data->user_id]) }}">View Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--Bid Model-->
<div class="modal fade" id="addproposalbid" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Proposal Bid</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container bg-white rounded">
                    <!--bid Form-->
                    <form class="form p-3" method="POST" id="probid" action="{{ route('proposalbid.store') }}">
                        @csrf
                        <input type="hidden" name="proposal_id" value="{{ $data->id }}">
                        <div class="form-group">
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
                        <div class="form-group pt-2">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description"
                                rows="3"> {{ old('description') }}</textarea>
                            <div class="text-danger mt-2 text-sm descriptionError"></div>
                        </div>
                        <input type="submit" class="view-btn btn-hover mt-2" name="submit" value="Submit">
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
                <h5 class="modal-title" id="exampleModalLabel">Proposal Solution</h5>
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
                    <form class="form p-3 form-prevent-mul" method="POST" id="propsol"
                        action="{{route('prosolution.store')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="proposal_id" value="{{ $data->id }}">
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
<!--proposal Bid model script-->
<script>
    const probidform = $('form#probid');
    probidform.on('submit', (e) => {
        e.preventDefault();
        const formprobid = document.getElementById('probid');
        const formData = new FormData(formprobid);
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
    const reqsolform = $('form#propsol');
    reqsolform.on('submit', (e) => {
        e.preventDefault();
        const formprosolbid = document.getElementById('propsol');
        const formData = new FormData(formprosolbid);
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