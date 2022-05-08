<div class="modal fade login_modal" id="loginModal" role="dialog">
    <div class="modal-dialog">
       <!-- Modal content-->
       <div class="modal-content">
          <button type="button" class="close removeLogin" data-dismiss="modal">&times;</button>
          <div class="row">
             <div class="col-sm-12">
                <div class="heading_login">
                   <h2>Welcome To <span style="color: #0060AD;">Parking</span> <span style="color: #9D121F;">Genie</span>
                   </h2>
                </div>
             </div>
          </div>
          <div class="row">
             <div class="col-sm-12">
               <form action="{{ route('user.auth.login') }}" method="post" id="loginForm">
                  @csrf
                <div class="login_form">
                   @include('front.partials.modal.alerts')
                   <div class="form-group">
                      <label for="">Email <span class="text-danger">*</span></label>
                      <input type="text" name="email" class="form-control" required placeholder="Enter your email address" >                    
                   </div>
                   <div class="form-group input-group mb-3 toggle-password">
                     <label for="" class="w-100">Password <span class="text-danger">*</span></label>
                     <input type="password" name="password" class="form-control height-50 cus-input-bor" id="password-field" required placeholder="Enter password"
                      aria-describedby="basic-addon2" required placeholder="Enter password">
                     <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">
                           <a href="javascript:void(0)" class="toggle text-dark"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </span>
                     </div>
                   </div>
                   <ul>
                      <li>                         
                         <label class="container_check">Remember Me
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                           </label>
                        </li>
                        <li><a href="javascript:void(0)" class="forgotPwd" >Forgot Password</a></li>
                     </ul>
                     <input type="submit" value="Login" class="btn btn_login">
                   <p>Don't have an account? <a href="{{ route('front.choose-a-plan') }}">Signup</a></p>
                </div>
               </form>
             </div>
          </div>
       </div>
    </div>
 </div>

 @push('scripts')
<script>

     $(document).ready(function(){
      @if(Session::has('modal-alert-danger'))
         $('#loginModal').modal('show');
      @endif
   });

   $(document).ready(function() {
      $("#loginForm").validate({
         errorClass: 'login-error',
         rules: {           
            email: {
               required: true,
               email: true
            },
            password : {
               required: true,
            }
         }
      });
   });
   $(".modal button.removeLogin").click(function(){
      $("#loginModal").modal('hide');
   });
   </script>    
 @endpush