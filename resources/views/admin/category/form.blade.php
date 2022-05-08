@extends('layouts.dashboard')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview mx-auto">
                    <div class="nk-block-head nk-block-head-lg wide-sm">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title fw-normal">Category</h2>
                            <nav>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url("/") }}">{{ env('APP_NAME') }}</a></li>
                                    <li class="breadcrumb-item active"><a href="">{{ getPageType() != 'GET'? 'Edit' : 'Add'}} Category</a></li>
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
                                {!! Form::model([], ['route' => ['admin.categories.store'], 'class' => 'form-validate',
                                'autocomplete' => 'off', 'files' => true, 'enctype' => 'multipart/form-data']) !!}
                                @method('post')
                                <div class="row g-gs">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="fv-full-name">Title *</label>
                                            <div class="form-control-wrap">
                                                {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Type title', 'required' => 'required' ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="fv-full-name">Description
                                                <small>(Optional)</small></label>
                                            <div class="form-control-wrap">
                                                {!! Form::textarea('description', null, ['class' => 'form-control',
                                                'placeholder' => 'Write category description!' ]) !!}
                                            </div>
                                        </div>
                                    </div>                                   
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="fv-full-name">Type *</label>
                                            <div class="form-control-wrap">
                                                {!! Form::select('type', array('space' => 'Space' , 'vehicle' => 'Vehicle'), null, ['class' =>
                                                'form-control', 'placeholder' => 'Select Type', 'required' => 'required']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="fv-full-name">Image </label>
                                            <div class="form-control-wrap">
                                                {!! Form::file('image',  ['class' => 'form-control border-0' ]) !!}
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
    });
</script>
@endpush