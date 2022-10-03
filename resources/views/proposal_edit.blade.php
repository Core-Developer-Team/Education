@section('title', 'Proposals')
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
            <div class="owl-carousel evtcate_slider">
                @foreach ($categ as $cat)
                    <div class="item text-center">
                        <a href="{{ route('prop.searchcat', ['name' => $cat->category]) }}" class="event-cate-links">
                            <div class="event-full-width">
                                <div class="event-cate-items">
                                    <h6>{{ $cat->category }}</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
            <!--side bar-->
            <aside class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-12 col-sm-12 col-12">
                <div class="full-width mt-10">
                   
                    @include('layouts.sidebar')
                    <div class="full-width mt-5">

                        <div class="manage-section mt-3">
                            <span class="manage-title">Today's Activity</span>
                        </div>
                        <ul class="info__sections">
                            <li>
                                <a class="all-info__sections">
                                    <span class="all-info__left"><i class="feather-grid me-2"></i>Request</span>
                                    <span class="all-info__right">{{ $t_req_count }}</span>
                                </a>
                            </li>
                            <li>
                                <a class="all-info__sections">
                                    <span class="all-info__left"><i class="feather-grid me-2"></i>Proposal</span>
                                    <span class="all-info__right">{{ $t_prop_count }}</span>
                                </a>
                            </li>

                            <li>
                                <a class="all-info__sections">
                                    <span class="all-info__left"><i class="feather-download me-2"></i>Request
                                        Solution</span>
                                    <span class="all-info__right">{{ $t_reqsolution_count }}</span>
                                </a>
                            </li>
                            <li>
                                <a class="all-info__sections">
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
                <div class="container bg-white rounded">
             
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Proposal</h5>
                    </div>
                    @if (session('status'))
                    <div class="bg-primary mt-3 p-4 rounded-lg mb-6 text-white text-center">
                        {{ session('status') }}
                    </div>
                @endif
                            <!--Edit proposal Form-->
                            <form class="form p-3" method="POST" id="proposal" enctype="multipart/form-data"
                                action="{{route('proposal.update')}}">
                                @csrf
                                <input type="hidden" name="proposal_id" value="{{$data->id}}">
                                <div class="form-group">
                                    <label for="proposalname">Project Name</label>
                                    <input type="text" class="form-control" name="proposalname" id="proposalname"
                                       placeholder="Proposal Name"  value="@isset($data) {{ $data->proposalname }}@else{{ old('proposalname') }} @endisset" >
                                    <div class="text-danger mt-2 text-sm proposalname"></div>
                                </div>
                                <div class="form-group pt-2">
                                    <label for="price">Project Price</label>
                                    <input type="number" class="form-control" name="price" id="price"
                                        placeholder="project price" value="@isset($data){{ $data->price }}@else {{ old('price') }} @endisset">
                                    <div class="text-danger mt-2 text-sm price"></div>
                                </div>
                                <div class="form-group">
                                    <label for="days">In How much days</label>
                                    <input type="datetime-local" class="form-control " name="days" id="days"
                                        value="{{ old('days') }}" placeholder="No of Days" value="@isset($data) {{ $data->days }}@else{{ old('days') }} @endisset">
                                    <div class="text-danger mt-2 text-sm dayError"></div>
                                </div>
                                <div class="form-group pt-2">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3">@isset($data) {{ $data->description }}@else{{ old('description') }} @endisset</textarea>
                                    <div class="text-danger mt-2 text-sm description"></div>
                                </div>
                                <div class="form-group">
                                    <label for="category">Project category</label>
                                    <input type="text" class="form-control" name="category" id="category"
                                         placeholder="Proposal category" value="@isset($data) {{ $data->category }}@else{{ old('category') }} @endisset">
                                    <div class="text-danger mt-2 text-sm category"></div>
                                </div>
                                <div class="form-group pt-2">
                                    <label for="file">Image/PDF</label>
                                    <input type="file" class="form-control" name="file" accept="image/*,.pdf"
                                        id="file" placeholder="Upload image or pdf" value="@isset($data) {{ $data->file }}@else{{ old('file') }} @endisset">
                                    <div class="text-danger mt-2 text-sm file"></div>
                                </div>
                                <input type="submit" class="btn mt-3" name="submit" value="Update">
                            </form>
                        </div>
                    
        
             
            </main>
        </div>
    </div>
</div>



<!--footer-->
@include('layouts.footer')
<!---/footer-->
