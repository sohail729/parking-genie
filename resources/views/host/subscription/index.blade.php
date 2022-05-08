@extends('layouts.dashboard')


@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview mx-auto">
                    <div class="nk-block-head nk-block-head-lg wide-sm">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title fw-normal">Subscription</h2>
                            <nav>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('host.dashboard.index') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Current
                                            Subscription</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div><!-- .nk-block-head -->

                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="row g-gs">
                                    @if (isset($subscription) && $subscription->status != 'unsubscribed')
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            @if ($subscription->status == 'unsubscribed')
                                            {{-- <a class="btn btn-success btn-xs float-right" id="sa"
                                                data-cid="{{ $subscription->stripe_cus_id }}"
                                                data-url="{{ route('host.subscription.reactivate') }}"
                                                href='javascript:void(0)' target="_blank">Reactivate Subscription</a>
                                            --}}
                                            @else
                                            <a class="btn btn-danger btn-xs float-right" id="sc"
                                                data-cid="{{ $subscription->stripe_cus_id }}"
                                                data-url="{{ route('host.subscription.cancel') }}"
                                                href='javascript:void(0)' target="_blank">Cancel Subscription</a>

                                            @endif
                                        </div>
                                    </div>
                                    @unless ($subscription->status == 'unsubscribed')

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Name</label>
                                            <div class="form-control-wrap">
                                                <div class="form-control disabled">{{
                                                    $subscription->subscriber_info->fname }} {{
                                                    $subscription->subscriber_info->lname }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Current Plan</label>
                                            <div class="form-control-wrap">
                                                <div class="form-control disabled">{{ $subscription->plan->title }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Subscription Date</label>
                                            <div class="form-control-wrap">
                                                <div class="form-control disabled">{{
                                                    getFormattedDate($subscription->current_period_start, 'dS M
                                                    Y') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Next Billing Date</label>
                                            <div class="form-control-wrap">
                                                <div class="form-control disabled">{{
                                                    getFormattedDate($subscription->next_billing, 'dS M Y')
                                                    }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Amount</label>
                                            <div class="form-control-wrap">
                                                <div class="form-control disabled">
                                                    ${{ $subscription->plan->amount}} </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Interval</label>
                                            <div class="form-control-wrap">
                                                <div class="form-control disabled">
                                                    {{ $subscription->plan->period }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Status</label>
                                            <div class="form-control-wrap">
                                                <div class="form-control disabled">
                                                    @isset($subscription)
                                                    Active
                                                    @endisset
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <a title="Download Invoice" class="btn btn-info btn-xs float-right"
                                                href='{{ $subscription->receipt }}' target="_blank">
                                                Download Receipt&nbsp;<em class="icon ni ni-download"></em></a>
                                        </div>
                                    </div>
                                    @endunless

                                    @else
                                    <div class="col-md-12">
                                        <p><strong>No Subscription</strong></p>
                                    </div>
                                    @endif

                                    @unless (isset($subscription) && $subscription->status != 'unsubscribed')
                                    @foreach ($plans as $key => $plan)
                                    <?php if($key== 'free') continue ?>
                                    <div class="col-sm-12 col-lg-6 ">
                                        <div class="card0 card-bordered pricing text-center">
                                            <div class="ani pricing-body">
                                                <div class="pricing-media">
                                                    @foreach ($plan as $keySub => $package)
                                                    <?php if($keySub==1) break ?>
                                                    <a href="javascript:void(0)">
                                                        @if( $package->image !=null)
                                                        <img src="{{ asset('plans/'.$package->image) }}" alt="image"
                                                            class="image1 img-thumbnail" />
                                                        @else
                                                        <img src="{{ asset('categories/plan'.$loop->parent->iteration.'.webp') }}"
                                                            alt="image" class="image1 img-thumbnail" />
                                                        @endif
                                                    </a>
                                                    @endforeach
                                                </div>
                                                <div class="pricing-title w-220px mx-auto">
                                                    <h5 class="title">{{ $plan[0]->title }}</h5>
                                                    <small>({{ $plan[0]->sub }})</small><br>
                                                    @if (isset($subscription) && $subscription->status ==
                                                    'unsubscribed')
                                                    <form action="{{ route('host.subscription.new') }}" method="post"
                                                        class="subsForm">
                                                        @csrf
                                                        @else
                                                        <form action="{{ route('host.subscription.payment') }}"
                                                            class="subsForm">
                                                            @endif
                                                            <select name="pid" class="form-select">
                                                                @foreach ($plan as $key => $package)
                                                                @unless ($package->amount == 0)
                                                                <option value="{{ $package->stripe_prod_id }}">${{
                                                                    $package->amount }}</option>
                                                                @else
                                                                <option value="{{ $package->stripe_prod_id }}">Free
                                                                </option>
                                                                @endunless
                                                                @endforeach
                                                            </select>
                                                            <input type="button" onclick="getForm(this)"
                                                                class="btn btn-sm btn-success mt-2 subs-btn"
                                                                value="{{ isset($subscription) ? 'Subscribe' : 'Proceed to payment'}}">
                                                        </form>
                                                </div>
                                            </div>
                                        </div><!-- .pricing -->
                                    </div><!-- .col -->
                                    @endforeach

                                    @endunless
                                </div>
                            </div>
                        </div>
                    </div><!-- .nk-block -->
                </div><!-- .components-preview -->
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).on('click', '#sc', function(e) {
        e.preventDefault();
        var cid = $(this).data('cid');
        var url = $(this).data('url');
        Swal.fire({
            icon: 'warning',
            title: 'Are you sure?',
            html: 'Do you really want to unsubscribe?',
            showCancelButton: true,
            confirmButtonColor: 'red',
            cancelButtonColor: 'green',
            cancelButtonText: `No`,
            confirmButtonText: `Yes`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    data: {cid: cid},
                    success: function(data) {
                        if(data.status){
                            location.reload()
                        }                       
                    },
                    error: function(error) {
                        Swal.fire('Something went wrong!!', '', 'error')
                    }
                });
            }
        })
    });

    $(document).on('click', '#sa', function(e) {
        e.preventDefault();
        var cid = $(this).data('cid');
        var url = $(this).data('url');
        Swal.fire({
            icon: 'info',
            title: 'Are you sure?',
            html: 'Do you really want to reactivate subscription?',
            showCancelButton: true,
            confirmButtonColor: 'green',
            cancelButtonColor: 'red',
            cancelButtonText: `No`,
            confirmButtonText: `Yes`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    data: {cid: cid},
                    success: function(data) {
                        if(data.status){
                            location.reload()
                        }                       
                    },
                    error: function(error) {
                        Swal.fire('Something went wrong!!', '', 'error')
                    }
                });
            }
        })
    });

    function getForm(that){
        Swal.fire({
            icon: 'info',
            title: 'Are you sure?',
            html: 'Do you really want to continue with this plan?',
            showCancelButton: true,
            confirmButtonColor: 'green',
            cancelButtonColor: 'red',
            cancelButtonText: `No`,
            confirmButtonText: `Yes`,
        }).then((result) => {
            if (result.isConfirmed) {
                $('.loader-overlay').removeClass('d-none')
                that.closest('.subsForm').submit()
            }
        })
    }
</script>
@endpush