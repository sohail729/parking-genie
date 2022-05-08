@if (isset($category))
{!! Form::model($category, ['route' => ['admin.categories.update', $category->id], 'class' =>
'form-validate','autocomplete' => 'off']) !!}
@method('put')
@else
{!! Form::model(null, ['route' => ['admin.categories.store'], 'class' =>
'form-validate','autocomplete' => 'off']) !!}
@method('post')    
@endif
<div class="row g-gs">
  <div class="col-md-6">
      <div class="form-group">
          <label class="form-label" for="fv-full-name">Title *</label>
          <div class="form-control-wrap">
              {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Type title', 'required' => 'required' ]) !!}
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

  <div class="col-md-12">
      <div class="form-group">
          {!! Form::button('<em class="icon ni ni-save"></em>', ['type' => 'submit',
          'class' => 'btn btn-success']) !!}
      </div>
  </div>
</div>
{!! Form::close() !!}