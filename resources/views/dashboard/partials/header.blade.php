<!-- main header @s -->
<div class="nk-header nk-header-fixed is-light">
    <div class="container-fluid">
        <div class="nk-header-wrap">
            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <div class="user-toggle">
                                <div class="user-avatar">
                                    {{ getNameInitials(auth()->user()) }}
                                </div>
                                {{-- <div class="user-info d-none d-md-block">
                                    <div class="user-status">{{ ucwords( auth()->user()->role->name ) }}</div>
                                    <div class="user-name dropdown-indicator">{{ auth()->user()->fname }} {{ auth()->user()->lname }}</div>
                                </div> --}}
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-s1">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    <div class="user-avatar">
                                        <span>{{ getNameInitials(auth()->user()) }}</span>
                                    </div>
                                    <div class="user-info">
                                        <span class="lead-text">{{ auth()->user()->fname }} {{ auth()->user()->lname }}</span>
                                        <span class="sub-text">{{ auth()->user()->email }}</span>
                                    </div>
                                </div>
                            </div>
                            @user
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                <li><a href="{{ route('front.find-space') }}"><em class="icon ni ni-home-alt"></em><span>Go to website</span></a>
                                    </li>
                                    
                                </ul>
                            </div>
                            @else
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                <li><a href="{{ route('front.home') }}"><em class="icon ni ni-home-alt"></em><span>Go to website</span></a>
                                    </li>
                                    
                                </ul>
                            </div>
                            @enduser
                        
                            @admin
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li><a href="{{ route('admin.profile.show') }}"><em class="icon ni ni-account-setting-alt"></em><span>Settings</span></a>
                                    </li>
                                </ul>
                            </div>
                            @endadmin
                            @user
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li><a href="{{ route('user.profile.show') }}"><em class="icon ni ni-account-setting-alt"></em><span>Settings</span></a>
                                    </li>
                                </ul>
                            </div>
                            @enduser
                            @host
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li><a href="{{ route('host.profile.show') }}"><em class="icon ni ni-account-setting-alt"></em><span>Settings</span></a>
                                    </li>
                                </ul>
                            </div>
                            @endhost
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit()"><em
                                                class="icon ni ni-signout"></em><span>Logout</span>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </li>
                </ul><!-- .nk-quick-nav -->
            </div><!-- .nk-header-tools -->
        </div><!-- .nk-header-wrap -->
    </div><!-- .container-fliud -->
</div>
<!-- main header @e -->