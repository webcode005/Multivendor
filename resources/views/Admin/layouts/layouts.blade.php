<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ url('backend/assets')}}/"
  data-template="vertical-menu-template"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@if(isset($title)) {{ $title }} @else {{ config('app.name', 'ShoppingWheel') }} @endif</title>
    
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ url('backend/assets/img/favicon/favicon.ico')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ url('backend/assets/vendor/fonts/boxicons.css')}}" />
    <link rel="stylesheet" href="{{ url('backend/assets/vendor/fonts/fontawesome.css')}}" />
    <link rel="stylesheet" href="{{ url('backend/assets/vendor/fonts/flag-icons.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ url('backend/assets/vendor/css/rtl/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ url('backend/assets/vendor/css/rtl/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ url('backend/assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ url('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{ url('backend/assets/vendor/libs/typeahead-js/typeahead.css')}}" />
    <link rel="stylesheet" href="{{ url('backend/assets/vendor/libs/apex-charts/apex-charts.css')}}" />
    <link rel="stylesheet" href="{{ url('backend/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}" />
    <link rel="stylesheet" href="{{ url('backend/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}" />
    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ url('backend/assets/vendor/css/pages/card-analytics.css')}}" />
    
    
    <link rel="stylesheet" href="{{ url('backend/assets/vendor/libs/animate-css/animate.css')}}" />
    <link rel="stylesheet" href="{{ url('backend/assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />

    

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    
    
    {{-- CKEditor CDN --}}
<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>



    <!-- Helpers -->
    <script src="{{ url('backend/assets/vendor/js/helpers.js')}}"></script>

    
    <script src="{{ url('backend/assets/vendor/js/template-customizer.js')}}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ url('backend/assets/js/config.js')}}"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
@include('Admin.layouts.sidebar')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          @include('Admin.layouts.header')

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            @yield('content')
            
            <!-- / Content -->

            <!-- Footer -->
           @include('Admin.layouts.footer')
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    
    <script src="{{ url('backend/assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{ url('backend/assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{ url('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{ url('backend/assets/vendor/libs/hammer/hammer.js')}}"></script>
    <script src="{{ url('backend/assets/vendor/libs/i18n/i18n.js')}}"></script>
    <script src="{{ url('backend/assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>

    <script src="{{ url('backend/assets/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ url('backend/assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

    <!-- Main JS -->
    <script src="{{ url('backend/assets/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{ url('backend/assets/js/dashboards-ecommerce.js')}}"></script>

    <!-- Vendors JS -->
    <script src="{{ url('backend/assets/vendor/libs/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{ url('backend/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
    <script src="{{ url('backend/assets/vendor/libs/datatables-responsive/datatables.responsive.js')}}"></script>
    <script src="{{ url('backend/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js')}}"></script>
    
    <!-- Flat Picker -->
    <script src="{{ url('backend/assets/vendor/libs/moment/moment.js')}}"></script>
    <script src="{{ url('backend/assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>

    <!-- Main JS -->
    <script src="{{ url('backend/assets/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{ url('backend/assets/js/tables-datatables-advanced.js')}}"></script>
  
     <!-- Admin Update PASSWORD -->
    <script src="{{url('backend/assets/js/custom.js')}}"></script>

    <script src="{{url('backend/assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
   
    <script src="{{url('backend/assets/js/main.js')}}"></script>

    <script src="{{url('backend/assets/js/extended-ui-sweetalert2.js')}}"></script>
  
<script>
    ClassicEditor
    .create( document.querySelector( '#description' ) )
    .catch( error => {
    console.error( error );
    } );
</script>

  </body>
</html>
