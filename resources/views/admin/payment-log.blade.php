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
                {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
            </div>

            <!-- Content Row -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h1 class="h3 mb-0 text-gray-800">Payment Log</h1>
                        <div class="btn-group btn-group-md">
                            @if($items)
                            @foreach ($items as $k=>$item)
                            <a href="{{route('admin.payment-log',["step"=>$k])}}" type="button" class="btn btn-primary text-uppercase">{{$k}}</a>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>No.</th>
                                    <th>Seller</th>
                                    <th>Buyer</th>
                                    <th>Price</th>
                                    <th title="Seller Phone">Phone</th>
                                    <th >Agent({{env('RATE_FOR_AGENT')}})%</th>
                                    <th >Seller({{100 - env('RATE_FOR_AGENT')}})%</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($collections as $k=>$item)
                                <tr class="text-center">
                                    <td>{{$k}}</td>
                                    <td>{{$model->findSeller($item->id)->user->username}}</td>
                                    <td>{{$item->fundBuyer->username}}</td>
                                    <td>{{$item->amount}}</td>
                                    <td title="Seller Phone">{{$model->findSeller($item->id)->user->mobile_no}}</td>
                                    <td>
                                        {{ $item->amount * env("RATE_FOR_AGENT") / 100 }}
                                    </td>
                                    <td>
                                        {{ $item->amount * (100 - env("RATE_FOR_AGENT")) / 100 }}
                                    </td>
                                    <td>
                                        @if ($item->status !=true)
                                        <span class="badge rounded-pill bg-danger text-light p-2" title="Unpaid to seller">Due</span>
                                        @else
                                        <span class="badge rounded-pill bg-success text-light p-2" title="Paid to seller">Paid</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status != true)
                                        <button data-href="{{route('admin.pay-to-seller',$item->id)}}" type="submit" class="btn btn-sm btn-primary payToSeller" title="Make Payment to {{$model->findSeller($item->id)->user->username}}"><span class="text-uppercase text-light"> $ </span></button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer -->
@include('admin.layouts.footer')
{{-- Footer --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $(document).on("click",".payToSeller",function(){
            let url = $(this).attr('data-href');
            swal.fire({
                title: 'Are you sure?',
                text: "Are you sure you want to proceed ?",
                type: 'warning',
                icon:'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes'
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                    url : url,
                    type : 'GET',
                    dataType:'json',
                    beforeSend: function() {
                        swal.fire({
                            title: 'Please Wait..!',
                            text: 'Is working..',
                            onOpen: function() {
                                swal.showLoading()
                            }
                        })
                    },
                    success : function(data) {
                        swal.fire({
                            position: 'top-right',
                            type: 'success',
                            title: 'Process Done Successfully',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(function(){
                            location.reload();
                        });
                    },
                    complete: function() {
                        swal.hideLoading();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal.hideLoading();
                        swal.fire("!Opps ", "Something went wrong, try again later", "error");
                    }
                })
                }
            });
        });
    })
</script>
