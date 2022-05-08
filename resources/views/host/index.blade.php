@extends('layouts.front')

@section('content')
<div class="new-home-banner" onclick="window.location='{{ route('front.choose-a-plan') }}'">


   <section id="homemain" class="banner newhome" style="background-image: url({{ asset('assets/front/img/head-02.png')}})">
      <div class="container">
         <h2>Start hosting on<br>
            <b>Parking Genie</b>
         </h2>
         @guest
         <a href="{{ route('front.choose-a-plan') }}" class="btn btn-primary btn-default get-started-btn">Get Started <i class="fa fa-arrow-right" aria-hidden="true"></i>
         </a>
         @endguest
         @admin
         <a href="{{ route('admin.dashboard.index') }}" class="btn btn-primary btn-default get-started-btn"> Go to dashboard   <i class="fa fa-arrow-right" aria-hidden="true"></i>
         </a>
         @endadmin
         @user
         <a href="{{ route('front.find-space') }}" class="btn btn-primary btn-default get-started-btn">Find a space
         <i class="fa fa-arrow-right" aria-hidden="true"></i>
         </a>
         @enduser
         @host
         <a href="{{ route('host.dashboard.index') }}" class="btn btn-primary btn-default get-started-btn"> Go to dashboard   <i class="fa fa-arrow-right" aria-hidden="true"></i>
         </a>
         @endhost       
      </div>
   </section>
</div>


<section class="newhome5" id="inside_p">
   <div class="container">

      <div class="row">
         <div class="col-md-4 first-md4">
            <h2 class="underlinee">
               Genie
               <span class="new-clr"><br>Host</span>
            </h2>
            <span class="normal-span">Free</span>
            <p>This account level provides residential hosts the option of listing boat docks or two (2) or less parking
               spaces, including a garage.</p>



         </div>

         <div class="col-md-4">
            <h2 class="underlinee">Super Genie
               <span class="new-clr"><br>Host</span>
            </h2>
            <span class="normal-span">$3.99 monthly or $29.99 annually
            </span>
            <p>This is our featured residential subscription account level that allows hosts the ability to list boat
               docks or three (3) to four (4) parking spaces, including a garage.</p>

         </div>

         <div class="col-md-4">
            <h2 class="underlinee">Commercial<br>
               Genie <span class="new-clr">Host</span>
            </h2>
            <span class="normal-span">$69.99 annually</span>
            <p>This is our commercial subscription account level allows hosts the ability to have bulk listings. As
               commercial Genie hosts, you have the option of listing boat docks, and an unlimited amount of parking
               spaces to guests.
            </p>

         </div>
         <div class="col-md-12 text-center">
            <a href="{{ route('front.choose-a-plan') }}" class="btn btn-lg btn-primary btn_purchase">Choose a Plan <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
         </div>

      </div>

   </div>

</section>
<section class="newhome6" id="inside_p2">
   <div class="container">
      <div class="col-md-6" style=" text-align: center;">
         <h2 class="underlinee" id="redclrh2">
            <span class="h2-light">Ideal</span>
            <span class="new-red-clr">
               Genie</span>
            Hosts
         </h2>
      </div>
      <div class="row">

         <div class="col-md-6 ">

            <div class="guest-f-row">
               <div class="guests-text">
                  <div class="col-md-6 ">
                     <div class="card">
                        <div class="card-body">
                           <div class="guest-img">
                              <img src="{{ asset('assets/front/img/gi1.png')}}">
                              <h5 class="card-title">Live Near A Sports Venue?</h5>
                           </div>

                           <p class="card-text">For years savvy home owners residing near stadiums and arenas have taken
                              advantage of earning extra income through seasonal sporting events by standing on busy
                              corners soliciting parking. While this strategy may produce income, it does require lots
                              of time and solicitation. Now that the Genie is out of the bottle, anyone can simply list
                              their space on the Parking Genie platform and effortlessly collect income.
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="card">
                        <div class="card-body">
                           <div class="guest-img">
                              <img src="{{ asset('assets/front/img/gi2.png')}}">
                              <h5 class="card-title">Can Home Owner Associations<br>
                                 Benefit?</h5>
                           </div>
                           <p class="card-text">Parking Genie could be a great opportunity for HOA’s to offset budgeted
                              or unexpected costs around communities, simply by enrolling and renting allocated guest
                              parking space.
                           </p>

                        </div>
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="card">
                        <div class="card-body">
                           <div class="guest-img">
                              <img src="{{ asset('assets/front/img/gi3.png')}}">
                              <h5 class="card-title">What If I’m A Snow Bird?</h5>
                           </div>
                           <p class="card-text">If you are a snow bird living in an area part time, you may have the
                              fortune of renting your unused parking space to interested guests. Turn that vacant
                              parking space into an income producing business by becoming a Genie Host or VIP Genie
                              Host.</p>

                        </div>
                     </div>
                  </div>

               </div>
            </div>

         </div>
         <div class="col-md-6">


            <div class="guests-text">
               <div class="col-md-6">
                  <div class="card">
                     <div class="card-body">
                        <div class="guest-img">
                           <img src="{{ asset('assets/front/img/gi4.png')}}">
                           <h5 class="card-title">How About Colleges & Universities.</h5>
                        </div>
                        <p class="card-text">College towns are also ideal areas to list available space on the Parking
                           Genie platform. Tailgating at an affordable price as well as easily accessible on and off
                           campus parking is possible with Parking Genie.
                        </p>

                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="card">
                     <div class="card-body">
                        <div class="guest-img">
                           <img src="{{ asset('assets/front/img/gi5.png')}}">
                           <h5 class="card-title">What About Property
                              <br>
                              Management Companies?
                           </h5>
                        </div>
                        <p class="card-text">There is a huge market for discounted overnight parking space throughout
                           the country. Commercial contractors are regularly searching for space to park some or all of
                           their vehicle fleet. Become a VIP Genie Host and capitalize on the need for overnight parking
                           space.
                        </p>

                     </div>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="card">
                     <div class="card-body">
                        <div class="guest-img">
                           <img src="{{ asset('assets/front/img/gi6.png')}}">
                           <h5 class="card-title">Live Near Beaches, Lakes, Mountains
                              <br>
                              Or Amusement Parks?
                           </h5>
                        </div>
                        <p class="card-text">Cash in by living near places people visit seasonally or year-round. Beach
                           goers, sightseers and thrill seekers of all kinds are always looking for places to park.
                           Allow their saving and convenience desires to become your source of income.</p>

                     </div>
                  </div>
               </div>

            </div>
         </div>


      </div>

   </div>

