@include('admin.layouts.header')

<!-- Sidebar -->
@include('admin.layouts.leftmenu')
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        @include('admin.layouts.topmenu')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
            </div>

            <!-- Content Row -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h1 class="h3 mb-0 text-gray-800"> @isset($data)
                            Update Request
                            @else
                            Add Request
                            @endisset
                        </h1>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('reqstatus'))
                    <div class="bg-primary p-4 rounded-lg mb-6 text-white text-center">
                        {{ session('reqstatus') }}
                    </div>
                    @endif
                    <!--request Form-->
                    <form class="form" method="POST" id="req" enctype="multipart/form-data" action=" @isset($data) {{ route('admin.request.update', ['request' => $data->id]) }}
                        @else
                        {{ route('req.insert') }} @endisset">
                        @csrf
                        @isset($data)
                        @method('PATCH')
                        @endisset
                        <div class="form-group">
                            <label for="requestname">Request Name</label>
                            <input type="text" class="form-control  @error('requestname') border-danger @enderror"
                                name="requestname" id="requestname" placeholder="Request Name" value="@isset($data) {{ $data->requestname }}
                                @else {{ old('requestname') }} @endisset">
                            @error('requestname')
                            <div class="text-danger mt-2 text-sm">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="coursename">Course/Category Name</label>
                            <input type="text" class="form-control  @error('coursename') border-danger @enderror"
                                name="coursename" id="coursename" placeholder="course or category name" value="@isset($data) {{ $data->coursename }}
                                @else {{ old('coursename') }} @endisset">
                            @error('coursename')
                            <div class="text-danger mt-2 text-sm">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control  @error('description') border-danger @enderror"
                                id="description" name="description" rows="3">
@isset($data)
{{ $data->description }}
@else
{{ old('description') }}
@endisset
</textarea>
                            @error('description')
                            <div class="text-danger mt-2 text-sm">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="file">Image/PDF</label>
                            <input type="file" class="form-control  @error('file') border-danger @enderror" name="file"
                                id="file" placeholder="Upload image or pdf" value=@isset($data) {{ $data->file }}
                            @else {{ old('file') }} @endisset>
                            @error('file')
                            <div class="text-danger mt-2 text-sm">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tag">Course/Category Name</label>
                            <select name="tag" id="tag" value="{{ old('tag') }}"
                                class="form-control @error('tag') border-danger @enderror">
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
                        <button type="submit" class="btn btn-danger" name="submit" value="Submit">
                            @isset($data)
                            Update
                            @else
                            Add
                            @endisset </button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    @include('admin.layouts.footer')