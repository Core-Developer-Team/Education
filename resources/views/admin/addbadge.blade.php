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
                            Update Badge
                            @else
                            Add Badge
                            @endisset
                        </h1>
                    </div>
                </div>
                <div class="card-body">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    <!--course Form-->
                    <form action=" @isset($data) {{ route('admin.badge.update', ['badge' => $data->id]) }}
                        @else
                        {{ route('admin.badge.store') }} @endisset " method="POST" enctype="multipart/form-data">
                        @csrf
                        @isset($data)
                        @method('PATCH')
                        @endisset

                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="name">Badge_name</label>
                            <input type="text" id="name" class="form-control" name="name" value="@isset($data) {{ $data->name }}
                                @else {{ old('name') }} @endisset">
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" id="image" class="form-control" name="image" value=@isset($data) {{
                                $data->image }}
                            @else {{ old('image') }} @endisset>
                        </div>
                        <div class="form-group">
                            <label for="desc">Description</label>
                            <textarea id="desc" class="form-control" name="description" rows="3">
@isset($data)
{{ $data->description }}
@else
{{ old('description') }}
@endisset
</textarea>
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary mt-4">
                            @isset($data)
                            Update
                            @else
                            Upload
                            @endisset
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    @include('admin.layouts.footer')