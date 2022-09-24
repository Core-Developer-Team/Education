@section('title', 'User')
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
                    <h6 class="m-0 font-weight-bold text-primary">Users</h6>
                </div>
                <div class="card-body">
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
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Badge</th>
                                    <th>Cell_no</th>
                                    <th>Uni_id</th>
                                    <th>Uni_name</th>
                                    <th>Solutions</th>
                                    <th>Rating</th>
                                    <th>Gender</th>
                                    <th>Dep</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                    <tr class="text-center">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->role->name }}</td>
                                        <td>{{ $item->badge->name }}</td>
                                        <td>{{ $item->mobile_no }}</td>
                                        <td>{{ $item->uni_id }}</td>
                                        <td>{{ $item->uni_name }}</td>
                                        <td>{{ $item->solutions }}</td>
                                        <td>{{ $item->rating }}</td>
                                        <td>
                                            @if ($item->department == 0)
                                                Male
                                            @elseif ($item->department == 1)
                                                Female
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->department == 0)
                                                bba
                                            @elseif($item->department == 1)
                                                bse
                                            @elseif ($item->department == 2)
                                                bcs
                                            @endif
                                        </td>
                                        <td>{{ $item->email }}</td>
                                        <td><img style="width: 50px; height:50px" src="/storage/{{ $item->image }}"
                                                alt="" srcset=""></td>
                                        <td style="display: inline-flex">
                                            <button type="button" class="btn btn-sm btn-danger delete-confirm"
                                                data-bs-toggle="modal" data-bs-target="#delreq"
                                                data-id="{{ $item->id }}"><i class="fa fa-trash-alt">
                                                </i></button>
                                                <a style="margin-left: 3px" href="{{ route('admin.user.status', ['id'=>$item->id]) }}" class="btn btn-sm btn-info"> @if ($item->status==0)
                                                    Verify
                                                @elseif($item->status==1)
                                                    Unverify
                                                @endif </a>
                                        </td>
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
    <!--delete Model-->
    <div class="modal fade" id="delreq" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                </div>
                <div class="modal-body p-3">
                    <p>Do you really want to delete this User? </p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.user.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="" id="req_id">
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    @include('admin.layouts.footer')
    <script>
        $(document).on("click", ".delete-confirm", function() {
            var reqId = $(this).data('id');
            $(".modal-footer #req_id").val(reqId);
            $('#delreq').modal('show');
        });
    </script>
