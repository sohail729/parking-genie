@extends('layouts.dashboard')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title fw-normal">Subscriptions</h2>
                            <nav>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ env('APP_NAME') }}</a></li>
                                    <li class="breadcrumb-item active">Subscriptions</li>
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
                                            <th>Stripe Customer ID</th>
                                            <th>Name</th>
                                            <th>Price/Interval</th>
                                            <th>Current Plan</th>
                                            <th>Next Billing Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($subscriptions)
                                        @foreach( $subscriptions as $subscription )
                                        <tr id="rowID-{{ $subscription->id }}">
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$subscription->stripe_cus_id ?? 'N/A'}}</td> 
                                            <td>
                                                @isset($subscription->subscriber_info)
                                                {{$subscription->subscriber_info->fname }} {{$subscription->subscriber_info->lname }}
                                                @else
                                                N/A
                                                @endisset
                                            </td> 
                                            <td>
                                               ${{$subscription->plan->amount}}
                                               /
                                               {{ $subscription->plan->period }}
                                            </td> 
                                            <td>{{$subscription->plan->title }}</td> 
                                            <td>
                                                {{ getFormattedDate($subscription->next_billing, 'dS M Y') }}
                                            </td> 
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a id="view" title="View Subscription Details" class="btn btn-info btn-sm" href='javascript:void(0)'
                                                        data-route='{{ route("admin.subscription.show", $subscription->id) }}'
                                                        data-toggle="modal" data-target="#staticBackdrop"><em
                                                            class="icon ni ni-eye"></em></a>
                                                </div>
                                                <div class="btn-group" role="group">
                                                    <a title="Download Invoice" class="btn btn-info btn-sm" href='{{ $subscription->receipt }}' target="_blank" ><em
                                                            class="icon ni ni-download"></em></a>
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
                    <div class="modal fade" id="staticBackdrop" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
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
                </div><!-- .components-preview -->
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).on('click', '#view', function(e) {
        e.preventDefault();
        var url = $(this).data('route');
        $('.modal .modal-title').text('Subscription Details')                
        $('.modal .modal-body').html('Retrieving Data ...\nThis might take a little while :)')                
        $.ajax({
            url: url,
            success: function(data) {
                $('.modal .modal-body').html(data)                
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
            text: 'You will have to create a new plan!',
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
                                title: 'Plan Deleted!',
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