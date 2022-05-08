@extends('layouts.front')

@section('content')
<section class="section_inner signup_section">
  <div class="container">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="px-0 pt-4 pb-0 mt-3 mb-3">
            <h2>Congrats!</h2><hr>
            <p>You will be notified when our team approves your account.</p>
            <p>Meanwhile, setup your bank account details to stripe for secure transactions.</p>
            <p>We have also sent you the configuration link via email.</p>
            <a href="{{ $stripeLink }}" target="_blank" class="btn btn-primary">Setup Account <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection