@section('title','Request_Edit')
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
           
            <!--side bar-->
            <aside class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-12 col-sm-12 col-12">
                <div class="full-width mt-10">
                    <div class="btn_1589">
                        <a href="" class="post-link-btn btn-hover" data-bs-toggle="modal"
                            data-bs-target=" @auth
#addrequest
            @else
            #loginlink @endauth ">Post
                            your problem</a>
                    </div>
                    @include('layouts.sidebar')
                    <div class="full-width mt-5">

                        <div class="manage-section mt-3">
                            <span class="manage-title">Today's Activity</span>
                        </div>
                        <ul class="info__sections">
                            <li>
                                <a  class="all-info__sections">
                                    <span class="all-info__left"><i class="feather-grid me-2"></i>Request</span>
                                    <span class="all-info__right">{{ $t_req_count }}</span>
                                </a>
                            </li>
                            <li>
                                <a  class="all-info__sections">
                                    <span class="all-info__left"><i class="feather-grid me-2"></i>Proposal</span>
                                    <span class="all-info__right">{{ $t_prop_count }}</span>
                                </a>
                            </li>

                            <li>
                                <a  class="all-info__sections">
                                    <span class="all-info__left"><i class="feather-download me-2"></i>Request
                                        Solution</span>
                                    <span class="all-info__right">{{ $t_reqsolution_count }}</span>
                                </a>
                            </li>
                            <li>
                                <a  class="all-info__sections">
                                    <span class="all-info__left"><i class="feather-download me-2"></i>Proposal
                                        Solution</span>
                                    <span class="all-info__right">{{ $t_propsolution_count }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>

            </aside>
            <!--/side bar-->
            <main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">

                <div class="full-width mt-4">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit/Update Request</h5>
                        </div>
                        <div class="modal-body p-3">
                            <div class="container bg-white rounded">
                                @if (session('reqstatus'))
                                    <div class="bg-primary p-4 rounded-lg mb-6 text-white text-center">
                                        {{ session('reqstatus') }}
                                    </div>
                                @endif
                                <!--Request Form-->
                                <form class="form" method="POST" enctype="multipart/form-data"
                                    action="{{ route('req.upd', ['id' => $data->id]) }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="requestname">Request Name</label>
                                        <input type="text" class="form-control " name="requestname"
                                            id="requestname" placeholder="Request Name"
                                            value="@isset($data) {{ $data->requestname }} @else {{ old('requestname') }} @endisset">
                                        @error('requestname')
                                            <div class="text-danger mt-2 text-sm">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Request Price</label>
                                        <input type="number" class="form-control" name="price" id="price"
                                            placeholder="Price"
                                            value=@isset($data) {{ $data->price }}
                                                @else {{ old('price') }} @endisset>
                                        @error('price')
                                            <div class="text-danger mt-2 text-sm">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="days">In How much days</label>
                                        <input type="datetime-local" class="form-control " name="days" id="days"
                                            value="{{ old('days') }}" placeholder="No of Days"  value=@isset($data) {{$data->days }}
                                            @else {{ old('days') }} @endisset>
                                            @error('days')
                                            <div class="text-danger mt-2 text-sm">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                
                                    <div class="form-group pt-2">
                                        <label for="coursename">Course/Category Name</label>
                                        <input type="text" class="form-control" name="coursename" id="coursename"
                                            value="@isset($data){{ $data->coursename }}@else {{ old('coursename') }}@endisset">
                                        @error('coursename')
                                            <div class="text-danger mt-2 text-sm">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group pt-2">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" name="description" rows="3">@isset($data){{ $data->description }}@else{{ old('data') }}@endisset</textarea>
                                        @error('description')
                                            <div class="text-danger mt-2 text-sm">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group pt-2">
                                        <label for="file">Image/PDF</label>
                                        <input type="file" class="form-control" name="file" id="file"
                                            placeholder="Upload image or pdf" accept="image/*,.pdf,.zip,.rar"
                                            value=@isset($data) {{ $data->file }}
                                                @else {{ old('file') }} @endisset>
                                        @error('file')
                                            <div class="text-danger mt-2 text-sm">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group pt-2">
                                        <label for="tag">Course/Category Name</label>
                                        <select name="tag" id="tag" value="{{ old('tag') }}"
                                            class="form-control">
                                            <option selected disabled>Select Tag</option>
                                            @isset($data)

                                                @if ($data->tag == 1)
                                                    <option value="0">Offline</option>
                                                    <option value="1" selected>Online</option>
                                                @else
                                                    <option value="0" selected>Offline</option>
                                                    <option value="1">Online</option>
                                                @endif
                                            @endisset
                                        </select>
                                        @error('tag')
                                            <div class="text-danger mt-2 text-sm">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="post-link-btn btn-hover mt-2" name="submit"
                                        value="Submit"> Update
                                    </button>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </main>

        </div>
    </div>
</div>
</div>

<!--Request Model-->
<div class="modal fade" id="addrequest" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <div class="container bg-white rounded">
                    <!--Request Form-->
                    <form class="form" method="POST" id="req" enctype="multipart/form-data"
                        action="{{ route('req.insert') }}">
                        @csrf
                        <div class="form-group">
                            <label for="requestname">Request Name</label>
                            <input type="text" class="form-control " name="requestname" id="requestname"
                                value="{{ old('requestname') }}" placeholder="Request Name">
                            <div class="text-danger mt-2 text-sm requestnameError"></div>
                        </div>
                        <div class="form-group">
                            <label for="price">Request Price</label>
                            <input type="number" class="form-control " name="price" id="price"
                                value="{{ old('price') }}" placeholder="Request Name">
                            <div class="text-danger mt-2 text-sm priceError"></div>
                        </div>
                        <div class="form-group pt-2">
                            <label for="coursename">Course/Category Name</label>
                            <input type="text" class="form-control" name="coursename" id="coursename"
                                value="{{ old('coursename') }}" placeholder="course or category name">
                            <div class="text-danger mt-2 text-sm coursenameError"></div>
                        </div>
                        <div class="form-group pt-2">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
                            <div class="text-danger mt-2 text-sm descriptionError"></div>
                        </div>
                        <div class="form-group pt-2">
                            <label for="file">Image/PDF</label>
                            <input type="file" class="form-control" name="file" id="file"
                                value="{{ old('file') }}" placeholder="Upload image or pdf">
                            <div class="text-danger mt-2 text-sm fileError"></div>
                        </div>
                        <div class="form-group pt-2">
                            <label for="tag">Course/Category Name</label>
                            <select name="tag" id="tag" value="{{ old('tag') }}" class="form-control">
                                <option selected disabled>Select Tag</option>
                                <option value="0">Offline</option>
                                <option value="1">Online</option>
                            </select>
                            <div class="text-danger mt-2 text-sm tagError"></div>
                        </div>
                        <button type="submit" class="post-link-btn btn-hover mt-2" name="submit" value="Submit">
                            Submit
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
