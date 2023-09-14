<!DOCTYPE html>
<html lang="en">

<head>
    <title>Clean Sheet Group</title>
    <meta charset="utf-8" />
    <meta name="description" content="Clean Sheet Group" />
    <meta name="keywords" content="Clean Sheet Group" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Clean Sheet Group" />
    <meta property="og:url" content="http://localhost" />
    <meta property="og:site_name" content="Clean Sheet Group" />
    <link rel="canonical" href="http://localhost" />
    <link rel="shortcut icon" href="{{asset('assets/media/logos/logo.png')}}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    @include('layouts/sections/styles-with-nav')
    @yield('page-style')

    <style>

    </style>
</head>

<body id="kt_app_body" data-kt-app-header-fixed-mobile="true" data-kt-app-sidebar-enabled="true"
    data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
    class="app-default">

    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            @include('layouts/sections/header')
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                @include('layouts/sections/sidebar')

                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">

                    @yield('content')
                </div>
                @include('layouts/sections/footer')

            </div>
        </div>
    </div>
    </div>

    <div id="loading-load">
        <img src="{{asset('assets/media/svg/Spinner.svg')}}">
    </div>
    <script>
    var hostUrl = "assets/";
    </script>

    @include('layouts/sections/scripts-with-nav')
    @yield('page-script')
    @stack('scripts')
    <script>
    $(window).on('load', function() {
        $('#loading-load').hide();
    });
    </script>
</body>

</html>