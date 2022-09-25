@section('title', 'Add Course')
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
                            Update Course
                            @else
                            Add Course
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
                    <form action=" @isset($data) {{ route('admin.courses.update', ['course' => $data->id]) }}
                        @else
                    {{ route('course.get') }} @endisset" method="POST" enctype="multipart/form-data">
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
                            <label for="coursename">Coursename</label>
                            <input type="text" id="coursename" class="form-control" name="coursename" value="@isset($data) {{ $data->coursename }}
                                @else {{ old('coursename') }} @endisset">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" id="price" class="form-control" name="price" value=@isset($data) {{
                                $data->price }}
                            @else {{ old('price') }} @endisset>
                        </div>
                        <div class="form-group">
                            <label for="pic">Image</label>
                            <input type="file" id="pic" class="form-control" name="pic" value=@isset($data) {{
                                $data->pic }}
                            @else {{ old('pic') }} @endisset>
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