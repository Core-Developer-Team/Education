@section('title', 'Add Proposal')
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
                            Update Proposal
                            @else
                            Add Proposal
                            @endisset
                        </h1>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="bg-primary p-4 rounded-lg mb-6 text-white text-center">
                        {{ session('status') }}
                    </div>
                    @endif
                    <!--Proposal Form-->
                    <form class="form" method="POST" enctype="multipart/form-data" action=" @isset($data) {{ route('admin.proposals.update', ['proposal' => $data->id]) }}
                        @else
                        {{ route('admin.proposal.get') }} @endisset">

                        @csrf
                        @isset($data)
                        @method('PATCH')
                        @endisset

                        <div class="form-group">
                            <label for="proposalname">Project Name</label>
                            <input type="text" class="form-control  @error('proposalname') border-danger @enderror"
                                name="proposalname" id="proposalname" value="@isset($data) {{ $data->proposalname }}
                                @else{{ old('proposalname') }} @endisset" placeholder="Request Name">
                            @error('proposalname')
                            <div class="text-danger mt-2 text-sm">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Project Price</label>
                            <input type="number" class="form-control  @error('price') border-danger @enderror"
                                name="price" id="price" value=@isset($data) {{ $data->price }}
                            @else{{ old('price') }} @endisset
                            placeholder="project price">
                            @error('price')
                            <div class="text-danger mt-2 text-sm">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control  @error('description') border-danger @enderror"
                                id="description" name="description" rows="3">
@isset($data)
{{ $data->description }}
                                @else{{ old('description') }}
@endisset
</textarea>
                            @error('description')
                            <div class="text-danger mt-2 text-sm">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="file">Image/PDF</label>
                            <input type="file" class="form-control  @error('file') border-danger @enderror" name="file"
                                id="file" value=@isset($data) {{ $data->file }}
                            @else{{ old('file') }} @endisset
                            placeholder="Upload image or
                            pdf">
                            @error('file')
                            <div class="text-danger mt-2 text-sm">
                                {{ $message }}
                            </div>
                            @enderror
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