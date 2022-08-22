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
                            Update Tutorial
                            @else
                            Add Tutorial
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
                    <!--tutorial Form-->
                    <form action=" @isset($data) {{ route('admin.tutorials.update', ['tutorial' => $data->id]) }}
                        @else
                        {{ route('admin.tutorial.get') }} @endisset" method="POST" enctype="multipart/form-data">
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
                            <label for="tutorials_name">tutorials_name</label>
                            <input type="text" id="tutorials_name" class="form-control" name="tutorials_name" value="@isset($data) {{ $data->tutorials_name }}
                                @else {{ old('tutorials_name') }} @endisset">
                        </div>
                        <div class="form-group">
                            <label for="price">Book_Price</label>
                            <input type="number" id="price" class="form-control" name="price" value=@isset($data) {{
                                $data->price }}
                            @else {{ old('price') }} @endisset>
                        </div>
                        <div class="form-group">
                            <label for="pic">Image</label>
                            <input type="file" id="pic" class="form-control" name="pic" value="@isset($data) {{ $data->pic }}
                                @else {{ old('pic') }} @endisset">
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