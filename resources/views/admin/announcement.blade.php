@section('title', 'Announcement')
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
                                @foreach ($data as $key => $item)
                                    <tr class="text-center">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->description }} </td>
                                        <td class="text-danger">
                                            @if ($item->active == 0)
                                                Deactive
                                            @elseif($item->active == 1)
                                                Active
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.updateannouncement', ['id' => $item->id]) }}"
                                                class="btn btn-sm btn-info"><i class="fa fa-edit">
                                                </i>
                                                @if ($item->active == 1)
                                                    Deactive
                                                @elseif($item->active == 0)
                                                    Activate
                                                @endif
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger delete-confirm"
                                                data-bs-toggle="modal" data-bs-target="#delreq"
                                                data-id="{{ $item->id }}"><i class="fa fa-trash-alt">
                                                </i>
                                            </button>
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
    <div class="modal fade" id="delreq" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                </div>
                <div class="modal-body p-3">
                    <p>Do you really want to delete this Announcement? </p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                    <form action="{{ route('admin.destroyannouncement') }}" method="POST">
                        @csrf
                        <input type="hidden" name="announcement_id" value="" id="announcement_id">
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
            $(".modal-footer #announcement_id").val(reqId);
            $('#delreq').modal('show');
        });
    </script>
