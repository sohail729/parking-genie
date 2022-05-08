<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Parking Genie</title>
      <link rel="shortcut icon" href="{{ asset('assets/front/img/logo-main.png') }}" />
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
      <link
      href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css"
      rel="stylesheet"
    />
          <link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}">
      @host
      <link rel="stylesheet" href="{{ asset('assets/front/css/admin-style.css') }}">
      @endhost
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link
         href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500&family=Poppins:wght@300;400;500;700;800&display=swap"
         rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
      @stack('styles')

   </head>
   <body>
      <!-- Start Navbar ffff -->
      @include('front.partials.header')
      <!-- End Navbar -->
      @yield('content')

         <!-- Login Modal @s -->
         @include('front.partials.modal.login-modal')
         <!-- Login Modal @e -->

          <!-- Reset Modal @s -->
          @include('front.partials.modal.reset')
          <!-- Reset Modal @e -->
         
      <!-- Start Footer -->
      @include('front.partials.footer')
      <!-- End Footer -->
      </div>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://use.fontawesome.com/338ef58d21.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>
      <script src="{{ asset('assets/front/js/validate.js') }}"></script>
      <script src="{{ asset('assets/front/js/script.js') }}"></script>    
      @stack('scripts')
   </body>
</html>