@section('title', 'Moderator')
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
                  @if ($message = Session::get('status')) 
                    <div class="alert alert-success">
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
            <!-- Content Row -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h1 class="h3 mb-0 text-gray-800">Moderator</h1>

                    </div>
                </div>
                <div class="container">
                    @foreach ($moderators as $moderator)
                        <a class="dropdown-item d-flex mt-2 mb-2 align-items-center"
                            href="{{ route($moderator->link, ['id' => $moderator->request_id]) }}">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="/storage/{{ $moderator->user->image }}"
                                    alt="..." style="width: 60px;">
                                <div
                                    class="status-indicator  @if (Cache::has('user-is-online-' . $moderator->user_id)) bg-success @else bg-secondary @endif ">
                                </div>
                            </div>
                            <div class="">
                                <div class="text-truncate"> <span class="font-weight-bold">
                                    </span>{{ $moderator->mesg}} </div>
                                    <div></div>
                                <div class="small text-gray-500">{{ $moderator->created_at->diffForHumans() }}</div>
                            </div>
                        </a>
                   
                    @endforeach

                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->


    <!-- Footer -->
    @include('admin.layouts.footer')
 
