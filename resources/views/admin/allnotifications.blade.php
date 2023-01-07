@section('title', 'All Notification')
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
                        <h1 class="h3 mb-0 text-gray-800">All Notifications</h1>

                    </div>
                </div>
                <div class="container">
                    @foreach (auth()->user()->Notifications as $notification)
                    <div class="row w-100">
                        <a class="dropdown-item d-flex mt-2 mb-2 align-items-center"
                            href="{{ route($notification->data['link'], ['id' => $notification->data['request_id']]) }}">
                            <div class="dropdown-list-image mr-3" style="width: 60px;">
                                <img class="rounded-circle w-100" src="/storage/{{ $notification->data['image'] }}"
                                    alt="...">
                                <div class="status-indicator  @if (Cache::has('user-is-online-' . $notification->data['user_id'])) bg-success @else bg-secondary @endif "></div>
                            </div>
                            <div class="">
                                <div class="text-truncate"> <span class="font-weight-bold">
                                        @if ($notification->notifiable_id == $notification->data['user_id'])
                                            You
                                        @else
                                            {{ $notification->data['name'] }}
                                        @endif
                                    </span>{{ $notification->data['mesg'] }}
                                   @if($notification->data['remesg'])<p> {{ $notification->data['remesg'] }}</p>
                                   @endif
                                </div>
                                <div class="small text-gray-500">{{ $notification->created_at->diffForHumans() }}</div>
                            </div>
                        </a>
                        <div class="dropdown no-arrow mb-4 show">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                              Asign to moderator
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);" x-placement="bottom-start">

                                @foreach ($users as $user)
                                @if ($user->role->name == 'Moderator')
                                    <a class="dropdown-item" href="{{route('admin.notification.assign', ['uid'=>$notification->data['user_id'],'rid'=>$notification->data['request_id'],'link'=>$notification->data['link']])}}">{{ $user->username }}</a>
                                @endif
                            @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->


    <!-- Footer -->
    @include('admin.layouts.footer')

