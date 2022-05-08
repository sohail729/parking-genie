<nav class="navbar navbar-expand-md bg-dark navbar-dark myMenu">
   <div class="container">
      <a href="{{ route('front.home') }}" class="navbar-brand">
         <img src="{{ asset('assets/front/img/logo-main.png') }}" alt="Parking_Logo"
            class="brand-image img-circle elevation-3">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="collapsibleNavbar">
         <ul class="navbar-nav ml-auto">
            <li class="nav-item">
               <a class="nav-link" href="{{ route('front.find-space') }}">Park<br> or<br> Dock</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="{{ route('host.index') }}">List a Space
                  <br>or<br>
                  Boat Dock</a>
            </li>
            <!-- Dropdown -->
            <li class="nav-item dropdown UserDropDown">
               <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                  <i class="fa fa-bars" aria-hidden="true"></i>
                  <i class="fa fa-user-circle-o" aria-hidden="true"></i>
               </a>
               <div class="dropdown-menu">                
                  @guest
                  <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#loginModal">
                     <i class="mr-2"></i> Log in
                  </a>
                  <a href="{{ route('front.choose-a-plan') }}" class="dropdown-item">
                     <i class="mr-2"></i> Sign Up
                  </a>
                  @endguest

                  @admin
                  <a href="{{ route('admin.dashboard.index') }}" class="dropdown-item">
                     <i class="mr-2"></i> Dashboard
                    </a>
                  @endadmin
                  @host
                  <a href="{{ route('host.dashboard.index') }}" class="dropdown-item">
                     <i class="mr-2"></i> Dashboard
                    </a>
                  @endhost
                  @user
                  <a href="{{ route('user.space.bookings.index') }}" class="dropdown-item">
                     <i class="mr-2"></i> Profile/Bookings
                    </a>
                  @enduser
                  <div class="dropdown-divider"></div>
                  <a href="{{ route('front.find-space') }}" class="dropdown-item">
                     <i class="mr-2"></i> Find A Space
                  </a>
                  <a href="{{ route('front.help') }}" class="dropdown-item">
                     <i class="mr-2"></i> Help
                  </a>
                  @auth
                  <div class="dropdown-divider"></div>

                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                     <i class="mr-2"></i> Logout

                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                     </form>
                  </a>
                  @endauth
               </div>
            </li>
         </ul>
      </div>
   </div>
</nav>