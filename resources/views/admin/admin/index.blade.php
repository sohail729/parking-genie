@extends('layouts.dashboard')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title fw-normal">Admin</h2>
                            <nav>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ env('APP_NAME') }}</a></li>
                                    <li class="breadcrumb-item active">Admin</li>
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
                                <table class="datatable-init-export nowrap table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Municipality/City</th>
                                            <th>Date <small>(Regsitration)</small></th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($admins)
                                        @foreach( $admins as $admin )
                                        <tr id="rowID-{{ $admin->id }}">
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$admin->fname }} {{$admin->lname }}</td>
                                            <td>{{$admin->email ?? 'N/A'}}</td>
                                            <td>{{$admin->municipality ?? 'N/A'}}</td>
                                           <td> {{ getFormattedDate($admin->created_at, 'dS M Y') }} </td>
                                            <td>
                                                @if ($admin->status != 0)
                                                <span class="badge badge-success">Active</span>
                                                @else
                                                <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{-- <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a id="delete" class="btn btn-danger btn-sm"
                                                        href='javascript:void(0)' data-id='{{ $admin->id }}'
                                                        data-route='{{ route("admin.users.destroy", $admin->id) }}'><em
                                                            class="icon ni ni-trash"></em></a>
                                                </div> --}}
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a id="edit" class="btn btn-info btn-sm"
                                                        href='{{ route("admin.users.edit", $admin->id) }}'><em
                                                            class="icon ni ni-edit"></em></a>
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