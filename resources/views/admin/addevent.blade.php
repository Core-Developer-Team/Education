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
                    <form class="form" method="POST" enctype="multipart/form-data"
                        action=" @isset($data) {{ route('admin.event.update', ['event' => $data->id]) }}
                        @else
                        {{ route('admin.event.store') }} @endisset">

                        @csrf
                        @isset($data)
                            @method('PATCH')
                        @endisset

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control  @error('name') border-danger @enderror"
                                name="name" id="name" placeholder="name"
                                value="@isset($data) {{ $data->name }}
                                @else{{ old('name') }} @endisset">
                            @error('name')
                                <div class="text-danger mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" class="form-control  @error('location') border-danger @enderror"
                                name="location" id="location" placeholder="location"
                                value="@isset($data) {{ $data->location }}
                                @else{{ old('location') }} @endisset">
                            @error('location')
                                <div class="text-danger mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="date">Event_Date</label>
                            <input type="date" class="form-control" name="event_date" id="date"
                                placeholder="date" value={{ old('event_date') }}>
                              @error('event_date')
                                <div class="text-danger mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="time">Start_Time</label>
                            <input type="time" class="form-control" name="start_time" id="time"
                                placeholder="time" value={{ old('start_time') }}>
                              @error('start_time')
                                <div class="text-danger mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="time">Event End_Time</label>
                            <input type="time" class="form-control" name="end_time" id="time"
                                placeholder="time" value={{ old('end_time') }}>
                             @error('end_time')
                                <div class="text-danger mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control  @error('description') border-danger @enderror" id="description" name="description"
                                rows="3">
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
                            <label for="image">Image</label>
                            <input type="file" class="form-control  @error('image') border-danger @enderror"
                                name="image" id="image" placeholder="Upload image"
                                value="@isset($data) {{ $data->image }}
                                @else{{ old('image') }} @endisset">
                            @error('image')
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
