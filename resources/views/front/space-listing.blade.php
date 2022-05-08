@extends('layouts.front')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/front/css/jquery-ui.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/css/jquery-ui.theme.min.css') }}">
@endpush
@section('content')
<section id="book_form">
    <div class="container">
        <div class="row book_row">
            {{-- <div class="book_text">
                <h5>Book your parking in advance to save time and money.</h5>
                <button type="button" class="btn btn-primary btn-default">New</button>
            </div> --}}
        </div>
        {{-- {{ dd($_GET) }} --}}
        
        <div class="row">
            <div class="col">
                <div id="book_dropdown">
                    <form id="search-space" action="{{ route('front.search-space') }}" autocomplete="off">
                        <div class="row">
                            <div class="col-md-6 text-right d-flex">
                                <p>Show:</p>
                                <select name="show" class="show-select">
                                    <option value="" selected hidden>10 items</option>
                                    <option value="10" @if(request()->show == 10) selected @endif>10 items</option>
                                    <option value="20" @if(request()->show == 20) selected @endif>20 items</option>
                                    <option value="30" @if(request()->show == 30) selected @endif>30 items</option>
                                </select>
                                <p>per page</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 loc_input">
                                <a href="javascript:void(0)" onclick="getLocation()"><img src="{{ asset('assets/front/img/my-location.png')}}"></a>
                                <label>Location</label>
                                <input class="form-control" type="text" name="address" id="address"  placeholder="WHERE DO YOU WANT TO PARK?" aria-label="Search" value="{{ $_GET['address'] ?? '' }}">
                                <input type="hidden" name="lng" id="lng" value="{{ $_GET['lng'] ?? '' }}">
                                <input type="hidden" name="lat" id="lat" value="{{ $_GET['lat'] ?? '' }}">
            
                            </div>
                            <div class="col-md-2 arivall">
                                <label>Arrival</label>
                                <input type='text' name="arrival" class="form-control" id="input_dpick" value="" placeholder="YYYY MM DD" />
                            </div>
                            <div class="col-md-2 depart">
                                <label>Departure</label>
                                <input type='text' name="departure" class="form-control" id='input_dpick2' value="" placeholder="YYYY MM DD" />           
            
                            </div>
                            {{-- {{ dd(isset($_GET['type']) && str_contains($_GET['type'], 'car')) }} --}}
                           

            
                            <div class="col filter-col">
                                <button type="button" class="btn btn-outline-primary filter-btn">
                                    <i class="fa fa-filter" aria-hidden="true"></i>
                                </button>
                                <div class="filter-wrap py-3 px-2" style="display: none;">
                                    <h2 class="text-center">Filter</h2>
                                    <div class="range-wrap">
                                        <h5>Budget</h5>
                                        <div id="slider" class="mt-5 mx-3"></div>
                                    </div>
                                    <div class="vehicle-wrap">
                                        <h5 class="mt-3">Vehicle</h5>
                                        <div class="park_cat_options park_cat_options2 row">
                                                                                        
                                            <div class="col-md-6 h-200 pe-1">
                                                <label for="park_img4" class="checker-area {{ isset($_GET['type']) && str_contains($_GET['type'], 'car') ? 'is-active' : '' }}">
                                                <input type="checkbox" name="vehicle[]" value="car" {{ isset($_GET['type']) && str_contains($_GET['type'], 'car') ? 'checked' : '' }} id="park_img4" class="input-hidden">
                                                <img src="{{ asset('categories/car.png') }}" alt="Car">
                                                </label>
                                            </div>
                                                                                        
                                            <div class="col-md-6 h-200 ps-1">
                                                <label for="park_img5" class="checker-area {{ isset($_GET['type']) && str_contains($_GET['type'], 'rv') ? 'is-active' : '' }}">
                                                <input type="checkbox" name="vehicle[]" value="rv" {{ isset($_GET['type']) && str_contains($_GET['type'], 'rv') ? 'checked' : '' }} id="park_img5" class="input-hidden">
                                                    <img src="{{ asset('categories/rv.png') }}" alt="RV">
                                                </label>
                                            </div>
                                                                                        
                                            <div class="col-md-6 h-200">
                                                <label for="park_img6" class="checker-area {{ isset($_GET['type']) && str_contains($_GET['type'], 'boat') ? 'is-active' : '' }}">
                                                <input type="checkbox" name="vehicle[]" value="boat" {{ isset($_GET['type']) && str_contains($_GET['type'], 'boat') ? 'checked' : '' }} id="park_img6" class="input-hidden">
                                                    <img src="{{ asset('categories/boat.png') }}" alt="Boat">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col search_btn">
                                            <button type="button" class="btn btn-primary filter-update" style="">Update</button>
                                        </div>
                                        {{-- <div class="col booking_btn text-right">
                                            <a href="http://127.0.0.1:8000/space-detail/1" class="btn btn-primary btn-default">Update</a>
                                        </div> --}}
                                    </div>
                                </div>
                            </div> 
                            <div class="col search_btn">
                                <button type="submit" class="btn btn-outline-primary search-btn">search</button>
                            </div>
            
                        </div>
                    </form>
                        <div class="row">
                            <div class="col-6">
                                @if ($spaces->total())
                                <h3 class="mt-4">{{ $spaces->total() }} Parkings</h3>
                                @else
                                <div class="my-5">
                                    <h3 class="my-5 text-center">No Parking Spaces Found</h3>
                                </div>
                                @endif
                                              
                            </div>                            
                            <div class="col-12">
                                <hr class="mb-5 mt-2">
                            </div>  
                        </div>
                    
                </div>
            </div>
        </div>
        
    

    </div>
