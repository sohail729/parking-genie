@extends('layouts.dashboard')

@section('content')
<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-aside-wrap">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head nk-block-head-lg">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h4 class="nk-block-title">Personal Information</h4>
                                            <div class="nk-block-des">
                                                <p>Basic information of Administrator profile</p>
                                            </div>
                                        </div>
                                        <div class="nk-block-head-content align-self-start d-lg-none">
                                            <a href="#" class="toggle btn btn-icon btn-trigger mt-n1"
                                                data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head -->
                                <!-- main alert @s -->
                                @include('dashboard.partials.alerts')
                                <!-- main alert @e -->
                                <div class="nk-block">
                                    <div class="nk-data data-list">
                                        <div class="data-head">
                                            <h6 class="overline-title">Basics</h6>
                                        </div>
                                        <div class="data-item" >
                                            <div class="data-col">
                                                <span class="data-label">Display Name</span>
                                                <span class="data-value">{{ ucwords($user->fname) }} {{ ucwords($user->lname) }}</span>
                                            </div>
                                            <div class="data-col data-col-end"></div>
                                        </div><!-- data-item -->
                                        <div class="data-item">
                                            <div class="data-col">
                                                <span class="data-label">Email</span>
                                                <span class="data-value">{{ $user->email }}</span>
                                            </div>
                                            <div class="data-col data-col-end"></div>
                                        </div><!-- data-item -->
                                        <div class="data-item" >
                                            <div class="data-col">
                                                <span class="data-label">Date of Birth</span>
                                                <span class="data-value">{{ getFormattedDate($user->date_of_birth, 'dS
                                                    M, Y') }}</span>
                                            </div>
                                            <div class="data-col data-col-end"></div>
                                        </div><!-- data-item -->
                                    </div>
                                </div><!-- .nk-block -->
                            </div>
                            <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg"
                                data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                                <div class="card-inner-group" data-simplebar>
                                    <div class="card-inner">
                                        <div class="user-card">
                                            <div class="user-avatar bg-primary">
                                                <span>{{ getNameInitials($user) }}</span>
                                            </div>
                                            <div class="user-info">
                                                <span class="lead-text">{{ ucwords( $user->fname) }} {{ ucwords( $user->lname) }}</span>
                                                <span class="sub-text">{{ $user->email }}</span>
                                            </div>
                                            <div class="user-action">
                                                <div class="dropdown">
                                                    <a class="btn btn-icon btn-trigger mr-n2" data-toggle="dropdown"
                                                        href="#"><em class="icon ni ni-more-v"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="link-list-opt no-bdr">
                                                            @admin
                                                            <li><a href="{{ route('admin.profile.edit') }}"><em class="icon ni ni-edit-fill"></em><span>Update  Profile</span></a></li>
                                                            @endadmin
                                                            @user
                                                            <li><a href="{{ route('user.profile.edit') }}"><em class="icon ni ni-edit-fill"></em><span>Update  Profile</span></a></li>
                                                            @enduser
                                                            @host
                                                            <li><a href="{{ route('host.profile.edit') }}"><em class="icon ni ni-edit-fill"></em><span>Update  Profile</span></a></li>
                                                            @endhost
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .user-card -->
                                    </div>
                                    <div class="card-inner p-0">
                                        <ul class="link-list-menu">
                                            <li><a class="active" href="javascript:void(0)"><em
                                                        class="icon ni ni-user-fill-c"></em><span>Personal
                                                        Infomation</span></a></li>
                                            <li><a href="{{ route('user.showChangePassword') }}"><em
                                                        class="icon ni ni-lock-alt-fill"></em><span>Change Password</span></a></li> 
                                            {{-- <li><a href="html/user-profile-notification.html"><em
                                                        class="icon ni ni-bell-fill"></em><span>Notifications</span></a>
                                            </li> --}}
                                            {{-- <li><a href="html/user-profile-activity.html"><em
                                                        class="icon ni ni-activity-round-fill"></em><span>Account
                                                        Activity</span></a></li> --}}
                                            {{-- <li><a href="html/user-profile-setting.html"><em
                                                        class="icon ni ni-lock-alt-fill"></em><span>Security
                                                        Settings</span></a></li> --}}
                                            {{-- <li><a href="html/user-profile-social.html"><em
                                                        class="icon ni ni-grid-add-fill-c"></em><span>Connected with
                                                        Social</span></a></li> --}}
                                        </ul>
                                    </div><!-- .card-inner -->
                                </div><!-- .card-inner-group -->
                            </div><!-- card-aside -->
                        </div><!-- .card-aside-wrap -->
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
<!-- content @e -->
@endsection