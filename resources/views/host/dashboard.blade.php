@extends('layouts.front')

@section('content')
<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
            
                @include('admin.partials.alerts')


   

                <section class="py-5 header">
                    <div class="container py-4">
                    <div class="tabs_area">
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
                             <form action="{{ route('host.space.store') }}" method="post" enctype="multipart/form-data" id="register-space">
                                 @csrf

                                 
                             
                             <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane0 fade0 tab bg-white show active" id="v-pills-parking" role="tabpanel" aria-labelledby="v-pills-parking-tab">
                                   <h2 class="mb-4">Hey {{ ucwords(auth()->user()->name) }}, Let's Get Started Listing<br> Your Space</h2>
                                   <p class="text-muted mb-2">Where is your space located?</p>
                                   <button type="button" class="btn btn-primary btn-default" id="park_btn">Use my Current Location</button>
                                   <p class="orr">or</p>
                                   <input type="text" name="address" id="park_input" placeholder="Enter Address" required />
                                   
                                   {{-- <button type="button" class="btn btn-primary btn-default cont_btn" id="park_btn">CONTINUE</button> --}}
                                   <div class="loc_map">
                                      <!--Google map-->
                                      <div id="map-container-google-1" class="z-depth-1-half map-container" style="height: 500px">
                                         <iframe src="https://maps.google.com/maps?q=manhatan&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0"
                                            style="border:0" allowfullscreen></iframe>
                                      </div>
                                      <!--Google Maps-->
                                   </div>
                                </div>
                                <div class="tab-pane0 fade0 tab bg-white" id="v-pills-Desc" role="tabpanel" aria-labelledby="v-pills-Desc-tab">
                                   <h2 class="mb-4">Add A Title & Description</h2>
                                   <div class="dec-title">
                                      <label class="text-muted mb-2">Title</label>
                                      <br>
                                      <input type="text" name="title" id="park_input" required placeholder="Enter Title">
                                   </div>
                                   <div class="desc-textarea"> 
                                      <label class="text-muted mb-2">Write a Description
                                      </label><br>
                                      <textarea rows="6" name="description"  id="park_textarea" class="park_textarea form-control" required placeholder="Enter Address"></textarea>
                                   </div>
                                </div>
                                <div class="tab-pane0 fade0 tab bg-white" id="v-pills-park_cat" role="tabpanel" aria-labelledby="v-pills-park_cat-tab">
                                   <h2 class="mb-4">What Kind Of Space Are You Listing?</h2>
                                   <div class="park_cat_options row">
                                       @foreach ($space_cats as $key => $value )                                           
                                       <div class="col-md-3">
                                          <input type="radio" name="category[space]" required value="{{ $value->id }}" id="park_img{{ $value->id  }}" class="input-hidden" />
                                          <label for="park_img{{ $value->id  }}">
                                             <img src="{{ asset('categories/'. $value->image) }}" alt="{{ $value->title }}" />
                                             </label for>
                                       </div>
                                       @endforeach
                                   </div>
                                   <h2 class="mb-4">Select Your Vehicle Or Vessel?</h2>
                                   <div class="park_cat_options row">
                                    @foreach ($vehicle_cats as $key => $value )                                           
                                    <div class="col-md-3">
                                       <input type="radio" name="category[vehicle]" required value="{{ $value->id }}" id="park_img{{ $value->id  }}" class="input-hidden" />
                                       <label for="park_img{{ $value->id  }}">
                                          <img src="{{ asset('categories/'. $value->image) }}" alt="{{ $value->title }}" />
                                          </label for>
                                    </div>
                                    @endforeach
                                   </div>
                                </div>
                                <div class="tab-pane0 fade0 tab bg-white" id="v-pills-instructions" role="tabpanel" aria-labelledby="v-pills-instructions">
                                   <h2 class="mb-4">Please Read Carefully Before Going Forward?
                                   </h2>
                                   <div class="row">
                                      <div class="col-md-6">
                                         <input type="checkbox" required />
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
                                      <label class="radio checker-area" for="no">
                                      <input type="radio" name="will_host_greet" required value="no" id="no" required >I will not be home
                                      </label>
                                      <label class="radio checker-area" for="yes">
                                      <input type="radio" name="will_host_greet" value="yes" id="yes" required />I will be home
                                      </label>
                                      <label class="radio checker-area" for="other">
                                      <input type="radio" name="will_host_greet" value="other" id="other" required >Other
                                      </label>
                                   </div>
                                   <h4>Are there surveillance cameras present?</h4>
                                   <div class="form-check" id="camera_form">
                                      <label class="radio checker-area">
                                      <input type="radio" name="has_surveillance" required value="yes" required  />I have security cameras 1
                                      </label>
                                      <label class="radio checker-area">
                                      <input type="radio" name="has_surveillance" value="no" required />I don't have security cameras
                                      </label>
                                   </div>
                                </div>
                                <div class="tab-pane0 fade0 tab bg-white" id="v-pills-photo" role="tabpanel" aria-labelledby="v-pills-photo">
                                   <h2 class="mb-4">Add Photos To Your Listing!</h2>
                                   <p class="text-muted mb-2">Take photos using a phone or camera. Upload at least one photo to publish your listing and<br>
                                      drag to reorder however you like. You can always add or edit your photos later.
                                   <div class="photos_listing">
                                      <div class="photo_input">
                                         <input type="file" id="image1" required name="images[]" multiple />
                                      </div>
                                      <br/>
                                      <div class="row" id="frames1"></div>
                                   </div>
                                </div>
                                <div class="tab-pane0 fade0 tab bg-white" id="v-pills-pricing" role="tabpanel" aria-labelledby="v-pills-pricing">
                                   <h2 class="mb-4">Set Your Price</h2>
                                   <p class="text-muted mb-2">Set a Base Price, which is the minimum earned for every booking.</p>
                                   <p class="text-muted mb-2"> Tip: Lower base prices tend to rank higher in seach results.</p>
                                   <div class="qtyy mt-5 col-md-10">
                                      <span class="minus bg-dark">-</span>
                                      <input type="number" class="count" required name="base_price" value="1">
                                      <span class="plus bg-dark">+</span>
                                   </div>
                                </div>
                                <div class="tab-pane0 fade0 tab bg-white" id="v-pills-photo" role="tabpanel" aria-labelledby="v-pills-photo">
                                   <h4 class="mb-4">Photo and details</h4>
                                   <p class="text-muted mb-2">Photo ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                </div>
                                <div class="tab-pane0 fade0 tab bg-white" id="v-pills-availability" role="tabpanel" aria-labelledby="v-pills-availability">
                                   <h2 class="mb-4">When Is Your Space Available?</h2>
                                   <p class="text-muted mb-2">Tell us which month your space is open in between what time youe space is available.</p>
                                   <div class="start_dates">
                                      <div class="col-md-5">
                                         <h5>Season start</h5>
                                         <div class="dropdown_park">
                                            <select id='gMonth2' name="session_start">
                                             @foreach (getMonths() as $key => $value)
                                             <option value="{{ $key }}">{{ $value }}</option>                                                   
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
                                            <select id='gMonth1' name="session_end">
                                               @foreach (getMonths() as $key => $value)
                                               <option value="{{ $key }}">{{ $value }}</option>                                                   
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
                                            <select id='gtime2' name="earliest_reservation">
                                               @foreach (getHours() as $key => $value)
                                               <option value='{{  $key }}'>{{ $value }}</option>                                                   
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
                                            <select id='gtime1' name="lastest_reservation">
                                             @foreach (getHours() as $key => $value)
                                             <option value='{{  $key }}'>{{ $value }}</option>                                                   
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
                                   <div class="date1"> </div>
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
                    </div>
                 </section>
            </div>
        </div>
    </div>
