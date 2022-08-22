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
                            Update Book
                            @else
                            Add Book
                            @endisset
                        </h1>
                    </div>
                </div>
                <div class="card-body">
                    <!--book Form-->
                    <form action=" @isset($data) {{ route('admin.book.update', ['book' => $data->id]) }}
                    @else
                    {{ route('admin.books.store') }} @endisset" method="POST" enctype="multipart/form-data">
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
                            <label for="price">Book_Price</label>
                            <input type="number" id="price" class="form-control" name="price" value=@isset($data) {{
                                $data->price }}
                            @else {{ old('price') }} @endisset>
                        </div>
                        <div class="form-group">
                            <label for="cover-pic">Book_Cover_Image</label>
                            <input type="file" id="cover-pic" class="form-control" name="cover_pic" value=" @isset($data) {{ $data->cover_pic }}
                                @else
                                {{ old('cover-pic') }} @endisset
                               ">
                        </div>
                        <div class="form-group">
                            <label for="book">Upload_Book</label>
                            <input type="file" id="book" class="form-control" name="book" value=" @isset($data) {{ $data->book }}
                                @else
                                {{ old('book') }} @endisset
                               ">
                        </div>
                        <div class="form-group">
                            <label for="desc">Description</label>
                            <textarea id="desc" class="form-control" name="description" rows="3"> @isset($data)
{{ $data->description }}
@else
{{ old('description') }}
@endisset </textarea>
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