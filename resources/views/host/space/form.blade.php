@extends('layouts.dashboard')
@push('styles')
<style>
   .tab {
       display: none;
   }
</style>
@endpush
@section('content')
<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview mx-auto">
                    <div class="nk-block-head nk-block-head-lg wide-sm">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title fw-normal">Space</h2>
                            <nav>
                                <ul class="breadcrumb">
                                 <li class="breadcrumb-item"><a href="{{ route('host.dashboard.index') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ getPageType() != 'GET'? 'Edit' : 'Add'}} Space</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div><!-- .nk-block-head -->

                    <!-- main alert @s -->
                    @include('dashboard.partials.alerts')
                    <!-- main alert @e -->

                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered">
                            <div class="card-inner">
                            <section class="header">
                    <div class="container">
                       <div class="row">
                          <div class="col-md-3">
                             <!-- Tabs nav -->
                             <div class="nav flex-column nav-pills nav-pills-custom custom-tabs" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <button class="openBtMob" type="button">
                                   <svg fill="#000000" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" width="24px" height="24px">
                                      <path d="M 2 5 L 2 7 L 22 7 L 22 5 L 2 5 z M 2 11 L 2 13 L 22 13 L 22 11 L 2 11 z M 2 17 L 2 19 L 22 19 L 22 17 L 2 17 z"/>
                                   </svg>
                                </button>
                                <button class="btn_mobileMenu closeBtMob" type="button">
                                   <svg fill="#000000" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 50 50" width="50px" height="50px">
                                      <path d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z"/>
                                   </svg>
                                </button>
                                <h3>Parking Details</h3>
                                <a class="nav-link active" id="v-pills-parking-tab" data-toggle="pill" href="#v-pills-parking" role="tab" aria-controls="v-pills-parking" aria-selected="true">
                                <span class="span-text">Location</span></a>
                                <a class="nav-link" id="v-pills-Desc-tab" data-toggle="pill" href="#v-pills-Desc" role="tab" aria-controls="v-pills-Desc" aria-selected="false">
                                <span class="span-text">Title & Description</span></a>
                                <a class="nav-link" id="v-pills-park_cat-tab" data-toggle="pill" href="#v-pills-park_cat" role="tab" aria-controls="v-pills-park_cat" aria-selected="false">
                                <span class="span-text">Parking category</span></a>
                                <a class="nav-link" id="v-pills-instructions-tab" data-toggle="pill" href="#v-pills-instructions" role="tab" aria-controls="v-pills-instructions" aria-selected="false">
                                <span class="span-text">Instruction</span></a>
                                <a class="nav-link" id="v-pills-reservation-tab" data-toggle="pill" href="#v-pills-reservation" role="tab" aria-controls="v-pills-reservation" aria-selected="false">
                                <span class="span-text">Reservation</span></a>
                                <a class="nav-link" id="v-pills-photo-tab" data-toggle="pill" href="#v-pills-photo" role="tab" aria-controls="v-pills-photo" aria-selected="false">
                                <span class="span-text">Photos & Details</span></a>
                                <a class="nav-link" id="v-pills-pricing-tab" data-toggle="pill" href="#v-pills-pricing" role="tab" aria-controls="v-pills-pricing" aria-selected="false">
                                <span class="span-text">Pricing</span></a>
                                <a class="nav-link" id="v-pills-availability-tab" data-toggle="pill" href="#v-pills-availability" role="tab" aria-controls="v-pills-availability" aria-selected="false">
                                <span class="span-text">Availability</span></a> 
                                <a class="nav-link" id="v-pills-calendar-tab" data-toggle="pill" href="#v-pills-calendar" role="tab" aria-controls="v-pills-calendar" aria-selected="false">
                                <span class="span-text">Calender</span></a>
                             </div>
                          </div>
                          <div class="col-md-9">
                             <!-- Tabs content -->
                             <form action="{{ isset($space) ? route('host.space.update', ['id' => $space->id]) : route('host.space.store')  }}" method="post" enctype="multipart/form-data" id="register-space">
                                 @csrf                                 
                             
                             <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane0 fade0 tab bg-white active" id="v-pills-parking" role="tabpanel" aria-labelledby="v-pills-parking-tab">
                                   <h2 class="mb-4">Hey {{ ucwords(auth()->user()->fname) }}, Let's Get Started Listing<br> Your Space</h2>
                                   <p class="text-muted mb-2">Where is your space located?</p>
                                   <a class="btn btn-primary text-white" id="park_btn" onClick="getLocation()">Use my Current Location</a>
                                   <p class="orr">or</p>
                                   <div class="form-group">
                                      <input type="text" name="address" id="address" class="controls form-control" 
                                      value="{{ old('address', $space->address ?? '') }}" placeholder="Enter Address" required/>
                                       <input type="hidden" name="longitude" id="longval" value="{{ old('longitude', $space->longitude ?? '') }}"/>
                                       <input type="hidden" name="latitude" id="latval" value="{{ old('latitude', $space->latitude ?? '') }}"/>
                                   </div>
                                   <div class="loc_map">
                                      <div id="googleMap" class="z-depth-1-half map-container" style="height: 300px">
                                      </div>
                                   </div>
                                </div>
                                <div class="tab-pane0 fade0 tab bg-white" id="v-pills-Desc" role="tabpanel" aria-labelledby="v-pills-Desc-tab">
                                   <h2 class="mb-4">Add A Title & Description</h2>
                                   <div class="dec-title">
                                    <div class="form-group">
                                      <label class="text-muted mb-2">Title <span class="text-danger">*</span></label>
                                      <input type="text" name="title" class="form-control" id="park_input" value="{{ old('title', $space->title ?? '') }}" required placeholder="Enter Title">
                                    </div>
                                   </div>
                                   <div class="desc-textarea"> 
                                    <div class="form-group">
                                      <label class="text-muted mb-2">Write a Description <span class="text-danger">*</span>
                                      </label>
                                      <textarea rows="6" name="description" required  id="park_textarea" class="park_textarea form-control" placeholder="Enter Address">{{ old('description', $space->description ?? '') }}</textarea>
                                   </div>
                                   </div>
                                </div>
                                <div class="tab-pane0 fade0 tab bg-white" id="v-pills-park_cat" role="tabpanel" aria-labelledby="v-pills-park_cat-tab">
                                   <h2 class="mb-4">What Kind Of Space Are You Listing?</h2>
                                   <div class="dropdown_park">                                      
                                      <select required name="category[space]" id="" class="form-select col-md-6">
                                         <option value="" selected hidden>- Select Space Type -</option>
                                         @foreach ($space_cats as  $value )                                              
                                           <option value="{{ $value->id }}" @if (isset($space) && $space->space_type->id == $value->id)  selected  @endif> - {{ $value->title }}</option>
                                         @endforeach
                                      </select>
                                   </div>
                                   
                                   <h2 class="my-4">Select Your Vehicle Or Vessel?</h2>
                                   <div class="dropdown_park">                                      
                                    <select required name="category[vehicle]" id="" class="form-select col-md-6">
                                       <option value="" selected hidden>- Select Vehicle Or Vessel Type -</option>
                                       @foreach ($vehicle_cats as $value )                                           
                                        <option value="{{ $value->id }}" @if (isset($space) && $space->vehicle_type->id == $value->id)  selected  @endif> - {{ $value->title }}</option>
                                       @endforeach
                                    </select>
                                 </div>                             
                                </div>
                                <div class="tab-pane0 fade0 tab bg-white" id="v-pills-instructions" role="tabpanel" aria-labelledby="v-pills-instructions">
                                   <h2 class="mb-4">Please Read Carefully Before Going Forward?
                                   </h2>
                                   <div class="row">
                                      <div class="col-md-6">
                                         <h5>Step 01</h5>
                                         <h3>Lorem Ipsum</h3>
                                         <p class="text-muted mb-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                      </div>
                                      <div class="col-md-6">
                                         <h5>Step 02</h5>
                                         <h3>Lorem Ipsum</h3>
                                         <p class="text-muted mb-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                      </div>
                                   </div>
                                   <div class="row">
                                      <div class="col-md-6">
                                         <h5>Step 03</h5>
                                         <h3>Lorem Ipsum</h3>
                                         <p class="text-muted mb-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                      </div>
                                      <div class="col-md-6">
                                         <h5>Step 03</h5>
                                         <h3>Lorem Ipsum</h3>
                                         <p class="text-muted mb-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                      </div>
                                   </div>
                                </div>
                                <div class="tab-pane0 fade0 tab bg-white" id="v-pills-reservation" role="tabpanel" aria-labelledby="v-pills-reservation">
                                   <h2 class="mb-4">Will The Host Greet User At The Location?</h2>
                                   <div class="form-check" id="greeting_form">
                                      <label class="radio checker-area  @if(old('will_host_greet', $space->will_host_greet ?? '') == 'no') is-active @endif " for="no" >
                                      <input type="radio" name="will_host_greet" @if(old('will_host_greet', $space->will_host_greet ?? '') == 'no') checked @endif required value="no" id="no" required >I will not be home
                                      </label>
                                      <label class="radio checker-area  @if(old('will_host_greet', $space->will_host_greet ?? '') == 'yes') is-active @endif " for="yes" >
                                      <input type="radio" name="will_host_greet" @if(old('will_host_greet', $space->will_host_greet ?? '') == 'yes') checked @endif value="yes" id="yes" required />I will be home
                                      </label>
                                      <label class="radio checker-area  @if(old('will_host_greet', $space->will_host_greet ?? '') == 'other') is-active @endif " for="other" >
                                      <input type="radio" name="will_host_greet" @if(old('will_host_greet', $space->will_host_greet ?? '') == 'other') checked @endif value="other" id="other" required >Other
                                      </label>
                                   </div>
                                   
                                   <h4 class="mb-4">Are there surveillance cameras present?</h4>
                                   <div class="form-check" id="camera_form">
                                      <label class="radio checker-area @if(old('has_surveillance',  $space->has_surveillance ?? '') == 'yes') is-active @endif">
                                      <input type="radio" name="has_surveillance" required value="yes" @if(old('has_surveillance',  $space->has_surveillance ?? '') == 'yes') checked @endif  required  />I have security cameras
                                      </label>
                                      <label class="radio checker-area @if(old('has_surveillance',  $space->has_surveillance ?? '') == 'no') is-active @endif ">
                                      <input type="radio" name="has_surveillance" value="no" @if(old('has_surveillance',  $space->has_surveillance ?? '') == 'no') checked @endif required />I don't have security cameras
                                      </label>
                                   </div>
                                </div>
                                <div class="tab-pane0 fade0 tab bg-white" id="v-pills-photo" role="tabpanel" aria-labelledby="v-pills-photo">
                                   <h2 class="mb-4">Add Photos To Your Listing!</h2>
                                   <p class="text-muted mb-2">Take photos using a phone or camera. Upload at least one photo to publish your listing and<br>
                                      drag to reorder however you like. You can always add or edit your photos later.
                                   <div class="photos_listing">
                                      {{-- <div class="photo_input"> --}}
                                         <label class="cus-file-label">
                                          <label class="cus-file-label-inner">
                                             Upload Photos
                                             <input type="file" class="cus-file {{ isset($space->spaceImages) &&  $space->spaceImages->isNotEmpty() ? 'no-validate' : ''}}" id="image1" name="images[]" multiple/> 
                                             <!-- <button class="btn-file">Upload Photos</button> -->
                                          </label>
                                         </label>
                                      {{-- </div> --}}
                                      <br/>
                                      <div class="row" id="frames1">
                                       @if (isset($space->spaceImages))
                                           @foreach ($space->spaceImages as $key => $item )
                                           <div class="col-md-3 mb-3">
                                             <a href="javascript:void(0)" class="remove-image" data-i="{{ $item->id }}" data-s="{{ $item->parking_id }}">
                                                 <span> <i class="fas fa-times"></i></span>
                                             </a>
                                              <div class="space-image">
                                                 <img width="100px" class="img-responsive" src="{{ asset('uploads/parking/'.$item->image) }}"/>
                                              </div>
                                           </div>
                                           @endforeach
                                        @endif
                                    </div>                                   </div>
                                </div>
                                <div id="errorfile"></div>
                                <div class="tab-pane0 fade0 tab bg-white" id="v-pills-pricing" role="tabpanel" aria-labelledby="v-pills-pricing">
                                   <h2 class="mb-4">Set Your Price <small>(in USD)</small></h2>
                                   <p class="text-muted mb-2">Set a Base Price, which is the minimum earned for every booking.</p>
                                   <p class="text-muted mb-2"> Tip: Lower base prices tend to rank higher in seach results.</p>
                                   <div class="qtyy mt-5 col-md-10 pt-50 pb-50">
                                    <span class="minus bg-dark">-</span>
                                    <input type="number" class="count" required name="base_price" value="{{ old('base_price',  $space->base_price ?? '1') }}">
                                    <span class="plus bg-dark">+</span>
                                 </div>
                                 <div class="col-md-6 offset-md-2"> 
                                  <div class="form-group">
                                       <select name="price_type" required class="form-select" id="">
                                        <option value="" selected hidden>- Select price type -</option>
                                       <option value="hourly" @if(isset($space->price_type) && $space->price_type == 'hourly') selected @endif>Hourly</option>
                                       <option value="daily"@if(isset($space->price_type) && $space->price_type == 'daily') selected @endif>Daily</option>
                                       <option value="weekly"@if(isset($space->price_type) && $space->price_type == 'weekly') selected @endif>Weekly</option>
                                    </select>
                                 </div>
                                 </div>
                                </div>
                                <div class="tab-pane0 fade0 tab bg-white" id="v-pills-availability" role="tabpanel" aria-labelledby="v-pills-availability">
                                   <h2 class="mb-4">When Is Your Space Available?</h2>
                                   <p class="text-muted mb-2">Tell us which month your space is open in between what time youe space is available.</p>
                                   <div class="start_dates">
                                      <div class="col-md-5">
                                         <h5>Season start</h5>
                                         <div class="dropdown_park">
                                            <select id='gMonth2' class="form-select" required name="session_start">
                                               <option value="" selected hidden>- Select Month -</option>
                                             @foreach (getMonths() as $key => $value)
                                             <option value="{{ $key }}" {{ isset($space->session_start) && $space->session_start == $key ? 'selected' : ''  }}>{{ $value }}</option>                                                   
                                             @endforeach     
                                            </select>
                                         </div>
                                      </div>
                                      <div class="col-md-2">
                                         <h4>TO</h4>
                                      </div>
                                      <div class="col-md-5 seasonend">
                                         <h5>Season End</h5>
                                         <div class="dropdown_park">
                                            <select id='gMonth1' class="form-select" required name="session_end">
                                             <option value="" selected hidden>- Select Month -</option>
                                               @foreach (getMonths() as $key => $value)
                                               <option value="{{ $key }}" {{ isset($space->session_end) && $space->session_end == $key ? 'selected' : ''  }}>{{ $value }}</option>                                                   
                                               @endforeach                                              
                                            </select>
                                         </div>
                                      </div>
                                   </div>
                                   <hr>
                                   <div class="end_dates">
                                      <div class="col-md-5">
                                         <h5>Earliest Reservation</h5>
                                         <div class="dropdown_park">
                                            <select id='gtime2' class="form-select" required name="earliest_reservation">
                                               <option value="" selected hidden>- Select Time -</option>
                                               @foreach (getHours() as $key => $value)
                                               <option value='{{  $key }}' {{ isset($space->earliest_reservation) && $space->earliest_reservation == $key ? 'selected' : ''  }}>{{ $value }}</option>                                                   
                                               @endforeach   
                                             </select>                                           
                                         </div>
                                      </div>
                                      <div class="col-md-2">
                                         <h4>TO</h4>
                                      </div>
                                      <div class="col-md-5 seasonend">
                                         <h5>Latest Reservation</h5>
                                         <div class="dropdown_park">
                                            <select id='gtime1' class="form-select" required name="lastest_reservation">
                                             <option value="" selected hidden>- Select Time -</option>
                                             @foreach (getHours() as $key => $value)
                                             <option value='{{  $key }}' {{ isset($space->lastest_reservation) && $space->lastest_reservation == $key ? 'selected' : ''  }}>{{ $value }}</option>                                                   
                                             @endforeach    
                                            </select>
                                         </div>
                                      </div>
                                   </div>
                                </div>
                                <div class="tab-pane0 fade0 tab bg-white" id="v-pills-calendar" role="tabpanel" aria-labelledby="v-pills-calendar">
                                   <h2 class="mb-4">Manage Your Calendar</h2>
                                   <p class="text-muted mb-2">Editing your calendar is easy—just select a date to block or unblock it. You can always make <br>
                                      changes after you publish.
                                   </p>
                                   <input type="hidden" id="blocked-dates" name="blocked_dates">
                                   <div class="manage-calender"> </div>
                                </div>
                                <div id="nextbtn">
                                   {{-- <button type="button" class="btn btn-primary btn-default cont_btn NextBtn" id="park_btn">NEXT</button> --}}
                                   <!-- <button type="button" class="btn btn-primary btn-default cont_btn NextBtn" id="park_btn">Submit</button> -->
                                </div>

                                
                                 
                                <div class="col-md-12 p-0 mt-4">
                                          <button class="btn btn-primary" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                          <button class="btn btn-primary" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                    </div>

                             </div>
                           </form>
                          </div>
                       </div>
                </section>
                            </div>
                        </div>
                    </div><!-- .nk-block -->
                </div><!-- .components-preview -->
            </div>
        </div>
    </div>
