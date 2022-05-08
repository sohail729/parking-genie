@extends('layouts.dashboard')
@push('styles')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.min.css" />
@endpush
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview mx-auto">
                    <div class="nk-block-head nk-block-head-lg wide-sm">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title fw-normal">Profile</h2>
                            <nav>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('host.dashboard.index') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ getPageType() != 'GET'? 'Edit' : 'Add'}} Profile</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div><!-- .nk-block-head -->

                    <!-- main alert @s -->
                    @include('dashboard.partials.alerts')
                    <!-- main alert @e -->

                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered">
                            <div class="card-inner">
                            {!! Form::model($user, ['route' => ['host.profile.update'], 'class' => 'form-validate',
                'autocomplete' => 'off']) !!}
                @method('put')
                <div class="row g-gs">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="fv-full-name">Full Name <span class="text-danger">*</span></label>
                            <div class="form-control-wrap">
                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Name' ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="fv-full-name">Email <span class="text-danger">*</span></label>
                            <div class="form-control-wrap">
                                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Email' ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label" for="fv-full-name">Municipality/City <span class="text-danger">*</span></label>
                            <div class="form-control-wrap">
                                {!! Form::text('municipality', null, ['class' => 'form-control', 'placeholder' => 'Enter Municipality' ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label" for="fv-full-name">Country <span class="text-danger">*</span></label>
                            <div class="form-control-wrap">
                                {!! Form::select('country', $countries ,null, ['class' => 'select2 form-control', 'placeholder' => 'Select Country' ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label" for="fv-full-name">Postal/ZIP Code <span class="text-danger">*</span></label>
                            <div class="form-control-wrap">
                                {!! Form::text('postal', null, ['class' => 'form-control', 'placeholder' => 'Enter Postal Code' ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="fv-full-name">Date of Birth </label>
                            <div class="form-control-wrap">
                                {!! Form::text('date_of_birth', null, ['class' => 'form-control datepicker', 'placeholder' => 'Enter Date of Birth']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="fv-full-name">Address <span class="text-danger">*</span></label>
                            <div class="form-control-wrap">
                                {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Enter Address' ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="fv-full-name">Password <span class="text-danger">*</span></label>
                            <div class="form-control-wrap">
                                {!! Form::text('pass', null, ['class' => 'form-control', 'placeholder' => 'Enter Password']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="fv-full-name">Confirm Password <span class="text-danger">*</span></label>
                            <div class="form-control-wrap">
                                {!! Form::text('password-conf', null, ['class' => 'form-control', 'placeholder' => 'Confirm Password' ]) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::button('Save', ['type' => 'submit',
                            'class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
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
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: function() {
                $(this).data('placeholder');
            },
        });

        
        $(".datepicker").datepicker({
            dateFormat: "d M, yy",
            changeMonth: true,
            changeYear: true,
            yearRange: '1930:+0',
          });

    });

    @if(Session::has('toastr.error'))
        toastr.options =   {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
        }
        toastr.error("{{ session('toastr.error') }}");
    @endif
    
    @if(Session::has('toastr.success'))
      toastr.options =  {
         "closeButton": true,
         "progressBar": true,
         "positionClass": "toast-top-right",
        }
  		toastr.success("{{ session('toastr.success') }}");
    @endif
</script>
@endpush