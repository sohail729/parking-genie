<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('assets/front/img/logo-main.png') }}" />
    <!-- Page Title  -->
    <title>Parking Genie | {{ ucwords(auth()->user()->role->name) }} Dashboard</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/dashlite.css?ver=2.9.0') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/admin/css/theme.css?ver=2.9.0') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @host
      <link rel="stylesheet" href="{{ asset('assets/front/css/admin-style.css') }}">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

      <link rel="stylesheet" href="{{ asset('assets/front/css/user.css?ver=2.9.0') }}">
      @endhost
    @stack('styles')

    {{-- Loader Css --}}
    <style>
     .loader-overlay{background:rgba(0,0,0,.7);position:absolute;top:0;bottom:0;left:0;right:0;z-index:9999}.loader{position:fixed;top:50%;left:50%}.car__body{-webkit-animation:shake 0.2s ease-in-out infinite alternate;animation:shake 0.2s ease-in-out infinite alternate}.car__line{transform-origin:center right;stroke-dasharray:22;-webkit-animation:line 0.8s ease-in-out infinite;animation:line 0.8s ease-in-out infinite;-webkit-animation-fill-mode:both;animation-fill-mode:both}.car__line--top{-webkit-animation-delay:0s;animation-delay:0s}.car__line--middle{-webkit-animation-delay:0.2s;animation-delay:0.2s}.car__line--bottom{-webkit-animation-delay:0.4s;animation-delay:0.4s}@-webkit-keyframes shake{0%{transform:translateY(-1%)}100%{transform:translateY(3%)}}@keyframes shake{0%{transform:translateY(-1%)}100%{transform:translateY(3%)}}@-webkit-keyframes line{0%{stroke-dashoffset:22}25%{stroke-dashoffset:22}50%{stroke-dashoffset:0}51%{stroke-dashoffset:0}80%{stroke-dashoffset:-22}100%{stroke-dashoffset:-22}}@keyframes line{0%{stroke-dashoffset:22}25%{stroke-dashoffset:22}50%{stroke-dashoffset:0}51%{stroke-dashoffset:0}80%{stroke-dashoffset:-22}100%{stroke-dashoffset:-22}}
    </style>
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
        <div class="loader-overlay d-none">
            <div class="loader">
                <svg class="car" width="102" height="40" xmlns="http://www.w3.org/2000/svg"> <g transform="translate(2 1)" stroke="#ffffff" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"> <path class="car__body" d="M47.293 2.375C52.927.792 54.017.805 54.017.805c2.613-.445 6.838-.337 9.42.237l8.381 1.863c2.59.576 6.164 2.606 7.98 4.531l6.348 6.732 6.245 1.877c3.098.508 5.609 3.431 5.609 6.507v4.206c0 .29-2.536 4.189-5.687 4.189H36.808c-2.655 0-4.34-2.1-3.688-4.67 0 0 3.71-19.944 14.173-23.902zM36.5 15.5h54.01" stroke-width="3"/> <ellipse class="car__wheel--left" stroke-width="3.2" fill="#FFF" cx="83.493" cy="30.25" rx="6.922" ry="6.808"/> <ellipse class="car__wheel--right" stroke-width="3.2" fill="#FFF" cx="46.511" cy="30.25" rx="6.922" ry="6.808"/> <path class="car__line car__line--top" d="M22.5 16.5H2.475" stroke-width="3"/> <path class="car__line car__line--middle" d="M20.5 23.5H.4755" stroke-width="3"/> <path class="car__line car__line--bottom" d="M25.5 9.5h-19" stroke-width="3"/> </g> </svg>     
            </div>
        </div>
            <!-- sidebar @s -->
            @include('dashboard.partials.sidebar')
            <!-- sidebar @e -->

            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- Start Navbar ffff -->
                @include('dashboard.partials.header')
                <!-- End Navbar -->
                @yield('content')
                <!-- Start Footer -->
                @include('dashboard.partials.footer')
                <!-- End Footer -->

            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="{{ asset('assets/admin/js/bundle.js?ver=2.9.0') }}"></script>
    <script src="{{ asset('assets/admin/js/scripts.js?ver=2.9.0') }}"></script>
    <script src="{{ asset('assets/admin/js/charts/gd-default.js?ver=2.9.0') }}"></script>
    <script src="{{ asset('assets/admin/js/main.js?ver=2.9.0') }}"></script>
    <script src="{{ asset('assets/admin/js/libs/datatable-btns.js?ver=2.9.0') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    @host()
    <script src="{{ asset('assets/front/js/validate.js') }}"></script>
    <script src="{{ asset('assets/front/js/script.js') }}"></script>    
    @endhost
    @stack('scripts')
    {!! Toastr::message() !!}
</body>

</html>