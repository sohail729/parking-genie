<div class="modal fade login_modal" id="resetModal" role="dialog">
    <div class="modal-dialog">
       <!-- Modal content-->
       <div class="modal-content">
          <button type="button" class="close removeReset" data-dismiss="modal">&times;</button>
          <div class="row">
             <div class="col-sm-12">
                <div class="heading_login">
                   <h2>Reset Password
                   </h2>
                </div>
             </div>
          </div>
          <div class="row">
             <div class="col-sm-12">
               <form action="{{ url('/password/email') }}" method="post" id="reset">
                  @csrf
                <div class="login_form">
                   @include('front.partials.modal.alerts')
                   <div class="form-group">
                      <label for="">Email <span class="text-danger">*</span></label>
                      <input type="text" name="email" class="form-control" required placeholder="Enter your email address" >                    
                   </div>
                </div>
                <input type="submit" value="Send reset link" class="btn btn_login">
               </form>
             </div>
          </div>
       </div>
    </div>
 </div>

 @push('scripts')
<script>
   $(document).ready(function(){
      @if(Session::has('reset-error'))      
         $('#resetModal').modal('show'); 
      @elseif(Session::has('reset-success'))
         toastr.success("{{ Session::get('reset-success') }}");                                          
      @endif
   }); 

   $(document).ready(function() {
      $("#reset").validate({
         errorClass: 'login-error',
         rules: {           
            email: {
               required: true,
               email: true
            }
         }
      });
   });
   $(".removeReset").click(function(){
      $('#resetModal').modal('hide')
   });
   </script>    
 @endpush