    <!-- sidebar @s -->
    <div class="nk-sidebar nk-sidebar-fixed is-light @user is-compact @enduser" data-content="sidebarMenu">
        <div class="nk-sidebar-element nk-sidebar-head">
            <div class="nk-menu-trigger">
                <a href="javascript:void(0)" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                <a href="javascript:void(0)" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
            </div>
            <div class="nk-sidebar-brand">
                @admin
                <a href="{{ route('admin.dashboard.index') }}" class="logo-link nk-sidebar-logo">
                    <img class="logo-dark logo-img" src="{{ asset('assets/front/img/logo-main.png') }}" srcset="./images/logo2x.png 2x" alt="logo">
                </a>
                    @endadmin
                    @user
                    <a href="{{ route('user.space.bookings.index') }}" class="logo-link nk-sidebar-logo">
                    <img class="logo-dark logo-img" src="{{ asset('assets/front/img/logo-main.png') }}" srcset="./images/logo2x.png 2x" alt="logo">
                </a>
                    @enduser
                    @host
                    <a href="{{ route('host.dashboard.index') }}" class="logo-link nk-sidebar-logo">
                    <img class="logo-dark logo-img" src="{{ asset('assets/front/img/logo-main.png') }}" srcset="./images/logo2x.png 2x" alt="logo">
                </a>
                    @endhost  

            </div>
        </div><!-- .nk-sidebar-element -->
        <div class="nk-sidebar-element nk-sidebar-body">
            <div class="nk-sidebar-content">
                <div class="nk-sidebar-menu" data-simplebar>
                    <ul class="nk-menu">                        
                    @host()
                      <li class="nk-menu-item">
                            <a href="{{ route('host.dashboard.index') }}" class="nk-menu-link clickable">
                                <span class="nk-menu-icon"><em class="icon ni ni-dashboard-fill"></em></span>
                                <span class="nk-menu-text">Dashboard</span>
                            </a>
                        </li><!-- .nk-menu-item -->   
                        @unless (isset(auth()->user()->subscription) && auth()->user()->stripe_status != 'completed')
                                                        
                        <li class="nk-menu-item has-sub">
                            <a href="javascript:void(0)" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb"></em></span>
                                <span class="nk-menu-text">Parking Space</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route('host.space.create') }}" class="nk-menu-link clickable"><span class="nk-menu-text">Add New </span></a>
                                </li>                               
                                <li class="nk-menu-item">
                                    <a href="{{ route('host.space.index') }}" class="nk-menu-link clickable"><span class="nk-menu-text">List All </span></a>
                                </li>                               
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item -->  
                        <li class="nk-menu-item">
                            <a href="{{ route('host.space.bookings.index') }}" class="nk-menu-link clickable">
                                <span class="nk-menu-icon"><em class="icon ni ni-calendar-booking-fill"></em></span>
                                <span class="nk-menu-text">Bookings</span>
                            </a>
                        </li><!-- .nk-menu-item -->                         
                        @endunless
                        
                        <li class="nk-menu-item">
                            <a href="{{ route('host.subscription.index') }}" class="nk-menu-link clickable">
                                <span class="nk-menu-icon"><em class="icon ni ni-calendar-check-fill"></em></span>
                                <span class="nk-menu-text">Subscription</span>
                            </a>
                        </li><!-- .nk-menu-item -->  
                    @endhost
                    @user()
                      <li class="nk-menu-item">
                            <a href="{{ route('user.space.bookings.index') }}" class="nk-menu-link clickable">
                                <span class="nk-menu-icon"><em class="icon ni ni-calendar-booking-fill"></em></span>
                                <span class="nk-menu-text">Bookings</span>
                            </a>
                        </li><!-- .nk-menu-item -->   
                    @enduser
                      @admin()
                      <li class="nk-menu-item">
                            <a href="{{ route('admin.dashboard.index') }}" class="nk-menu-link clickable">
                                <span class="nk-menu-icon"><em class="icon ni ni-dashboard-fill"></em></span>
                                <span class="nk-menu-text">Dashboard</span>
                            </a>
                        </li><!-- .nk-menu-item -->     
                        <li class="nk-menu-item has-sub">
                            <a href="javascript:void(0)" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-list-thumb-alt-fill"></em></span>
                                <span class="nk-menu-text">Users</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route('admin.get-admins') }}" class="nk-menu-link clickable"><span class="nk-menu-text">Admins </span></a>
                                </li>                               
                                <li class="nk-menu-item">
                                    <a href="{{ route('admin.get-hosts') }}" class="nk-menu-link clickable"><span class="nk-menu-text">Hosts </span></a>
                                </li>                               
                                <li class="nk-menu-item">
                                    <a href="{{ route('admin.get-customers') }}" class="nk-menu-link clickable"><span class="nk-menu-text">Customers </span></a>
                                </li>                               
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item -->  
  
                        <li class="nk-menu-item has-sub">
                            <a href="javascript:void(0)" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-list-index-fill"></em></span>
                                <span class="nk-menu-text">Spaces</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route('admin.spaces.index') }}" class="nk-menu-link clickable"><span class="nk-menu-text">Available</span></a>
                                </li>                               
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item -->                 
                        <li class="nk-menu-item">
                            <a href="{{ route('admin.categories.index') }}" class="nk-menu-link clickable">
                                <span class="nk-menu-icon"><em class="icon ni ni-list-thumb-alt-fill"></em></span>
                                <span class="nk-menu-text">Categories</span>
                            </a>
                        </li><!-- .nk-menu-item -->                    
                        <li class="nk-menu-item has-sub">
                            <a href="javascript:void(0)" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-list-thumb-alt-fill"></em></span>
                                <span class="nk-menu-text">Plans</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route('admin.plans.create') }}" class="nk-menu-link clickable"><span class="nk-menu-text">New </span></a>
                                </li>                               
                                <li class="nk-menu-item">
                                    <a href="{{ route('admin.plans.index') }}" class="nk-menu-link clickable"><span class="nk-menu-text">View </span></a>
                                </li>                               
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item -->      
                        <li class="nk-menu-item">
                            <a href="{{ route('admin.space.bookings.index') }}" class="nk-menu-link clickable">
                                <span class="nk-menu-icon"><em class="icon ni ni-calendar-booking-fill"></em></span>
                                <span class="nk-menu-text">Bookings</span>
                            </a>
                        </li><!-- .nk-menu-item --> 

                        <li class="nk-menu-item">
                            <a href="{{ route('admin.subscriptions.index') }}" class="nk-menu-link clickable">
                                <span class="nk-menu-icon"><em class="icon ni ni-calendar-check-fill"></em></span>
                                <span class="nk-menu-text">Subscriptions</span>
                            </a>
                        </li><!-- .nk-menu-item -->       
                        @endadmin    
                    </ul><!-- .nk-menu -->
                </div><!-- .nk-sidebar-menu -->
            </div><!-- .nk-sidebar-content -->
        </div><!-- .nk-sidebar-element -->
    </div>
    <!-- sidebar @e -->