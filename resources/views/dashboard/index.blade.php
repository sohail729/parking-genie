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
                            <h3 class="nk-block-title page-title">Dashboard</h3>
                            <div class="nk-block-des text-soft">
                            </div>

                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">

                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->

                @include('dashboard.partials.alerts')


                <div class="nk-block">
                    <div class="row g-gs">

                        @admin()
                        <div class="col-sm-6 col-lg-3 col-xxl-3">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-2">
                                        <div class="card-title">
                                            <h6 class="title">Total Registerd Users</h6>
                                        </div>
                                    </div>
                                    <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                        <div class="nk-sale-data">
                                            <span class="amount">{{ $usersCount }}</span>

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
                                            <h6 class="title">Total Registerd Hosts</h6>
                                        </div>
                                    </div>
                                    <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                        <div class="nk-sale-data">
                                            <span class="amount">{{ $hostsCount }}</span>

                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->
                        @endadmin
                        @host
                        @if (isset(auth()->user()->subscription) && auth()->user()->stripe_status == 'pending')
                        <div class="col-md-12 alert alert-info" role="alert">
                            <h4 class="alert-heading">Welcome {{ auth()->user()->fname }}!</h4>
                            <p>To start listing your parking spaces at Parking Genie, you need to setup your stripe account for secure transactions. <a href="{{ auth()->user()->stripe_connect_link }}" target="_blank">Follow this link to setup your account!</a> or <a href="{{ route('front.space.connect-refresh') }}">Refresh the link</a></p>
                          </div>
                          @else
                          <div class="col-sm-6 col-lg-3 col-xxl-3">
                              <div class="card card-bordered">
                                  <div class="card-inner">
                                      <div class="card-title-group align-start mb-2">
                                          <div class="card-title">
                                              <h6 class="title">Total Transaction Amount</h6>
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
                        
                        @endif
                       
                        @endhost

                        @user
                        <div class="col-sm-6 col-lg-3 col-xxl-3">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-2">
                                        <div class="card-title">
                                            <h6 class="title">Total Transaction Amount</h6>
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

                        @enduser                       
                    </div><!-- .row -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
<!-- content @e -->
@endsection