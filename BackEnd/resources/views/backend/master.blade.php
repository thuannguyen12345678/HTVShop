<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Pluto - Responsive Bootstrap Admin Panel Templates</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">

      <!-- site icon -->
      <link rel="icon" href="{{asset('themeAdmin/images/fevicon.png')}}" type="image/png" />
      <!-- bootstrap css -->
      <link rel="stylesheet" href="{{asset('themeAdmin/css/bootstrap.min.css')}}" />
      <!-- site css -->
      <link rel="stylesheet" href="{{asset('themeAdmin/style.css')}}" />
      <!-- responsive css -->
      <link rel="stylesheet" href="{{asset('themeAdmin/css/responsive.css')}}" />
      <!-- color css -->
      <link rel="stylesheet" href="{{asset('themeAdmin/css/colors.css')}}" />
      <!-- select bootstrap -->
      <link rel="stylesheet" href="{{asset('themeAdmin/css/bootstrap-select.css')}}" />
      <!-- scrollbar css -->
      <link rel="stylesheet" href="{{asset('themeAdmin/css/perfect-scrollbar.css')}}" />
      <!-- custom css -->
      <link rel="stylesheet" href="{{asset('themeAdmin/css/custom.css')}}" />
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
   </head>
   <body class="dashboard dashboard_1">
      <div class="full_container">
         <div class="inner_container">
            <!-- Sidebar  -->
            @include('backend.layouts.sidebar')
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
               <!-- topbar -->
                @include('backend.layouts.header')
               <!-- end topbar -->
               <!-- dashboard inner -->
                   @yield('content')
                   {{-- @include('backend.layouts.content') --}}
                   {{-- @include('backend.layouts.form') --}}
               <!-- end dashboard inner -->
            </div>
         </div>
      </div>
      <!-- jQuery -->
      <script src="{{asset('themeAdmin/js/jquery.min.js')}}"></script>
      <script src="{{asset('themeAdmin/js/popper.min.js')}}"></script>
      <script src="{{asset('themeAdmin/js/bootstrap.min.js')}}"></script>
      <!-- wow animation -->
      <script src="{{asset('themeAdmin/js/animate.js')}}"></script>
      <!-- select country -->
      <script src="{{asset('themeAdmin/js/bootstrap-select.js')}}"></script>
      <!-- owl carousel -->
      <script src="{{asset('themeAdmin/js/owl.carousel.js')}}"></script>
      <!-- chart js -->
      <script src="{{asset('themeAdmin/js/Chart.min.js')}}"></script>
      <script src="{{asset('themeAdmin/js/Chart.bundle.min.js')}}"></script>
      <script src="{{asset('themeAdmin/js/utils.js')}}"></script>
      <script src="{{asset('themeAdmin/js/analyser.js')}}"></script>
      <!-- nice scrollbar -->
      <script src="{{asset('themeAdmin/js/perfect-scrollbar.min.js')}}"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <!-- custom js -->
      <script src="{{asset('themeAdmin/js/custom.js')}}"></script>
      <script src="{{asset('themeAdmin/js/chart_custom_style1.js')}}"></script>
   </body>
</html>
