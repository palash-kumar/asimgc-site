<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AsimGC') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- fullview v2.1.5 --->
    <link href="{{ asset('assets/fullview/fullview.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">

    <!-- fontawesome 5.13.1 --->
    <link href="{{ asset('assets/fontawesome/css/all.min.css') }}" rel="stylesheet">

    <!-- aos-animation 5.13.1 --->
    <link href="{{ asset('assets/aos-animation/aos.css') }}" rel="stylesheet">

    <!-- fancyBox v2.1.5 --->
    <link href="{{ asset('assets/fancybox/jquery.fancybox.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/datatables/datatables.min.css') }}" rel="stylesheet">

    @yield('styles')

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}" ></script>
    <script src="{{ asset('js/jquery.easing.min.js') }}" ></script>

    <!-- Apps -->
    <script src="{{ asset('js/app.js') }}" ></script>

    <!-- Scrolling -->
    <script src="{{ asset('js/scrolling.js') }}" ></script>



    <!-- ckeditor -->
    <script src="{{ asset('assets/ckeditor/ckeditor.js') }}" ></script>

    <!-- ckeditor -->
    <script src="{{ asset('assets/fullview/fullview.js') }}" ></script>

    @yield('script-head')
</head>
<body>
    <div id="app">
        @include('inc.pageNavbar')

        <main class="" id="">
            @yield('title')
            @yield('content')

        </main>
        @include('inc.pageFooter')


    </div>

    <!-- fancyBox v2.1.5 --->
    <script src="{{ asset('assets/fancybox/jquery.fancybox.js') }}" ></script>
    <script src="{{ asset('assets/fancybox/jquery.fancybox.pack.js') }}" ></script>
    <!-- Scripts -->
    <script src="{{ asset('assets/aos-animation/aos.js') }}" ></script>
    <script src="{{ asset('assets/datatables/datatables.min.js') }}" ></script>
    <script type="text/javascript">
        $("#about-m").click(function() {
            console.log("about is clicked");
            $('html, body').animate({
                scrollTop: $("#about").offset().top
            }, 2000);
            //$("#about").effect( "bounce", {times:3}, 300 );
        });
        AOS.init();

        // $('.carousel').carousel({
        //     interval: 4000
        // })

        $(document).ready(function() {

        });
    </script>

    <script type="text/javascript">

        $(document).ready(function () {

            $("#fullview").fullView({
                //Navigation
                navbar: "#navbar",
                dots: true,
                dotsPosition: 'right',

                //Scrolling
                easing: 'swing',
                backToTop: true,

                // Accessibility
                keyboardScrolling: true,

                // Callback
                onViewChange: function (currentView) {
                    // console.log(currentView)
                }
            })

        });


    </script>
    @yield('script')
</body>
</html>