</div>
<!-- content @e -->
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.map_key') }}&callback=initMap&libraries=places&v=weekly"
async defer></script>
<script src="{{ asset('assets/front/js/map.js') }}"></script>
<script>
$(document).on('click', '.remove-image', function() {
   parent = $(this).parent();
   pid = $(this).data('s');
   img = $(this).data('i');
   Swal.fire({
      icon: 'warning',
      title: 'Are you sure?',
      html: 'Do you really want to delete this image?<br>You won\'t be able to revert this!',
      showCancelButton: true,
      confirmButtonColor: 'red',
      confirmButtonText: `Delete`,
   }).then((result) => {
      if (result.isConfirmed) {
         $.ajax({
               type: "delete",
               data: { s: pid,i: img },
               url: "{{ route('host.space.delete-image')}}",
         }).done(function(data) {
               if (data.status) {
               parent.remove();
               }
         });
      }
   })
})
$(document).on("click", '.checker-area input:radio', function() {
	$('input:radio[name=' + $(this).attr('name') + ']').parents(".checker-area").removeClass('is-active');
	$(this).parents(".checker-area").addClass('is-active');
});
$(document).ready(function() {
	$('.form-select').select2({
		minimumResultsForSearch: -1,
		placeholder: function() {
			$(this).data('placeholder');
		}
	});
	$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
		localStorage.setItem('activeTab', $(e.target).attr('href'));
	});
	var activeTab = localStorage.getItem('activeTab');
	if(activeTab) {
		$('#myTab a[href="' + activeTab + '"]').tab('show');
	}
});
var datesFromDatabase = @json($blockedDates ?? []);
var dates = []
datesFromDatabase.forEach(element => {
	element = element.replace(/-/g, ',')
	dates.push(new Date(element))
	$('.manage-calender').siblings('input').val(JSON.stringify(dates))
});
$('.manage-calender').datepicker({
	debug: true,
	format: 'YYYY-MM-DD',
	multidate: true,
	startDate: new Date('{{ get_calender_month($space->session_start ?? 0) }}'),
	endDate: new Date('{{ get_calender_month($space->session_end ?? 0) }}'),
});
$('.manage-calender').datepicker('setDate', dates);
$('.manage-calender').datepicker().on('changeDate', function(ev) {
	$(this).siblings('input').val(JSON.stringify(ev.dates))
});

$(document).on('click', '.clear-image', function() {
   $(this).parent().remove();
})

$(document).ready(function() {
	$('#image1').change(function() {
		for(var i = 0; i < $(this)[0].files.length; i++) {
         $("#frames1").append('<div class="col-md-3 mb-3">  <a href="javascript:void(0)" class="clear-image">  <span> <i class="fas fa-times"></i></span>  </a><img src="'+window.URL.createObjectURL(this.files[i])+'" width="auto" height="200px"/></div>');
		}
	});
	$('#register-space').validate({
		errorElement: "span",
		errorClass: "invalid text-danger",
		rules: {
			'images[]': {
				required: true
			},
		},
      ignore: ".no-validate, :hidden",
		unhighlight: function(element, errorClass) {
			var $element = $(element);
			$element.removeClass('invalid text-danger')
			$element.siblings(".invalid").remove();
		},
		errorPlacement: function(error, element) {
			var name = element.attr('name');
			if(name == 'images[]') {
				$('#errorfile').html(error);
			} else if(element.attr('name') == 'park_radio') {
				$('#park_radio_error').html(error);
			} else {
				error.insertAfter(element);
			}
		}
	}, );
});

function validate() {
	$('#register-space').valid()
}
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab
function showTab(n) {
	// This function will display the specified tab of the form...
	var x = document.getElementsByClassName("tab");
	x[n].style.display = "block";
	//... and fix the Previous/Next buttons:
	if(n == 0) {
		document.getElementById("prevBtn").style.display = "none";
	} else {
		document.getElementById("prevBtn").style.display = "inline";
	}
	if(n == (x.length - 1)) {
		document.getElementById("nextBtn").innerHTML = "Submit";
	} else {
		document.getElementById("nextBtn").innerHTML = "Next";
	}
	//... and run a function that will display the correct step indicator:
	// fixStepIndicator(n)
}

