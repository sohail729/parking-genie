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

@if(Session::has('alert-danger'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>{{ Session::get('alert-danger') }}</strong>
</div>
@endif
