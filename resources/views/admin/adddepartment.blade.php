@section('title', 'Add Dep')
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
                        <h1 class="h3 mb-0 text-gray-800">Add Book
                        </h1>
                    </div>
                </div>
                <div class="card-body">
                    <!--book Form-->
                    <form action="{{route('admin.dep.add')}}" method="POST" enctype="multipart/form-data">
                        @csrf
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
                            <label for="dep">Name</label>
                            <input type="text" id="dep" class="form-control" name="name" placeholder="Please Use Department abbreviation" value="{{old('name')}}" >
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary mt-4">
                            Add
                        </button>
                        
                        <a href="{{route('admin.dep')}}" type="submit" name="submit" class="btn btn-danger mt-4"> Cancel </a>
                         
                    </form>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    @include('admin.layouts.footer')