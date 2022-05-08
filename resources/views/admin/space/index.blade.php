@extends('layouts.dashboard')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title fw-normal">Spaces</h2>
                            <nav>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ env('APP_NAME') }}</a></li>
                                    <li class="breadcrumb-item active">Spaces</li>
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
                                <table class="datatable-init nowrap table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Address</th>
                                            <th>Price <small>(hourly)</small></th>
                                            <th>Session</th>
                                            <th>Timings</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($spaces)
                                        @foreach( $spaces as $space )
                                        <tr id="rowID-{{ $space->id }}">
                                            <td>{{$loop->iteration}}</td>
                                            <td><p title="{{ $space->title }}">{{ htmlToText($space->title, 15)}}</p></td>
                                            <td title="{{ $space->address }}">{{ htmlToText($space->address, 30) }}</td>
                                            <td>${{$space->base_price}}</td>
                                            <td>{{getMonth($space->session_start) }} - {{getMonth($space->session_end) }}
                                            </td>
                                            <td> {{ getTime($space->earliest_reservation) }} - {{ getTime($space->lastest_reservation) }}
                                            </td>
                                           
                                            <td>                                               
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a id="show" class="btn btn-info btn-sm"
                                                        href='{{ route("admin.space.show", $space->id) }}'><em
                                                            class="icon ni ni-eye"></em></a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
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
    $(document).on('click', '#delete', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var url = $(this).data('route');
        Swal.fire({
            icon: 'warning',
            title: 'Are you sure?',
            text: 'This will also remove resources related to this user!',
            showCancelButton: true,
            confirmButtonColor: 'red',
            confirmButtonText: `Delete`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: url,
                    data: {id: id},
                    success: function(data) {
                        if (data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'User Deleted!',
                                confirmButtonText: `OK`,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            })
                        }
                    },
                    error: function(error) {
                        Swal.fire('Something went wrong!!', '', 'error')
                    }
                });
            }
        })
    });
</script>
@endpush