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
                        <h1 class="h3 mb-0 text-gray-800"> Add Anouncememt
                        </h1>
                    </div>
                </div>
                <div class="card-body">

                    <!--Proposal Form-->
                    <form class="form" method="POST" enctype="multipart/form-data"
                        action="{{ route('admin.storeannouncement') }}">
                        @csrf
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control  @error('description') border-danger @enderror" id="description" name="description"
                                rows="3"> {{ old('description') }} </textarea>
                            @error('description')
                                <div class="text-danger mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Active_Status</label>
                            <select name="status" class="form-control  @error('status') border-danger @enderror">
                                <option value="0">Deactive</option>
                                <option value="1">Active</option>
                            </select>
                            @error('status')
                                <div class="text-danger mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary mt-4">Add</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    @include('admin.layouts.footer')
