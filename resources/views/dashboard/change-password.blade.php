@extends('layouts.dashboard')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview mx-auto">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h2 class="nk-block-title fw-normal">Change Password</h2>
                            <nav>
                                <nav>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ url("/") }}">{{ env('APP_NAME') }}</a></li>
                                        <li class="breadcrumb-item active"><a href="">Change Password</a></li>
                                    </ul>
                                </nav>
                            </nav>      
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <ul class="nk-block-tools g-3">                                            
                                    <li class="nk-block-tools-opt"><a href="{{ url()->previous() }}" class="btn btn-primary"><em class="icon ni ni-arrow-left"></em><span>Go Back</span></a></li>
                                </ul>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div>   

                    <!-- main alert @s -->
                    @include('dashboard.partials.alerts')
                    <!-- main alert @e -->

                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <form class="form-validate form-horizontal" method="POST"
                                    action="{{ route('user.changePassword') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="new-password" class="col-md-4 control-label">Current
                                            Password</label>
                                        <div class="col-md-6">
                                            <input id="current-password" type="password" class="form-control"
                                                name="current-password" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="new-password" class="col-md-4 control-label">New Password</label>

                                        <div class="col-md-6">
                                            <input id="new-password" type="password" class="form-control"
                                                name="new-password" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="new-password-confirm" class="col-md-4 control-label">Confirm New
                                            Password</label>

                                        <div class="col-md-6">
                                            <input id="new-password-confirm" type="password" class="form-control"
                                                name="new-password_confirmation" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                Change Password
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- .nk-block -->
                </div><!-- .components-preview -->
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
@endpush