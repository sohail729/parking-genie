@extends('layouts.dashboard')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview mx-auto">
                    <div class="nk-block-head nk-block-head-lg wide-sm">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title fw-normal">Plan</h2>
                            <nav>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url("/") }}">{{ env('APP_NAME') }}</a></li>
                                    <li class="breadcrumb-item active"><a href="">{{ getPageType() != 'GET'? 'Edit' : 'Add'}} Plan</a></li>
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
                                {!! Form::model([], ['route' => ['admin.plans.store'], 'class' =>
                                'form-validate','autocomplete' => 'off', 'files' => true, 'enctype' => 'multipart/form-data']) !!}
                                @method('post')
                                <div class="row g-gs">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label class="form-label" for="fv-full-name">Title *</label>
                                          <div class="form-control-wrap">
                                              {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'E.g Super Host', 'required' => 'required' ]) !!}
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label class="form-label" for="fv-full-name">Description/Sub Title *</label>
                                          <div class="form-control-wrap">
                                              {!! Form::text('sub', null, ['class' => 'form-control', 'placeholder' => 'E.g up to 5 spaces', 'required' => 'required' ]) !!}
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label class="form-label" for="fv-full-name">Period</label>
                                          <div class="form-control-wrap">
                                             {!! Form::text('period', null, ['class' => 'form-control', 'placeholder' => 'E.g  monthly (empty for lifetime)']) !!}
                                          </div>
                                      </div>
                                  </div>                                   
                                  <div class="col-md-5">
                                      <div class="form-group">
                                          <label class="form-label" for="fv-full-name">Type *</label>
                                          <div class="form-control-wrap">
                                             {!! Form::text('type', null, ['class' => 'form-control', 'placeholder' => 'E.g commercial', 'required' => 'required' ]) !!}
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label class="form-label" for="fv-full-name">Stripe Product ID *</label>
                                          <div class="form-control-wrap">
                                             {!! Form::text('stripe_prod_id', null, ['class' => 'form-control', 'placeholder' => 'E.g prod_LO1QnGdV0hb9d1', 'required' => 'required' ]) !!}
                                          </div>
                                      </div>
                                  </div>

                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label class="form-label" for="fv-full-name">Stripe Price ID *</label>
                                          <div class="form-control-wrap">
                                             {!! Form::text('stripe_price_id', null, ['class' => 'form-control', 'placeholder' => 'E.g price_1KhFNeFXS6lUqYoRoVwtF5iE', 'required' => 'required' ]) !!}
                                          </div>
                                      </div>
                                  </div>
                                
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label class="form-label" for="fv-full-name">Amount <small>(USD)</small> *</label>
                                          <div class="form-control-wrap">
                                             {!! Form::text('amount', null, ['class' => 'form-control', 'placeholder' => 'E.g 4.99 (0 for free)', 'required' => 'required' ]) !!}
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label class="form-label" for="fv-full-name">Image</label>
                                          <div class="form-control-wrap">
                                              {!! Form::file('image',  ['class' => 'form-control border-0']) !!}                                              
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
        $("input[name='image']").change(function() {
          readURL(this);
        });
    });
    
    function readURL(input) {
        if (input.files && input.files[0]) {
            $(input).closest('div').find('img').remove()
            $(input).closest('div').append('<img id="preview" class="img-thumbnail" width="200px" height="200px"/>')
            var reader = new FileReader();
            reader.onload = function(e) {
            $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        } 
    }
</script>
@endpush