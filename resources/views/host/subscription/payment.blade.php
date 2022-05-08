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
                                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Payment
                                            Information</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div><!-- .nk-block-head -->

                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="row g-gs">
                                        <div class="col-md-12">
                                    <form id="bookingForm" action="{{ route('host.subscription.new') }}" method="post" autocomplete="off"
                                    class="stripe_card">
                                    @csrf
                                   
                                        <div class="form-card">
                                          <div class="row">
                                            <div class="col-sm-12">
                                              <div class="form-group">
                                                <label for="">Card Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="card_name" value="{{ old('card_name')
                                                  }}" required placeholder="Full Name">
                                              </div>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="col-sm-12">
                                              <div class="form-group">
                                                <label for="">Card Number <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="number" value="{{ old('number')
                                                  }}" required placeholder="xxxx xxxx xxxx xxxx">
                                              </div>
                                            </div>
                                          </div>
                          
                                          <div class="row">
                                            <div class="col-sm-6">
                                              <div class="form-group">
                                                <label for="">Expire Date <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="exp" value="{{ old('exp')
                                                  }}" required placeholder="MM/YY">
                                              </div>
                                            </div>
                                            <div class="col-sm-6">
                                              <div class="form-group">
                                                <label for="">CSV <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="cvc" value="{{ old('cvc')
                                                  }}" required placeholder="XXX">
                                              </div>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="col-sm-12">
                                              <div class="form-group float-right mt-2">
                                                <input type="hidden" name="pid" value="{{ $plan->stripe_prod_id }}">
                                                <input type="submit" class="btn btn-sm btn-success" value="Subscribe">
                                              </div>
                                            </div>
                                          </div>
                                          <div class="card-wrapper"></div>
                                        </div>                                 
                                  </form>
                                </div>
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

<script src="{{ asset('assets/front/js/card.js') }}"></script>
<script>
   if($('.stripe_card').length){
var card = new Card({
  // a selector or DOM element for the form where users will
  // be entering their information
  form: '.stripe_card', // *required*
  // a selector or DOM element for the container
  // where you want the card to appear
  container: '.card-wrapper', // *required*

  formSelectors: {
      numberInput: 'input[name="number"]', // optional â€” default input[name="number"]
      expiryInput: 'input[name="exp"]', // optional â€” default input[name="expiry"]
      cvcInput: 'input[name="cvc"]', // optional â€” default input[name="cvc"]
      nameInput: 'input[name="card_name"]' // optional - defaults input[name="name"]
  },

  width: 200, // optional â€” default 350px
  formatting: true, // optional - default true

  // Strings for translation - optional
  messages: {
      validDate: 'valid\ndate', // optional - default 'valid\nthru'
      monthYear: 'mm/yyyy', // optional - default 'month/year'
  },

  // Default placeholders for rendered fields - optional
  placeholders: {
      number: '**** **** **** ****',
      name: 'Full Name',
      expiry: '**/**',
      cvc: '***'
  },

  masks: {
      cardNumber: '*' // optional - mask card number
  },

  // if true, will log helpful messages for setting up Card
  debug: false // optional - default false
});
}

</script>
@endpush