</section>


<div class="booking_main">
    <div class="container">
      @foreach ($spaces as $key => $space)
      <div class="row">
            <div class="col-md-6 imgg">
                <div class="booking_img">
                    @isset($space->space_main_image)
                    <img class="img-thumbnail" src="{{ asset('uploads/parking/'.$space->space_main_image->image) }}">
                    @endisset
                </div>
            </div>
            <div class="col-md-6">
                <div class="booking_text">
                    <div class="booking_title">
                        <!-- <h2>The Two Side Parking (2 Hour Min)</h2> -->
                        <h2>{{ $space->title }}</h2>
                    </div>
                    <div class="booking_cat">
                        <h5>{{ $space->address }}</h5>
                    </div>
                    <div class="booking_miles">
                        <h6>{{ getDistance($space->latitude, $space->longitude) }} Miles</h6>
                    </div>
                    <div class="booking_desc">
                        <p>{{ htmlToText($space->description, 250) }}</p>
                        {{-- <p>{{$space->description}}</p> --}}
                    </div>
                    <div class="booking_inst">
                        <img src="{{ asset('assets/front/img/book.png')}}">
                        <span>Booking Instantly</span>
                    </div>
                    <div class="booking_price">
                        <h2>${{ $space->base_price }}</h2>
                        <span>{{  $space->price_type }}</span>
                    </div>

                    {{-- <div class="booking_rating')}}">
                        <span class="fa fa-star checked-starr"></span>
                        <span class="fa fa-star checked-starr"></span>
                        <span class="fa fa-star checked-starr"></span>
                        <span class="fa fa-star checked-starr"></span>
                        <span class="fa fa-star unchecked-starr"></span>
                    </div> --}}

                    <div class="booking_btn">
                        <a href="{{ route('front.space-detail', ['id' =>  encrypt($space->id) ]) }}" class="btn btn-primary btn-default">More Details</a>
                    </div>
                </div>

            </div>
        </div>          
      @endforeach
    </div>
</div>
<div class="book_pagination">
    <div class="container">
        <div class="row">
            <nav aria-label="...">
                {{ $spaces->appends($_GET)->links() }}
            </nav>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.map_key') }}&callback=initMap&libraries=places&v=weekly"
async defer></script>
<script src="{{ asset('assets/front/js/map-list.js') }}"></script>

