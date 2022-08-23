<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Medusa Store</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome Icons -->
    {{-- <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('AdminBE/Layout/icon.all.min.css') }}"> --}}

    <!-- Theme style -->
    {{-- <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('AdminBE/Layout/adminlte.min.css') }}">

    {{-- Select 2 --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="{{ asset('AdminBE/Layout/select2.min.css') }}">
    @yield('css')

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        @include('admin.layouts.header')

        @include('admin.layouts.sidebar')

        @yield('content')

        @include('admin.layouts.footer')

    </div>



    {{-- <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script> --}}


    <!-- jQuery -->
    <script src="{{ asset('AdminBE/Layout/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('AdminBE/Layout/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('AdminBE/Layout/adminlte.min.js') }}"></script>

    {{-- <script cript src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script src="{{ asset('AdminBE/Layout/select2.min.js') }}"></script>

    {{-- <script src="https://cdn.tiny.cloud/1/rxwbm1mdm7f5h5m0rrg5zvgc8kmiffkyt2hpx3jts4hc59lo/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> --}}
    <script src="{{ asset('AdminBE/Layout/tinymce.min.js') }}"></script>

    {{-- slug title --}}
    <script src="{{ asset('AdminBE/Layout/layout.js') }}"></script>

    @yield('js')

</body>

</html>
