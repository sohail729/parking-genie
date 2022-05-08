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
          <h2 style="color: #0060AD;">Create <span style="color: #222222;">Account</span></h2>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <form id="signupForm" action="{{ route('front.signup.store') }}" method="post"
              class="stripe_card">

              <!-- main alert @s -->
              @include('front.partials.alerts')
              <!-- main alert @e -->

              <!-- progressbar -->
              {{-- @if ( in_array($type,['super','commercial']) ) --}}
              @if ( in_array($type,$plantypes) && $type!='free' )

              <ul id="progressbar">
                <li class="active" id="personal"><strong>Personal Detail</strong></li>
                <li id="payment"><strong>Add Payment Method</strong></li>
              </ul>
              @endif
              @csrf
              <!-- progressbar -->

              <!-- <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
              </div> 
              <br>  -->
              <!-- fieldsets -->
              <fieldset>
                <div class="form-card">

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="">First Name <span class="text-danger">*</span></label>
                        <input type="text" required name="fname" class="form-control" placeholder="John"
                          value="{{ old('fname') }}">
                        {!! $errors->first('fname', '<label class="signup-error">:message</label>') !!}

                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="">Last Name <span class="text-danger">*</span></label>
                        <input type="text" required name="lname" class="form-control" placeholder="Doe"
                          value="{{ old('lname') }}">
                        {!! $errors->first('lname', '<label class="signup-error">:message</label>') !!}

                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="">Date of birth <span class="text-danger">*</span></label>
                        <input type="text" required name="date_of_birth" class="form-control datepicker"
                           value="{{ old('date_of_birth') }}">
                        {!! $errors->first('address', '<label class="signup-error">:message</label>') !!}
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="">Email <span class="text-danger">*</span></label>
                        <input type="email" required name="email" class="form-control" placeholder="john@email.com" value="{{
                          old('email') }}" >
                        {!! $errors->first('email', '<label class="signup-error">:message</label>') !!}
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group input-group mb-3 toggle-password">
                        <label for="" class="w-100">Password <span class="text-danger">*</span></label>
                        <input type="password" required name="password" class="form-control height-50 cus-input-bor" id="password-field" placeholder="Enter password"
                          aria-describedby="basic-addon2" required placeholder="Enter password">
                        <div class="input-group-append">
                          <span class="input-group-text" id="basic-addon1">
                            <a href="javascript:void(0)" class="toggle text-dark"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                         </span>
                        </div>
                        {!! $errors->first('password', '<label class="signup-error">:message</label>') !!}
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group input-group mb-3 toggle-password">
                        <label for="" class="w-100">Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" required name="password_confirmation" class="form-control height-50 cus-input-bor" id="password-field2" placeholder="Enter password"
                          aria-describedby="basic-addon2" required placeholder="Enter password">
                        <div class="input-group-append">
                          <span class="input-group-text" id="basic-addon2">
                            <a href="javascript:void(0)" class="toggle text-dark"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                         </span>
                        </div>
                        {!! $errors->first('password', '<label class="signup-error">:message</label>') !!}
                      </div>
                    </div>
                  </div> 
                  {{-- @if ( in_array($type,['super','commercial']) ) --}}

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="">Country <span class="text-danger">*</span></label>
                        <select id="country" required name="country" class="form-control">
                          <option value="" selected hidden>- Select -</option>
                          @foreach ($countries as $key => $country )
                          <option value="{{ $country}}" {{
                            old('country') ==  $country ? 'selected' : ''}}>{{ $country}}</option>
                          @endforeach
                        </select>
                        {!! $errors->first('country', '<label class="signup-error">:message</label>') !!}
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="">City/Municipality <span class="text-danger">*</span></label>
                        <input type="text" required name="municipality" class="form-control" placeholder="Johannesburg" value="{{
                          old('municipality') }}">
                        {!! $errors->first('municipality', '<label class="signup-error">:message</label>') !!}
                      </div>
                    </div>

                  </div>
                  <div class="row">
                    <div class="col-sm-8">
                      <div class="form-group">
                        <label for="">Address <span class="text-danger">*</span></label>
                        <input type="text" required name="address" class="form-control" placeholder="95 Victoria St, London SW1H 0HW, UK" value="{{ old('address')
                      }}">
                        {!! $errors->first('address', '<label class="signup-error">:message</label>') !!}
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="">Postal/Zip Code </label>
                        <input type="text" name="postal" class="form-control" value="{{ old('postal')
                      }}">
                        {!! $errors->first('postal', '<label class="signup-error">:message</label>') !!}
                      </div>
                    </div>
                  </div>

                  @if ( in_array($type,$plantypes) && $type!='free' )

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group"> <label for="">Plan <span class="text-danger">*</span></label> 
                  <select id="plan"  name='plan' required >
                    <option value="" selected hidden>- Select -</option> 
                    @foreach ($plan as $key => $pln )
                    <option value="{{ $pln->stripe_prod_id}}">
                      {{  $pln->amount != 0 ? '$'.$pln->amount. '/'.$pln->period : "Free"}}</option>
                    @endforeach 

                  </select></div>
                    </div>
                  </div>
                  @endif

                </div>
                {{-- @if ( in_array($type,['super','commercial']) ) --}}
              @if ( in_array($type,$plantypes) && $type!='free' )
                <input type="button" name="next" class="next action-button" value="Next" />

              </fieldset>
              <fieldset>
                <div class="form-card payment">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="">Card Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="card_name" value="{{ old('card_name')
                      }}" required placeholder="Full Name">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="">Card Number<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="number" value="{{ old('number')
                      }}" required
                          placeholder="xxxx xxxx xxxx xxxx">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="">Expire Date<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="exp" value="{{ old('exp')
                      }}" required placeholder="MM/YY">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="">CSV<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="cvc"  value="{{ old('cvc')
                      }}" required placeholder="XXX">
                      </div>
                    </div>
                  </div>
                  <div class="card-wrapper"></div>
                </div>

                <input type="submit" class="action-button" value="Submit" />

              </fieldset>
              @else
              <input type="submit" class="action-button" value="Submit" />

              @endif
             
              @if (isset($plan) && !empty($plan))
              {{-- <input type="hidden" name="plan" value="{{ $plan }}" /> --}}
              
              <input type="hidden" name="ptype" value="{{ $type }}" />
              <input type="hidden" name="type" value="host" />
              @else
              <input type="hidden" name="ptype" value="{{ $type }}" />
              <input type="hidden" name="type" value="user" />

              @endif


            </form>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
