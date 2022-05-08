@extends('layouts.front')

@section('content')

<section class="section_inner contact_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading">
                    <h2 style="color: #0060AD;">Contact <span style="color: #222222;">Us</span></h2>
                </div>
            </div>
        </div>

        <div class="container-fluid">
          <div class="row order_tables">
              <div class="col-lg-8 col-md-12 col1">
                  <div class="form_contact">

                    <form action="{{ route('front.contact.submit') }}" id="cf" method="post">
                        @csrf
                      <div class="form-group">
                        <label for="">Full Name</label>
                        <input type="text" name="name" class="form-control" placeholder="John Doe">
                      </div>
                      
                      <div class="form-group">
                        <label for="">Subject Line <span class="text-danger">*</span></label>
                        <input type="text" name="subject" class="form-control" placeholder="For Contact">
                      </div>
  
                      <div class="form-group">
                        <label for="">Email <span class="text-danger">*</span></label>
                        <input type="text" name="email" class="form-control" placeholder="For Contact">
                      </div>
  
                      <div class="form-group">
                        <label for="">Message <span class="text-danger">*</span></label>
                        <textarea name="message" class="form-control" placeholder="Write Something Here..."></textarea>
                      </div>
  
                      <div class="form-group">
                        <input type="submit" class="btn btn_contact" value="Send">
                     </div>
  
                    </form>

                  </div>
              </div>
              <div class="col-lg-4  col-md-12 col2">
                <div class="user_info">
                  <img src="images/email.png" alt="">
                  <h4>Email</h4>
                  <a href="mailto:info@parkinggenie.com">info@parkinggenie.com</a>
                </div>
              </div>
          </div>
      </div>
            


    </div>
</section>

@endsection

@push('scripts')
<script>
   $(document).ready(function() {
            $("#cf").validate({
               errorClass: 'contact-error',
               rules: {           
                  email: {
                     required: true,
                     email: true
                  },
                  subject : {
                     required: true,
                  },
                  message : {
                     required: true,
                  }
               },
               submitHandler: function(form) {
                  $('.btn_contact').val('Processing...')
                  toastr.options = {
                     "closeButton": true,
                     "progressBar": true,
                     "positionClass": "toast-top-right",
                     "timeOut": 8000
                  }
                  $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                           $('.btn_contact').val('Submit')
                           if(response.status == true){
                              $(form).trigger("reset");
                              toastr.success(response.message);                               
                            }else{
                               toastr.error(response.message);                              
                            }
                        },
                        error: function(error){
                           toastr.error(error);                               
                        }            
                  });
               }
            });
         });
</script>
@endpush