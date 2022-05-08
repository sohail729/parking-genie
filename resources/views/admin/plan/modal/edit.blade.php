{!! Form::model($plan, ['route' => ['admin.plans.update', $plan->id ?? null], 'class' =>
'form-validate','autocomplete' => 'off',  'files' => true, 'enctype' => 'multipart/form-data']) !!}
@method('put')
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
          <label class="form-label" for="fv-full-name">Period</label>
          <div class="form-control-wrap">
             {!! Form::text('period', null, ['class' => 'form-control', 'placeholder' => 'E.g  monthly (empty for lifetime)' ]) !!}
          </div>
      </div>
  </div>                                   
  <div class="col-md-6">
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
  <div class="col-md-8">
      <div class="form-group">
          <label class="form-label" for="fv-full-name">Stripe Price ID *</label>
          <div class="form-control-wrap">
             {!! Form::text('stripe_price_id', null, ['class' => 'form-control', 'placeholder' => 'E.g price_1KhFNeFXS6lUqYoRoVwtF5iE', 'required' => 'required' ]) !!}
          </div>
      </div>
  </div>

  <div class="col-md-4">
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
          @if (isset($plan->image) && !empty($plan->image))              
            <img class="img-thumbnail mt-2" src="{{ asset('plans/'.$plan->image) }}" alt="">
          @endif
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