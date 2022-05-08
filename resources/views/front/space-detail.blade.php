@extends('layouts.front')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/front/css/jquery-ui.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/css/jquery-ui.theme.min.css') }}">
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
<link rel="stylesheet" href="{{ asset('assets/front/css/select2.css') }}">
<style>
  .gallery.container {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-template-rows: masonry;
  }
</style>
@endpush

@section('content')

<section class="booking_section space-detail">
  <div class="container">
    <div class="row">
      <div class="col-md-5">
        <div class="booking_form">
          <h2>{{ $space->title }}</h2>
          
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <strong>Space Type:</strong>
                <p>{{ $space->space_type->title }}</p>
                <hr>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <strong>Vehicle Type:</strong>
                <p>{{ $space->vehicle_type->title }}</p>
                <hr>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <strong>Location:</strong>
                <p>{{ $space->address }}</p>
                <hr>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <strong>Price:</strong>
                <p>$<span class="sp-price">{{ $space->base_price }}</span>/{{ $space->price_type }}</p>
                <hr>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <strong>Session:</strong>
                <p>{{ getMonth($space->session_start) }} - {{ getMonth($space->session_end) }}</p>
                <hr>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <strong>Time Slots:</strong>
                <p>{{ getTime($space->earliest_reservation) }} - {{ getTime($space->lastest_reservation) }}</p>
                <hr>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <strong>Will The Host Greet User At The Location?</strong>
                <p>{{ $space->will_host_greet }}</p>
                <hr>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <strong>Are there surveillance cameras present?</strong>
                <p>{{ $space->has_surveillance }}</p>
                <hr>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="col-md-7">
        <div class="">

            <div class="product-gallery mr-xl-1 mr-xxl-5">
              <div class="slider-for" id="sliderFor">
                  @foreach ($space->spaceImages as $key => $image)
                      <div class="slider-item rounded">
                          <img src="{{ asset('uploads/parking/'. $image->image) }}" class="w-100" alt="">
                      </div>                                            
                  @endforeach
              </div>
              <!-- .slider-init -->
              <div class="slider-nav" id="sliderNav" >
      
                  @foreach ($space->spaceImages as $key => $image)
                  <div class="slider-item">
                      <div class="thumb">
                          <img src="{{ asset('uploads/parking/'. $image->image) }}" alt="">
                      </div>
                  </div>                                          
              @endforeach
              </div>
              <!-- .slider-nav -->
          </div>
        </div>
      </div>
      <div class="booking_form">
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            <strong>Description:</strong>
            <p>{{ $space->description }}</p>
            <hr>
          </div>
        </div>
      </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
          <!-- main alert @s -->
          @include('front.partials.alerts')
          <!-- main alert @e -->
        @user()
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <h2>Booking Details:</h2>
            </div>
          </div>
        </div>
        <form id="bookingForm" action="{{ route('user.space.store') }}" method="post" autocomplete="off"
          class="stripe_card">
          @csrf
          <div class="row">
            @if ($space->price_type == 'hourly')
            <div class="col-md-3">
              <div class="form-group">
                <label for="">Select Date <span class="text-danger">*</span></label>
                <input type="text" id="selected_date" name="selected_date" required placeholder="MM/DD/YYYY" class="price date form-control">
              </div>
            </div>
            <div class="col-md-9">
              <div class="form-group">
                <label for="">Available Time Slots<span class="text-danger">*</span></label>
                <select id="available_slots" name="available_slots[]" class="price form-control" data-placeholder="Select slot(s)" multiple>
                </select>
              </div>
            </div>
            @elseif ($space->price_type == 'daily')
            <div class="col-md-3">
              <div class="form-group">
                <label for="">From <span class="text-danger">*</span></label>
                <input type="text" id="from_date" name="from_date" required placeholder="MM/DD/YYYY" class="price date form-control">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="">To <span class="text-danger">*</span></label>
                <input type="text" id="to_date" name="to_date" required placeholder="MM/DD/YYYY" class="price date form-control">
              </div>
            </div>
            @elseif ($space->price_type == 'weekly')
            <div class="col-md-3">
              <div class="form-group">
                <label for="">From <span class="text-danger">*</span></label>
                <input type="text" id="from_date" name="from_date" value="{{ old('from_date')}}" required placeholder="MM/DD/YYYY" class="price date form-control">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="">Number of Weeks ? <span class="text-danger">*</span></label>
                <input type="number" id="no_of_weeks" name="no_of_weeks" min="1" max="52" value="{{ old('no_of_weeks')}}" required placeholder="E.g 3" class="price form-control">
              </div>
            </div>
            @endif
            <div class="col-md-12">
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
                      <input type="hidden" name="space_id" value="{{ $space->id }}">
                    </div>
                  </div>
                </div>
                <div class="card-wrapper"></div>
              </div>
            </div>
          </div>
          <button type="text" class="btn btn_booking">Pay Now ($<span class="sp-btn-price">0</span>)</button>
        </form>
        @else
        <a href="{{ route('front.signup.show', ['ref' => 'spdetail']) }}" class="btn btn-primary d-inline-flex align-items-center">Signup to Book this
          space!</a>
          @enduser
        </div>
      </div>
      
      
      
  </div>
</section>

@endsection
@push('scripts')

<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="{{ asset('assets/front/js/card.js') }}"></script>
<script>
  var cal = []
  let myObj = {};
  $(document).on('change', '.price', function(e) {
  let name = $(this).attr('id')
  let value = $(this).val()
  cal[name] = value
  myObj = Object.assign({}, cal); 
  $('.btn_booking').html('Calculating...')
    $.ajax({url:" {{ route('user.space.calculate') }}",data: {d: JSON.stringify(myObj), s: "{{ $space->id  }}"},
        success: function(data) {
          if(data.status){ 
            $('.btn_booking').html('Pay Now ($<span class="sp-btn-price">0</span>)')
            $('.sp-btn-price').html(data.amount)
          }
        },
        error: function(error) {
            console.log(error)
        }
    });
  })
  $(document).ready(function () {
       $('#available_slots').select2({
            closeOnSelect: false,
            placeholder: function () {
                $(this).data('placeholder');
            },
        });

        //Signup Form Validations
        $("#bookingForm").validate({
            errorClass: "login-error",
            submitHandler:function(form){
              form.submit();
            }
        });
    });


  $(document).on('change', 'input[name="selected_date"]', function(e) {
        e.preventDefault();
        var date = $(this).val();
        $('select[name="available_slots[]"]').html("");
        $.ajax({
            url:" {{ route('user.space.get-time-slots') }}",
            data: { d: date, s: "{{ $space->id  }}" },   
            success: function(data) {
              if(data.status){ 
                data.available_slots.forEach(function(item) {
                  let option = $('<option />');
                  option.attr('value', item.key).text(item.slot);
                  $('select[name="available_slots[]"]').append(option);
                });
              }
            },
            error: function(error) {
                console.log(error)
                alert('Something went wrong!\nPlease check browser console.')
            }
        });
    });

    var array =  @json($blockedDates);
    var showMonths =  @json(range($space->session_start - 1, $space->session_end -1));

     $('.date').datepicker({
      beforeShowDay: function(date){
            var month = date.getMonth();
            if ($.inArray(month, showMonths) == -1) {
                return [false];
            }
            var string = $.datepicker.formatDate('yy-mm-dd', date);
            return [ array.indexOf(string) == -1 ]
        }
     });

      $(document).ready(function() {

      $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav'
      });
      $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        centerMode: true,
        focusOnSelect: true,
        centerPadding: '0',
      });

      });



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