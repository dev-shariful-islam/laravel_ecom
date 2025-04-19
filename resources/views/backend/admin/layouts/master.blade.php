<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') {{ config('app.name', 'Laravel') }}</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="{{asset('admin/assets/img/kaiadmin/favicon.ico')}}"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
    <script src="{{asset('admin/assets/js/plugin/webfont/webfont.min.js')}}"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["{{asset('admin/assets/css/fonts.min.css')}}"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    {{-- <link rel="stylesheet" href="{{asset('admin/assets/css/plugins.min.css')}}" /> --}}
    <link rel="stylesheet" href="{{asset('admin/assets/css/kaiadmin.min.css')}}" />

    {{-- Custom Css  --}}
    <link rel="stylesheet" href="{{asset('admin/css/custom.css')}}">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
        @include('backend.admin.layouts.partials.sidebar')
      <!-- End Sidebar -->

      <div class="main-panel">
        {{-- Page Header  --}}
        @include('backend.admin.layouts.partials.header')

        {{-- Main Content  --}}
        <div class="container">
          <div class="page-inner">
            @yield('content')
          </div>
        </div>
         {{-- Main Content  --}}
        {{-- Footer  --}}
        @include('backend.admin.layouts.partials.footer')
        {{-- Footer  --}}
      </div>
    </div>
    <!--   Core JS Files   -->
    <script src="{{asset('admin/assets/js/core/jquery-3.7.1.min.js')}}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{asset('admin/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{asset('admin/assets/js/kaiadmin.min.js')}}"></script>
    <script src="{{asset('admin/js/custom.js')}}"></script>
  </body>
</html>
