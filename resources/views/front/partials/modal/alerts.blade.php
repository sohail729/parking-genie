@if(Session::has('modal-alert-success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>{{ Session::get('modal-alert-success') }}</strong>
</div>
@endif

@if(Session::has('modal-alert-danger'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>{{ Session::get('modal-alert-danger') }}</strong>
</div>
@endif

@if(Session::has('reset-error'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>{{ Session::get('reset-error') }}</strong>
</div>
@endif