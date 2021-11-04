<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PantryShop | Dashboard</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('plugins/admin/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ url('plugins/admin/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('plugins/admin/select2/css/select2.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ url('plugins/admin/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ url('plugins/admin/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('css/admin_css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ url('plugins/admin/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ url('plugins/admin/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ url('plugins/admin/summernote/summernote-bs4.min.css') }}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ url('plugins/admin/daterangepicker/daterangepicker.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ url('plugins/admin/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ url('plugins/admin/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ url('plugins/admin/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

  @include('layouts.admin_layout.admin_header')  

  @include('layouts.admin_layout.admin_sidebar')

  @yield('content')

  @include('layouts.admin_layout.admin_footer')

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ url('plugins/admin/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ url('plugins/admin/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ url('plugins/admin/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ url('plugins/admin/select2/js/select2.full.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ url('plugins/admin/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline 
<script src="{{ url('plugins/admin/sparklines/sparkline.js') }}"> -->
<!-- JQVMap -->
<script src="{{ url('plugins/admin/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ url('plugins/admin/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ url('plugins/admin/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ url('plugins/admin/moment/moment.min.js') }}"></script>
<script src="{{ url('plugins/admin/inputmask/jquery.inputmask.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ url('plugins/admin/moment/moment.min.js') }}"></script>
<script src="{{ url('plugins/admin/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ url('plugins/admin/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ url('plugins/admin/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ url('plugins/admin/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- Admin App -->
<script src="{{ url('js/admin_js/adminlte.js') }}"></script>
<!-- Admin User Define Script -->
<script src="{{ url('js/admin_js/admin_script.js') }}"></script>
<!-- Admin for demo purposes -->
<script src="{{ url('js/admin_js/demo.js') }}"></script>
<!-- Admin dashboard demo (This is only for demo purposes) -->
<script src="{{ url('js/admin_js/pages/dashboard.js') }}"></script>
<!-- Admin DataTables  & Plugins -->
<script src="{{ url('plugins/admin/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('plugins/admin/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('plugins/admin/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('plugins/admin/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ url('plugins/admin/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('plugins/admin/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ url('plugins/admin/jszip/jszip.min.js') }}"></script>
<script src="{{ url('plugins/admin/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ url('plugins/admin/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ url('plugins/admin/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ url('plugins/admin/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ url('plugins/admin/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!--- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<!-- AdminTable -->
<script>
  $(function () {
    $("#dataTable").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#dataTable_wrapper .col-md-6:eq(0)');
  });
</script>
<!-- Advance Form -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
</body>
</html>
