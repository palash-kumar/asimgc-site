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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">

    <!-- fontawesome 5.13.1 --->
    <link href="{{ asset('assets/fontawesome/css/all.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/fontawesome-iconpicker/css/fontawesome-iconpicker.min.css') }}" rel="stylesheet">

    <!-- aos-animation 5.13.1 --->
    <link href="{{ asset('assets/aos-animation/aos.css') }}" rel="stylesheet">

    <!-- fancyBox v2.1.5 --->
    <link href="{{ asset('assets/fancybox/jquery.fancybox.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}">

    <!-- toastr -->
    <link href="{{ asset('assets/toastr/toastr.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">

    <!-- popper -->
    <script type="module" src="{{ asset('assets/popper.js/dist/popper.min.js') }}" ></script>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}" ></script>
    <script src="{{ asset('js/jquery.easing.min.js') }}" ></script>

    <!-- Apps -->
    <script src="{{ asset('js/app.js') }}" ></script>

    <!-- Scrolling -->
    <script src="{{ asset('js/scrolling.js') }}" ></script>

    <!-- fancyBox v2.1.5 --->
    <script src="{{ asset('assets/fancybox/jquery.fancybox.js') }}" ></script>
    <script src="{{ asset('assets/fancybox/jquery.fancybox.pack.js') }}" ></script>

    <!-- fontawesome-iconpicker v3 --->
    <script src="{{ asset('assets/fontawesome-iconpicker/js/fontawesome-iconpicker.min.js') }}" ></script>


    <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- toastr -->
    <script src="{{ asset('assets/toastr/toastr.min.js') }}" ></script>

    <!-- ckeditor -->
    <script src="{{ asset('assets/ckeditor/ckeditor.js') }}" ></script>

    <script src="{{ asset('js/custom.js') }}" ></script>
    <style>
        .sidenav {
            width: 130px;
            position: fixed;
            z-index: 1;
            top: 180px;
            background: #eee;
            overflow-x: hidden;
            padding: 8px 0;
            }

            .sidenav a {
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 25px;
            color: #2196F3;
            display: block;
            }

            .sidenav a:hover {
            color: #064579;
            }

            .main {
            margin-left: 140px; /* Same width as the sidebar + left position in px */
            font-size: 28px; /* Increased text to enable scrolling */
            padding: 0px 10px;
            }

            @media screen and (max-height: 450px) {
            .sidenav {padding-top: 100px;}
            .sidenav a {font-size: 18px;}
            }
    </style>
</head>
<body>
    <div id="app">
        @include('inc.appNavbar')
        <main class="py-4 container-fluid">
            <div class="card-header mb-2 rounded" style="margin-top:70px ">
                @yield('title')
            </div>
            @include('inc.messages')
            <div class="container">
                @yield('content')
            </div>

        </main>

        <!-- <?php //@include('inc.pageFooter') ?> -->
    </div>


    <script src="{{ asset('assets/aos-animation/aos.js') }}" ></script>
    <script type="text/javascript">
        $('.carousel').carousel({
            interval: 4000
        })

        $('#error-alert').hide();

        CKEDITOR.replace( 'description-ckeditor');


        $(function () {
            $('[data-toggle="popover"]').popover();

        });
        $(document).ready(function() {
            $(".fancybox").fancybox();

            $("[rel='tooltip']").tooltip();
            $(".fde").css('display', 'none');
            $(".fde").fadeIn(2000);
        });

    </script>
    @yield('script')
</body>
</html>
