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
                        <h1 class="h3 mb-0 text-gray-800">Announcement</h1>
                        <a href="{{ route('admin.addannouncement') }}" type="button"
                            class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Add
                            Announcement</a>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="bg-primary p-4 rounded-lg mb-6 text-white text-center">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>No.</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($announcements as $key => $announcement)
                                    <tr class="text-center">
                                        <td>{{ $key }}</td>
                                        <td>{{ $announcement->description }}</td>
                                        <td>
                                            @if ($announcement->active == 0)
                                                Not_active
                                            @else
                                                active
                                            @endif
                                        </td>
                                        <td>
                                            @if ($announcement->active == 0)
                                                <a href="{{ route('admin.updateannouncement', ['id'=>$announcement->active]) }}" class="btn btn-sm btn-info"><i class="fa fa-edit">
                                                    </i> Activate </a>
                                        </td>
                                    @else
                                        <a href="{{ route('admin.updateannouncement', ['id'=>$announcement->active]) }}" class="btn btn-sm btn-info"><i class="fa fa-edit">
                                            </i> Deactivate </a></td>
                                @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    @include('admin.layouts.footer')
