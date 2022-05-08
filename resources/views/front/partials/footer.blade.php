<footer class="page-footer font-small unique-color-dark" id="main-foot">
    <div class="container">
       <div class="container text-md-left mt-5">
          <div class="row mt-3">
             <div class="col-md-4 col-lg-4 col-xl-3 mx-auto mb-4 foot-logo">
                <p><img src="{{ asset('assets/front/img/logo-main.png') }}"></p>
             </div>
             <div class="col-md-4 col-lg-2 col-xl-2 mx-auto mb-4">
                <h6>CONTACT US</h6>
                <p>
                   <a href="javascript:void(0)">BOOKING & PAYMENT</a>
                </p>
                <p>
                   <a href="{{ route('front.privacy-policy') }}">PRIVACY POLICY</a>
                </p>
                <p>
                   <a href="{{ route('front.terms-conditions') }}">TERMS & CONDITIONS</a>
                </p>
                <p>
                   <a href="javascript:void(0)">FAQs</a>
                </p>
             </div>
             <div class="col-md-4 col-lg-2 col-xl-2 mx-auto mb-4">
                <h6>PAYMENT METHOD</h6>
                <p><img src="{{ asset('assets/front/img/pay.png') }}"></p>
             </div>
             <div class="col-md-4 col-lg-3 col-xl-2 mx-auto mb-md-0 mb-4">
                <h6>REACH US</h6>
                <p>
                   <a href="mailto:info@parkinggenie.com">info@parkinggenie.com</a>
                </p>
                <!-- <p>
                   <i class="fas fa-envelope mr-3"></i> info@example.com</p>
                   <p>
                   <i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
                   <p>
                   <i class="fas fa-print mr-3"></i> + 01 234 567 89</p> -->
             </div>
             <div class="btn_scroll">
                <button id="scroll_top"><img src="{{ asset('assets/front/img/arrow_up.png') }}"></button>
             </div>
          </div>
       </div>
    </div>
 </footer>
 <div class="footer-copyright text-center py-3">
    <div class="col-md-6">
       <?= date('Y') ?> Parking Genie. All Rights Reserved.
    </div>
    <div class="col-md-6">
       <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
       <a href="#"> <i class="fa fa-twitter" aria-hidden="true"></i></a>
       <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
    </div>
 </div>