function nextPrev(n) {
	// This function will figure out which tab to display
	var x = document.getElementsByClassName("tab");
	// Exit the function if any field in the current tab is invalid-input:
	if(n == 1 && !validateForm()) return false;
	// Hide the current tab:
	if(n == 1) {
		var activeTab = $('.custom-tabs .active');
		$('.custom-tabs .active').toggleClass("active");
		activeTab.next('a').toggleClass("active");
	} else {
		var activeTab = $('.custom-tabs .active');
		$('.custom-tabs .active').toggleClass("active");
		activeTab.prev('a').toggleClass("active");
	}
	if(currentTab < (x.length - 1)) {
		x[currentTab].style.display = "none";
	}
	currentTab = currentTab + n;
	// Increase or decrease the current tab by 1:
	// if you have reached the end of the form...
	if(currentTab >= x.length) {
		// ... the form gets submitted:
      $('.loader-overlay').removeClass('d-none')
		document.getElementById("register-space").submit();
		return false;
	}
	// Otherwise, display the correct tab:
	showTab(currentTab);
}

function validateForm() {
	return $('#register-space').valid();
}

function fixStepIndicator(n) {
	// This function removes the "active" class of all steps...
	var i, x = document.getElementsByClassName("step");
	for(i = 0; i < x.length; i++) {
		x[i].className = x[i].className.replace(" active", "");
	}
	//... and adds the "active" class on the current step:
	x[n].className += " active";
}
$("input[type='radio']").change(function() {
	if($(this).val() == "true") {
		$("#otherAnswer").show();
	} else {
		$("#otherAnswer").hide();
	}
});
</script>
@endpush
