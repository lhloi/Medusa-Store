<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @yield('title')
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('ashion-master/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ashion-master/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ashion-master/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ashion-master/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ashion-master/css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ashion-master/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ashion-master/css/slicknav.min.css') }}" type="text/css">
    @yield('css')


</head>

<body>
    <!-- Page Preloder -->
    {{-- <div id="preloder">
        <div class="loader"></div>
    </div> --}}

    <!-- Offcanvas Menu Begin -->
    {{-- <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>
        <ul class="offcanvas__widget">
            <li><span class="icon_search search-switch"></span></li>
            <li><a href="#"><span class="icon_heart_alt"></span>
                <div class="tip">2</div>
            </a></li>
            <li><a href="#"><span class="icon_bag_alt"></span>
                <div class="tip">2</div>
            </a></li>
        </ul>
        <div class="offcanvas__logo">
            <a href="./index.html"><img src="{{ asset('ashion-master/img/logo.png') }}" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
            <a href="#">Login</a>
            <a href="#">Register</a>
        </div>
    </div> --}}
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    @include('Client.Layout.header')
    <!-- Header Section End -->

    @yield('content')

    <!-- Instagram Begin -->
    @include('Client.Layout.instagram')
    <!-- Instagram End -->

    <!-- Footer Section Begin -->
    @include('Client.Layout.footer')
    <!-- Footer Section End -->



    <!-- Js Plugins -->
    <script src="{{ asset('ashion-master/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('ashion-master/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('ashion-master/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('ashion-master/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('ashion-master/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('ashion-master/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('ashion-master/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('ashion-master/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('ashion-master/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('ashion-master/js/main.js') }}"></script>
    <script src="{{ asset('ashion-master/js/bootstrap.bundle.min.js') }}"></script>
    @yield('js')
</body>

</html>
