@section('title', 'Edit Role')
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
                        <h1 class="h3 mb-0 text-gray-800">Edit User Role
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
                    <form action="{{route('admin.user.updaterole')}}" method="POST" enctype="multipart/form-data">
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
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <div class="form-group">
                            <label >Name</label>
                            <input type="text" class="form-control" value="{{$user->username}}" name="username">
                        </div>
                        <div class="form-group">
                            <label for="active">Give Role</label>
                            <select name="role" class="form-control">
                                <option value="" selected disabled>Select</option>
                                @foreach ($role as $item)
                                <option value="{{$item->id}}" @if ($item->id == $user->role->id) selected @endif>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary ">
                            Update
                        </button>
                        <a href="{{route('admin.user.index')}}" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    @include('admin.layouts.footer')