</section>


<section class="bookingss"
   style="background-image: url({{ asset('assets/front/img/medium_image.png')}}); background-size: cover; background-repeat: no-repeat;">
   <div class="container">

      <h2 class="underlinee">Ideas To Entice<span class="new-clr">
            Bookings</span>
      </h2>
      <div class="row">
         <div class="col-md-3">
            <div class="card">
               <img class="card-img-top" src="{{ asset('assets/front/img/book-3.png')}}">
               <div class="card-body">
                  <p class="card-text">Make sure your listing<br>
                     has a clear image of<br>
                     the space.</p>

               </div>
            </div>
         </div>
         <div class="col-md-3">
            <div class="card">
               <img class="card-img-top" src="{{ asset('assets/front/img/book-2.png')}}">
               <div class="card-body">
                  <p class="card-text">Ensure necessary<br>
                     marking and signage<br>
                     is in place for guests.
                  </p>

               </div>
            </div>
         </div>
         <div class="col-md-3">
            <div class="card">
               <img class="card-img-top" src="{{ asset('assets/front/img/book-1.png')}}">
               <div class="card-body">
                  <p class="card-text">Ensure guests will feel<br>
                     confident their vehicle<br>
                     will be safeguarded.
                  </p>

               </div>
            </div>
         </div>
         <div class="col-md-3">
            <div class="card">
               <img class="card-img-top" src="{{ asset('assets/front/img/book-4.png')}}">
               <div class="card-body">
                  <p class="card-text">Keep a well-manicured<br>
                     space and be sure to<br>
                     make necessary<br>
                     repairs.
                  </p>

               </div>
            </div>
         </div>


         <div class="col-md-3">
            <div class="card">
               <img class="card-img-top" src="{{ asset('assets/front/img/book-5.png')}}">
               <div class="card-body">
                  <p class="card-text">Offer items such as<br>
                     bottled waters,<br>
                     disposable coolers<br>
                     and ice.</p>

               </div>
            </div>
         </div>

         <div class="col-md-3">
            <div class="card">
               <img class="card-img-top" src="{{ asset('assets/front/img/book-6.png')}}">
               <div class="card-body">
                  <p class="card-text">Offer a discounted rate<br>
                     in exchange for longer<br>
                     booking periods.</p>

               </div>
            </div>
         </div>

         <div class="col-md-3">
            <div class="card">
               <img class="card-img-top" src="{{ asset('assets/front/img/book-7.png')}}">
               <div class="card-body">
                  <p class="card-text">Offer discounted weekly<br>
                     or seasonal bookings to<br>
                     lock in income.</p>

               </div>
            </div>
         </div>

         <div class="col-md-3">
            <div class="card">
               <img class="card-img-top" src="{{ asset('assets/front/img/book-8.png')}}">
               <div class="card-body">
                  <p class="card-text">Offer multi car<br>
                     discounts if space<br>
                     permits.</p>

               </div>
            </div>
         </div>
      </div>
   </div>

</section>

<div class="img-overly" onclick="window.location='{{ route('front.choose-a-plan') }}'">
   <section id="bottom-foot" class="book_foot" style="background-image: url({{ asset('assets/front/img/PaulGym07.png')}})">
      <div class="container">
         <h2>
            <b>Start Hosting</b>
         </h2>
         @guest
         <a href="{{ route('front.choose-a-plan') }}" class="btn btn-primary btn-default get-started-btn">Get Started  <i class="fa fa-arrow-right" aria-hidden="true"></i> </a>
         @endguest
         @admin
         <a href="{{ route('admin.dashboard.index') }}" class="btn btn-primary btn-default get-started-btn"> Go to dashboard   <i class="fa fa-arrow-right" aria-hidden="true"></i>
         </a>
         @endadmin
         @host
         <a href="{{ route('host.dashboard.index') }}" class="btn btn-primary btn-default get-started-btn"> Go to dashboard   <i class="fa fa-arrow-right" aria-hidden="true"></i>
         </a>
         @endhost      
      </div>
   </section>
</div>

@endsection

@push('scripts')
<script>

   $(document).on('click', '.get-started-btn', function(){
      $('#loginModal').modal('show')
   })

   @if(Session::has('toastr.error'))
      toastr.options =
      {
         "closeButton": true,
         "progressBar": true,
         "positionClass": "toast-top-center",
      }
  		toastr.error("{{ session('toastr.error') }}");
  @endif
   @if(Session::has('toastr.success'))
      toastr.options =
      {
         "closeButton": true,
         "progressBar": true,
         "positionClass": "toast-top-center",
         "timeOut": 8000,

      }
  		toastr.success("{{ session('toastr.success') }}");
  @endif


</script>
@endpush