@extends('layouts.dashboard')
@push('styles')
@endpush
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title fw-normal">Bookings</h2>
                            <nav>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('host.dashboard.index') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" > <a href="javascript:void(0)">Bookings</a></li>
                                </ul>
                            </nav>
                        </div><!-- .nk-block-head-content -->

                    </div><!-- .nk-block-between -->
                </div>

                <!-- main alert @s -->
                @include('dashboard.partials.alerts')
                <!-- main alert @e -->

                <div class="components-preview  mx-auto">
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

@endsection
@push('scripts')
<script>
    $(document).on('change', 'select[name="show_type"]', function(e){
        e.preventDefault()
        let show = $(this).val()
        $.ajax({
            url:" {{ route('admin.space.by-type') }}",
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