<script>

    $(document).on("change", '.checker-area input:checkbox', function() {
        if($(this).parents(".checker-area").hasClass('is-active')){
            $(this).parents(".checker-area").removeClass('is-active')
        }else{ $(this).parents(".checker-area").addClass('is-active');
        }});    

    let arrival = "{{ request()->arrival ?? null }}"
    let departure = "{{ request()->departure ?? null}}"
    $('#input_dpick, #input_dpick2').datepicker({
        dateFormat: 'yy-mm-dd',
        onClose: function () {
            $("#input_dpick2").datepicker(
                "change", {  minDate: new Date($('#input_dpick').val())  });
            }
    });
    if(arrival){
        $('#input_dpick').datepicker('setDate', new Date(arrival.replace(/-/g, ',')));
    }
    if(departure){
        $('#input_dpick2').datepicker('setDate', new Date(departure.replace(/-/g, ',')));
    }

    // To empty longitute and latitute inputs
    $(document).on('click', 'input[type="radio"]', function(){
        alert($(this).val())
    })

    // To empty longitute and latitute inputs
    $(document).on('keyup', 'input[name="address"]', function(){
        if($(this).val() == ''){ $('#lng, #lat').val('') }
    })

    // To redirect when items per page changes
    $(document).on('change', 'select[name="show"]', function(){
        let show_per_page = $(this).val()
        var url = window.location.href
        var href = new URL(window.location.href);
        href.searchParams.set('show', show_per_page);
        window.location.href = href
    })

     // To redirect when items per page changes
     $(document).on('click', '.filter-update', function(){
        var min = $('input[name="price_min"]').val()
        var max = $('input[name="price_max"]').val()
        var url = window.location.href
        var href = new URL(window.location.href);
        var val = [];
        $('input[name="vehicle[]"]:checked').each(function(i){
          val[i] = $(this).val();
        });
        href.searchParams.set('type', val);
        href.searchParams.set('price_min', min);
        href.searchParams.set('price_max', max);
        window.location.href = href
    })




// range slider
function collision($div1, $div2) {
    var x1 = $div1.offset().left;
    var w1 = 40;
    var r1 = x1 + w1;
    var x2 = $div2.offset().left;
    var w2 = 40;
    var r2 = x2 + w2;
      
    if (r1 < x2 || x1 > r2) return false;
    return true;
    
  }
  
  $(function(){
     var href = new URL(window.location.href);
      slide_min = href.searchParams.get('price_min')
      slide_max = href.searchParams.get('price_max')
      
        $('#slider').slider({
    range: true,
    min: 1,
    max: 150,
    values: [1, 100],
    slide: function(event, ui) {
        $('.ui-slider-handle:eq(0) .price-range-min').html('$' + ui.values[0]);        
        $('.ui-slider-handle:eq(0) input[name="price_min"]').val(ui.values[0])
        $('.ui-slider-handle:eq(1) .price-range-max').html('$' + ui.values[1]);
        $('.ui-slider-handle:eq(1) input[name="price_max"]').val(ui.values[1])
        $('.price-range-both').html('<i>$' + ui.values[0] + ' - </i>$' + ui.values[1]);
        if(ui.values[0] == ui.values[1]) {
            $('.price-range-both i').css('display', 'none');
        } else {
            $('.price-range-both i').css('display', 'inline');
        }
        if(collision($('.price-range-min'), $('.price-range-max')) == true) {
            $('.price-range-min, .price-range-max').css('opacity', '0');
            $('.price-range-both').css('display', 'block');
        } else {
            $('.price-range-min, .price-range-max').css('opacity', '1');
            $('.price-range-both').css('display', 'none');
        }
    }
    });
    
    $('.ui-slider-handle:eq(0) .price-range-min').html('$' + slide_min);        
    $('.ui-slider-handle:eq(0) input[name="price_min"]').val(slide_min)
    $('.ui-slider-handle:eq(1) .price-range-max').html('$' + slide_max);
    $('.ui-slider-handle:eq(1) input[name="price_max"]').val(slide_max)
    $('.price-range-both').html('<i>$' + slide_min + ' - </i>$' + slide_max);
    slide_min = href.searchParams.get('price_min') ?? $('#slider').slider('values', 0)
    slide_max = href.searchParams.get('price_max') ?? $('#slider').slider('values', 1)
    $('.ui-slider-range').append('<span class="price-range-both value"><i>$' + slide_min + ' - </i>' + slide_max + '</span>');
    $('.ui-slider-handle:eq(0)').append('<span class="price-range-min value">$' + slide_min + '</span>');
    $('.ui-slider-handle:eq(0)').append('<input type="hidden" name="price_min" value='+ slide_min +' >');
    $('.ui-slider-handle:eq(1)').append('<span class="price-range-max value">$' + slide_max + '</span>');
    $('.ui-slider-handle:eq(1)').append('<input type="hidden" name="price_max" value='+ slide_max +' >');
    $(".filter-btn").click(function() {
    $(".filter-wrap").toggle();
    });
    })

</script>
@endpush