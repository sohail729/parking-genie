@extends('layouts.dashboard')

@section('content')
<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title fw-normal">My Bookings</h2>
                            <nav>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Space Bookings</a></li>
                                </ul>
                            </nav>
                        </div><!-- .nk-block-head-content -->

                    </div><!-- .nk-block-between -->
                </div>

                <!-- main alert @s -->
                @include('dashboard.partials.alerts')
                <!-- main alert @e -->


                <div class="components-preview  mx-auto">
                    <div class="nk-block">
                        <div class="row g-gs">
    
                            <div class="col-sm-6 col-lg-3 col-xxl-3">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start mb-2">
                                            <div class="card-title">
                                                <h6 class="title">Total Amount Spent</h6>
                                            </div>
                                        </div>
                                        <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                            <div class="nk-sale-data">
                                                <span class="amount">${{ $total_transaction ?? 0 }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .card -->
                            </div><!-- .col -->
                            <div class="col-sm-6 col-lg-3 col-xxl-3">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start mb-2">
                                            <div class="card-title">
                                                <h6 class="title">Number Spaces Booked</h6>
                                            </div>
                                        </div>
                                        <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                            <div class="nk-sale-data">
                                                <span class="amount"> {{ $total_bookings ?? 0 }}</span>
    
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .card -->
                            </div><!-- .col -->
    
                        </div><!-- .row -->
                    </div><!-- .nk-block -->

                    <div class="nk-block nk-block-lg">
                        <div class="card card-preview">
                            <div class="card-inner">
                                <div class="row">
                                    <div class="col-md-2 offset-md-10">
                                        <div class="form-group mb-2 w-60 float-right">
                                            <select name="show_type" class="form-select">
                                                <option value="hourly" selected>Hourly</option>
                                                <option value="daily">Daily</option>
                                                <option value="weekly">Weekly</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                             
                               <div class="card-content">
                                    {!! $html !!}
                               </div>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->
                </div><!-- .components-preview -->
            </div>
        </div>
    </div>
</div>

<!-- content @e -->
@endsection
@push('scripts')
<script>
    $(document).on('change', 'select[name="show_type"]', function(e){
        e.preventDefault()
        let show = $(this).val()
        $.ajax({
            url:" {{ route('user.space.by-type') }}",
            data: { t: show },   
            success: function(data) {
                $('.card .card-content').html(data)
                NioApp.DataTable.init();
            },
            error: function(error) {
                console.log(error)
                alert('Something went wrong!\nPlease check browser console.')
            }
        });
    })

</script>
    
@endpush