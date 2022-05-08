@extends('layouts.dashboard')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview mx-auto">
                    <div class="nk-block-head nk-block-head-lg wide-sm">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title fw-normal">User</h2>
                            <nav>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url("/") }}">{{ env('APP_NAME') }}</a></li>
                                    <li class="breadcrumb-item active"><a href="">{{ getPageType() != 'GET'? 'Edit' : 'Add'}} User</a></li>
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
                                {!! Form::model($user, ['route' => ['admin.users.update', $user->id], 'class' => 'form-validate',
                                'autocomplete' => 'off']) !!}
                                @method('put')
                                <div class="row g-gs">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="fv-full-name">Full Name </label>
                                            <div class="form-control-wrap">
                                                {!! Form::text('fname', null, ['class' => 'form-control', 'placeholder' => 'Enter First Name' ]) !!}
                                            </div>
                                        </div>
                                    </div>                                  
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="fv-full-name">Full Name </label>
                                            <div class="form-control-wrap">
                                                {!! Form::text('lname', null, ['class' => 'form-control', 'placeholder' => 'Enter Last Name' ]) !!}
                                            </div>
                                        </div>
                                    </div>                                  
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="fv-full-name">Email </label>
                                            <div class="form-control-wrap">
                                                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Email' ]) !!}
                                            </div>
                                        </div>
                                    </div>                                  
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="fv-full-name">Municipality/City </label>
                                            <div class="form-control-wrap">
                                                {!! Form::text('municipality', null, ['class' => 'form-control', 'placeholder' => 'Enter Municipality' ]) !!}
                                            </div>
                                        </div>
                                    </div>                                  
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="fv-full-name">Country </label>
                                            <div class="form-control-wrap">
                                                {!! Form::select('country', $countries ,null, ['class' => 'form-control', 'placeholder' => 'Select Country' ]) !!}
                                            </div>
                                        </div>
                                    </div>                                  
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="form-label" for="fv-full-name">Address </label>
                                            <div class="form-control-wrap">
                                                {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Enter Address' ]) !!}
                                            </div>
                                        </div>
                                    </div>                                  
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="fv-full-name">Date of Birth </label>
                                            <div class="form-control-wrap">
                                                {!! Form::text('date_of_birth', null, ['class' => 'form-control', 'placeholder' => 'Enter Date of Birth' ]) !!}
                                            </div>
                                        </div>
                                    </div>                                  
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="fv-full-name">Postal/ZIP Code </label>
                                            <div class="form-control-wrap">
                                                {!! Form::text('postal', null, ['class' => 'form-control', 'placeholder' => 'Enter Postal Code' ]) !!}
                                            </div>
                                        </div>
                                    </div>                                  
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="fv-full-name">Status </label>
                                            <div class="form-control-wrap">
                                                {!! Form::select('status', array('1' => 'Active', '0' => 'Inactive',) , null, ['class' => 'select2 form-control', 'placeholder' => 'Select Status' ]) !!}
                                            </div>
                                        </div>
                                    </div>                                 
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {!! Form::button('<em class="icon ni ni-save"></em>', ['type' => 'submit',
                                            'class' => 'btn btn-success']) !!}
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
<script type="text/javascript">
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: function () {
                $(this).data('placeholder');
            },
        });
        $(".select2 option[value='']").remove();                                                
    });
</script>
@endpush