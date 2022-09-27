@isset($data)
@section('title', 'Edit Privacy')
@else
@section('title', 'Add Privacy')
@endisset

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
            </div>

            <!-- Content Row -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h1 class="h3 mb-0 text-gray-800"> @isset($data)
                            Update Privacy
                            @else
                            Add Privacy
                            @endisset
                        </h1>
                    </div>
                </div>
                <div class="card-body">
                    <!--book Form-->
                    <form action=" @isset($data) {{ route('admin.updateprivacy.up', ['id' => $data->id]) }}
                    @else
                    {{ route('admin.editprivacy.add') }} @endisset" method="POST" enctype="multipart/form-data">
                        @csrf
                        @isset($data)
                        @method('PATCH')
                        @endisset
                        @if (session('success'))
                        <div class="bg-primary p-4 rounded-lg mb-6 text-white text-center">
                            {{ session('success') }}
                        </div>
                        @endif
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
                            <label for="desc">Description</label>
                            <textarea id="summernote" class="form-control" name="description" rows="3">@isset($data){!! $data->description !!}@else{{ old('description') }}@endisset </textarea>
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