</div>
<!-- content @e -->
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

<script>

      $(document).on("click", '.checker-area input:radio', function() {
         $('input:radio[name='+ $(this).attr('name')+']').parents(".checker-area").removeClass('is-active');
         $(this).parents(".checker-area").addClass('is-active');
      });

      $(document).ready(function(){      
         $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
         });
         var activeTab = localStorage.getItem('activeTab');
         if(activeTab){
            $('#myTab a[href="' + activeTab + '"]').tab('show');
         }
      });

      $('.date1').datepicker({
         inline: true,
         sideBySide: true,
         keepOpen: true,
         format: 'YYYY-MM-DD hh:mm A',
         debug:true,
         multidate: true
      });
             
      
   //    $(document).ready(function() {
   //    $("#register-space").validate({
   //       errorClass: 'login-error',
   //    });
   // });

   //  $(document).ready(function(){
   //   $( function() {
   //  $( "#datepicker" ).datepicker();
   //     });
   //    });

   $(document).ready(function(){
        $('#image1').change(function(){
            $("#frames1").html('');
            for (var i = 0; i < $(this)[0].files.length; i++) {
                $("#frames1").append('<div class="col-md-4"><img src="'+window.URL.createObjectURL(this.files[i])+'" width="auto" height="200px"/></div>');
            }
        });


      $(function() {
    $('#register-space').validate(
      {
        rules:{ 
            address:{ 
              required:true
            } 
         },
        messages: { address: { required:"Please select a Color<br/>" } },
        
         highlight: function(element, errorClass) {
            $(element).closest(".form-group").addClass("has-error");
         },
         unhighlight: function(element, errorClass) {
            $(element).closest(".form-group").removeClass("has-error");
         },
         errorPlacement: function (error, element) {
            error.appendTo(element.parent().next());
         },
         errorPlacement: function (error, element) {
            if(element.attr("type") == "checkbox") {
               element.closest(".form-group").children(0).prepend(error);
            }
            else
               error.insertAfter(element);
         }
         
      });
    
  });
 


    });


    

    var currentTab = 0; // Current tab is set to be the first tab (0)
         showTab(currentTab); // Display the crurrent tab

         function showTab(n) {
         // This function will display the specified tab of the form...
         var x = document.getElementsByClassName("tab");
         x[n].style.display = "block";
         //... and fix the Previous/Next buttons:
         if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
         } else {
            document.getElementById("prevBtn").style.display = "inline";
         }
         if (n == (x.length - 1)) {
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
            // Exit the function if any field in the current tab is invalid:
            if (n == 1 && !validateForm()) return false;
            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form...
            if (currentTab >= x.length) {
               // ... the form gets submitted:
               document.getElementById("register-space").submit();
               return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
         }

         function validateForm() {
         // This function deals with validation of the form fields
         var x, y, i, valid = true;
         x = document.getElementsByClassName("tab");
         y = x[currentTab].getElementsByTagName("input");
         // A loop that checks every input field in the current tab:
         for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
               // add an "invalid" class to the field:
               y[i].className += " invalid";
               // and set the current valid status to false
               //valid = false;
               (y[i].style.display == "none")?valid = true:valid = false;
            }
         }
         // If the valid status is true, mark the step as finished and valid:
         // if (valid) {
         //    document.getElementsByClassName("step")[currentTab].className += " finish";
         // }
         return valid; // return the valid status
         }

         function fixStepIndicator(n) {
            // This function removes the "active" class of all steps...
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
               x[i].className = x[i].className.replace(" active", "");
            }
            //... and adds the "active" class on the current step:
            x[n].className += " active";
         }

         
         $("input[type='radio']").change(function(){
               
            if($(this).val()=="true") {
               $("#otherAnswer").show();
            } else {
               $("#otherAnswer").hide(); 
            }
            
         });






 

</script>




<style>
   .tab {
  display: none;
}
</style>

@endpush