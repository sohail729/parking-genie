@if($errors->any())
<div class="alert alert-pro alert-danger">
    <div class="alert-text">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

@if(Session::has('alert-success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert"></button>
    <strong>{{ Session::get('alert-success') }}</strong>
</div>
@endif

@if(Session::has('alert-danger'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert"></button>
    <strong>{{ Session::get('alert-danger') }}</strong>
</div>
@endif
@if(Session::has('alert-warning'))
<div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert"></button>
    <strong>{{ Session::get('alert-warning') }}</strong>
</div>
@endif