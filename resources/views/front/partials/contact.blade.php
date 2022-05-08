<div class="cf-container">
   <form action="{{ route('front.contact.submit') }}" method="post" id="cf">
      @csrf
      <div class="form-group">
         <input type="email" name="email" class="form-control" id="cf-email" placeholder="Enter email">
      </div>
      <div class="form-group">
         <input type="text" name="subject" class="form-control" id="cf-subject" placeholder="Subject">
      </div>
      <div class="form-group">
         <textarea class="form-control rounded-0" name="message" id="cf-message" rows="5"
            placeholder="Write Your Message Here..."></textarea>
      </div>
      <div class="form-group">
         <button type="submit" class="btn btn-primary submit-btn">Submit</button>
      </div>
   </form>
</div>

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
                  $('.submit-btn').text('Processing...')
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
                           if(response.status == true){
                              $('.submit-btn').text('Submit')
                              $(form).trigger("reset");
                              toastr.success(response.message);                               
                           }
                        },
                        error: function(error){
                           toastr.error('Something went wrong!');                               
                        }            
                  });
               }
            });
         });
</script>
@endpush