@push('scripts')
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
<script src="{{ asset('assets/front/js/card.js') }}"></script>
<script>
  @if(Session::has('alert-danger-modal'))
    $(document).ready(function () {
        jQuery.noConflict();
        $('#loginModal').modal('show');
    });
    @endif

    $(function () {
           $(".datepicker").datepicker({
            dateFormat: "d M, yy",
            changeMonth: true,
            changeYear: true,
            yearRange: '1930:+0',
          });
    });

    $(document).ready(function () {
        //Signup Form Validations
        $("#signupForm").validate({
            errorClass: "signup-error",
            rules: {
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "{{ route('front.check-email') }}",
                        type: "POST",
                    }  
                },
                password: {
                    required: true,
                    strong_password:true
                },
                password_confirmation: {
                    required: true,
                    equalTo: 'input[name="password"]'
                }
            },
            messages:{
                email: {
                    remote: "The email has already been taken."
                }
            },
            submitHandler:function(form){
              form.submit();
            }
        });
    });

</script>

<script>
if ($('.stripe_card .payment').length > 0) {
	var card = new Card({
		form: '.stripe_card',
		container: '.card-wrapper',

		formSelectors: {
			numberInput: 'input[name="number"]',
			expiryInput: 'input[name="exp"]',
			cvcInput: 'input[name="cvc"]',
			nameInput: 'input[name="card_name"]'
		},

		width: 200,
		formatting: true,
		messages: {
			validDate: 'valid\ndate',
			monthYear: 'mm/yyyy',
		},

		placeholders: {
			number: '**** **** **** ****',
			name: 'Full Name',
			expiry: '**/**',
			cvc: '***'
		},

		masks: {
			cardNumber: '*'
		},

		debug: false
	});
}

$.validator.addMethod("strong_password", function (value, element) {
	let password = value;
	if (!(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%&])(.{8,20}$)/.test(password))) {
		return false;
	}
	return true;
}, function (value, element) {
	let password = $(element).val();
	if (!(/^(.{8,20}$)/.test(password))) {
		return 'Password must be between 8 to 20 characters long.';
	} else if (!(/^(?=.*[A-Z])/.test(password))) {
		return 'Password must contain at least one uppercase.';
	} else if (!(/^(?=.*[a-z])/.test(password))) {
		return 'Password must contain at least one lowercase.';
	} else if (!(/^(?=.*[0-9])/.test(password))) {
		return 'Password must contain at least one digit.';
	} else if (!(/^(?=.*[@#$%&])/.test(password))) {
		return "Password must contain special characters from @#$%&.";
	}
	return false;
});
</script>
@endpush