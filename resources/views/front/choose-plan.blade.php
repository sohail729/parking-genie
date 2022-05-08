@extends('layouts.front')

@push('styles')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.min.css" />
@endpush
@section('content')
<section class="section_inner signup_section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="heading">
          <h2 style="color: #222222;">Select <span style="color: #0060AD;">Account</span></h2>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="text-center px-0 pt-4 pb-0 mt-3 mb-3">
            <div class="row g-gs">
              @foreach ($plans as $key => $plan)

              <div class="col-sm-12 col-lg-4 ">
                <div class="card0 card-bordered pricing text-center">
                  <div class="ani pricing-body">
                    <div class="pricing-media">
                      @foreach ($plan as $keySub => $package) 
                   <?php if($keySub==1) break ?> 
                   <a href="javascript:void(0)" data-t="{{ $package->type }}" data-r="{{ route('front.signup.show') }}" id="select-plan">
                      @if( $package->image !=null)
                      <img src="{{ asset('plans/'.$package->image) }}" alt="image" class="image1 img-thumbnail" />

                      @else
                      <img src="{{ asset('categories/plan'.$loop->parent->iteration.'.webp') }}" alt="image" class="image1 img-thumbnail" />
                   @endif
                    </a>
                      @endforeach
                    </div>
                    <div class="pricing-title w-220px mx-auto">
                      <h5 class="title">{{ $plan[0]->title }}</h5>
                      <small>({{ $plan[0]->sub }})</small><br>
                      @foreach ($plan as $key => $package)                     
                      @if ($loop->iteration > 1) <span style="cursor:auto" class="color-blue font-weight-bold">or</span> @endif                     
                      {{-- <a href="javascript:void(0)" data-p="{{ $package->stripe_prod_id }}"  data-t="{{ $package->type }}" data-r="{{ route('front.signup.show') }}" id="select-plan"> --}}
                        <a href="javascript:void(0)" >
                        <span class="sub-text color-blue font-weight-bold">{{ $package->amount != 0 ? '$'.$package->amount. '/' : "Free" }}{{ $package->period }}</span>
                      </a>
                      @endforeach
                    </div>
                  </div>
                </div><!-- .pricing -->
              </div><!-- .col -->
              @endforeach
                                
            </div>
            <div class="row">
              <div class="col-12">
                <span>Learn more about </span><a class="color-blue font-weight-bold" href="{{ route('front.home').'#ask-the-genie' }}">Hosting on Parking Genie.</a>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <hr class="d-inline-block w-130"> OR <hr class="d-inline-block w-130">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 offset-md-3">
              <div class="user-signup">
                <a href="{{ route('front.signup.show') }}"><img src="{{ asset('assets/front/img/signup-user.webp') }}" alt="image" class="image1 img-thumbnail d-block" /></a>
                <span>Register as a  </span><a class="color-blue font-weight-bold" href="{{ route('front.signup.show') }}">Space User</a>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection