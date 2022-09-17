@section('title', 'Add Resource')
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
                            Update Resource
                            @else
                            Add Resource
                            @endisset
                        </h1>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="bg-primary p-4 rounded-lg mb-6 text-white text-center">
                        {{ session('status') }}
                    </div>
                    @endif
                    <!--Resource Form-->
                    <form action=" @isset($data) {{ route('admin.resources.update', ['resource' => $data->id]) }}
                        @else
                        {{ route('resource.store') }} @endisset" method="POST" enctype="multipart/form-data">
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
                            <label for="name">Resource Name</label>
                            <input type="text" name="name" class="form-control" value="@isset($data) {{ $data->name }}
                            @else {{ old('name') }} @endisset" id="name">
                        </div>
                        <div class="form-group">
                            <label for="file" class="">Select File</label>
                            <input type="file" name="file" class="form-control" id="file" value="@isset($data) {{ $data->file_path }}
                            @else {{ old('file') }} @endisset">
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
                            Add
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