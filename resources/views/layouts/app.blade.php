<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ !empty($header_title) ? $header_title : ''}}</title>
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link rel="stylesheet" href="https://cdn.datatables.net/v/bs4/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/r-2.2.7/datatables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href=" {{ asset('plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css')}}">

  @yield('style')
</head>
<body class="hold-transition sidebar-mini layout-fixed" id="nij" >

<div class="wrapper" >

  @include('layouts.header')
<div class="content">
  @yield('content')
</div>

</div>

<script src="{!! URL::asset('plugins/jquery/jquery.min.js')!!}"></script>
<script src="{!! URL::asset ('plugins/jquery-ui/jquery-ui.min.js')!!}"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="{!! URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js')!!}"></script>
<script src="{!! URL::asset('plugins/chart.js/Chart.min.js')!!}"></script>
<script src="{!! URL::asset('plugins/sparklines/sparkline.js')!!}"></script>
<script src="{!! URL::asset('plugins/jqvmap/jquery.vmap.min.js')!!}"></script>
<script src="{!! URL::asset('plugins/jqvmap/maps/jquery.vmap.usa.js')!!}"></script>
<script src="{!! URL::asset('plugins/jquery-knob/jquery.knob.min.js')!!}"></script>
<script src="{!! URL::asset('plugins/moment/moment.min.js')!!}"></script>
<script src="{!! URL::asset('plugins/daterangepicker/daterangepicker.js')!!}"></script>
<script src="{!! URL::asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')!!}"></script>
<script src="{!! URL::asset('plugins/summernote/summernote-bs4.min.js')!!}"></script>
<script src="{!! URL::asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')!!}"></script>
<script src="{!! URL::asset('dist/js/adminlte.js')!!}"></script>
{{--<script src="{!! URL::asset('dist/js/demo.js')!!}"></script>
<script src="{!! URL::asset('dist/js/pages/dashboard.js')!!}"></script>
<script src="{!! URL::asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js') !!}"></script>
<script src="{!! URL::asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js') !!}"></script>
<script src="{!! URL::asset('https://cdn.datatables.net/v/bs4/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/r-2.2.7/datatables.min.js') !!}"></script>
<script src="{!! URL::asset('https://cdn.jsdelivr.net/npm/sweetalert2@11.0.12/dist/sweetalert2.all.min.js') !!}"></script>--}}
@include('script')
@yield('script')
</body>
</html>
