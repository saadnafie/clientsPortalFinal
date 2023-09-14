<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
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
    @include('layouts/sections/styles-without-nav')
    @yield('page-style')
</head>

<body id="kt_body" class="app-blank">
    <script>
    var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
        } else {
            if (localStorage.getItem("data-bs-theme") !== null) {
                themeMode = localStorage.getItem("data-bs-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }
        document.documentElement.setAttribute("data-bs-theme", themeMode);
    }
    </script>
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        @yield('content')
    </div>

    <div id="loading-load">
        <img src="{{asset('assets/media/svg/Spinner.svg')}}">
    </div>
    <script>
    var hostUrl = "assets/";
    </script>
    @include('layouts/sections/scripts-without-nav')
    @yield('page-script')
    <script>
    $(window).on('load', function() {
        $('#loading-load').hide();
    });
    </script>
</body>

</html>