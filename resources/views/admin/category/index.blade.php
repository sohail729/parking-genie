@extends('layouts.dashboard')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title fw-normal">Categories</h2>
                            <nav>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ env('APP_NAME') }}</a></li>
                                    <li class="breadcrumb-item active">Categories</li>
                                </ul>
                            </nav>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <ul class="nk-block-tools g-3">                                            
                                <li class="nk-block-tools-opt"><a href="javascript:void(0)" id="add" class="form-cat btn btn-primary" data-route='{{ route("admin.categories.create") }}' data-toggle="modal" data-target="#staticBackdrop"><em class="icon ni ni-plus"></em><span>Add New</span></a></li>
                            </ul>
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
                                            <th>Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($categories)
                                        @foreach( $categories as $category )
                                        <tr id="rowID-{{ $category->id }}">
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$category->title }}</td>
                                            <td>{{$category->type}}</td>
                                            <td>                                             
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a id="edit" class="form-cat btn btn-info btn-sm" href='javascript:void(0)'
                                                        data-id='{{ $category->id }}'
                                                        data-route='{{ route("admin.categories.edit", $category->id) }}'
                                                        data-toggle="modal" data-target="#staticBackdrop"><em
                                                            class="icon ni ni-edit"></em></a>
                                                </div>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a id="delete" class="btn btn-danger btn-sm"
                                                        href='javascript:void(0)' data-id='{{ $category->id }}'
                                                        data-route='{{ route("admin.categories.destroy", $category->id) }}'><em
                                                            class="icon ni ni-trash"></em></a>
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
                <div id="modal-parent">
                    <div class="modal fade" id="staticBackdrop" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).on('click', '.form-cat', function(e) {
        e.preventDefault();
        let modalTitle = $('#modal-parent .modal-title')
        var id = $(this).data('id');
        var url = $(this).data('route');
        typeof id === "undefined" ? modalTitle.text('Add Category') : modalTitle.text('Edit Category')   
        $.ajax({
            url: url,
            data: { id: id },   
            success: function(data) {                
                $('#modal-parent .modal-body').html(data)                
            },
            error: function(error) {
                console.log(error)
                alert('Something went wrong!\nPlease check browser console.')
            }
        });
    });

    $(document).on('click', '#delete', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var url = $(this).data('route');
        Swal.fire({
            icon: 'warning',
            title: 'Are you sure?',
            text: 'This will also remove categories related to this category!',
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
                                title: 'Category Deleted!',
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